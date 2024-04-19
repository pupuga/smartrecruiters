<?php

namespace Smartrecruiters\Main;

use Smartrecruiters\Admin\FieldsData;
use Smartrecruiters\Config;
use Smartrecruiters\Libs\Curl;

final class Markers {

    private static $instance;
    private $markersField = 'smartrecruiters_markers';
    private $markerUpdatingField = 'smartrecruiters_markers_updating';
    private $api = 'https://nominatim.openstreetmap.org/?format=json&q={location}&limit=1';
    private $prefix;
    private $markers = array();
    private $currentMarkers;
    private $items;
    private $location;
    private $count = 5;
    private $i = 0;
    private $pause = 1;
    private $update = false;
    private $countries = array(
        'germany' => array(
            'lat' => '52.520008',
            'lon' => '13.404954',
        )
    );

    public static function app($items): self
    {
        self::$instance = (self::$instance) ?: new self($items);

        return self::$instance;
    }

    public function get(): array
    {
        return $this->markers;
    }

    private function __construct($items)
    {
        $this->items = $items;
        if (is_array($this->items) && count($this->items)) {
            $this->setPrefix();
            $this->setUpdate();
            $this->setCurrentMarkers();
            $this->set();
            $this->clearUpdate();
        }
    }

    private function setPrefix()
    {
        $this->prefix = Config::app()->getPrefix() . '-';
    }

    private function setUpdate(): void
    {
        $this->update = empty(get_option($this->markerUpdatingField));
        if ($this->update) {
            update_option($this->markerUpdatingField, 1);
        }
    }

    private function clearUpdate()
    {
        update_option($this->markerUpdatingField, 0);
    }

    private function setCurrentMarkers(): void
    {
        $filed = $this->prefix . 'reset-markers';
        $reset = get_option($filed);
        if ($reset == 'on') {
            delete_option($this->markersField);
            update_option($filed, '');
        }
        $this->currentMarkers = is_null($this->currentMarkers)
            ? get_option($this->markersField)
            : $this->currentMarkers;
        $this->currentMarkers = is_array($this->currentMarkers) ? $this->currentMarkers : array();
    }

    private function set()
    {
        foreach ($this->items as $itemsRow) {
            if (is_array($itemsRow->content) && count($itemsRow->content)) {
                foreach ($itemsRow->content as $item) {
                    $this->addMarker($item);
                    if ($this->i >= $this->count) {
                        break;
                    }
                }
            }
            if ($this->i >= $this->count) {
                break;
            }
        }

        update_option($this->markersField, $this->markers);
    }

    private function addMarker($item): void
    {
        if (isset($this->currentMarkers[$item->id])) {
            $this->markers[$item->id] = $this->currentMarkers[$item->id];
        } else {
            $this->location = urlencode($item->location->city . '+' . $item->location->address);
            if (!$this->addMarkerByColumn($item, 'location', $this->location)) {
                if ($this->update) {
                    if ($this->count >= $this->i) {
                        if ($this->i !== 1) {
                            sleep($this->pause);
                        }
                        $response = $this->request();
                        if (isset($response[0]->lat) && isset($response[0]->lon)) {
                            $this->markers[$item->id] = array(
                                'location' => $this->location,
                                'postalCode' => $item->location->postalCode ?? '',
                                'lat' => $response[0]->lat,
                                'lon' => $response[0]->lon
                            );
                        } else {
                            if (isset($item->location->postalCode) && !empty($item->location->postalCode)) {
                                if (!$this->addMarkerByColumn($item, 'postalCode', $item->location->postalCode)) {
                                    $country = strtolower($item->customField[0]->valueLabel);
                                    $country = $country ?: 'germany';
                                    $this->markers[$item->id] = array(
                                        'location' => $this->location,
                                        'postalCode' => 'country',
                                        'lat' => $this->countries[$country]['lat'],
                                        'lon' => $this->countries[$country]['lon']
                                    );
                                }
                            }
                        }
                        $this->i++;
                    }
                }
            }
        }
    }

    private function addMarkerByColumn($item, $column, $value): bool
    {
        $result = $this->addCustomMarkerByColumn($item, $this->markers, $column, $value);
        if (!$result) {
            $result = $this->addCustomMarkerByColumn($item, $this->currentMarkers, $column, $value);
        }

        return $result;
    }

    private function addCustomMarkerByColumn($item, $markers, $column, $value): bool
    {
        $result = false;
        $columnIds = array_combine(array_keys($markers), array_column($markers, $column));
        $columnId = array_search($value, $columnIds);
        if (!empty($columnId)) {
            $this->markers[$item->id] = $markers[$columnId];
            $this->markers[$item->id]['location'] = $this->location;
            $result = true;
        }

        return $result;
    }

    private function request(): ?array
    {
        $url = str_replace(array('{location}'), array($this->location), $this->api);
        return Curl::get($url);
    }

}