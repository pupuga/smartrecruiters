<?php

namespace Smartrecruiters\Main;

use Smartrecruiters\Config;
use Smartrecruiters\Libs\Curl;

final class Items {

    private static $instance;
    private $loop = '+1 hours';
    private $dateField = 'smartrecruiters_date';
    private $itemsField = 'smartrecruiters_items';
    private $restapi;
    private $companies;
    private $currentTime;
    private $update = false;
    private $items = array();
    private $json;
    private $prefix;

    public static function app($restapi = '', $companies = array()): self
    {
        self::$instance = (self::$instance) ?: new self($restapi, $companies);

        return self::$instance;
    }

    public function get(): array
    {
        return $this->items;
    }

    public function getJson(): string
    {
        return (is_null($this->json)) ? json_encode($this->items) : $this->json;
    }

    private function __construct($restapi, $companies)
    {
        $this->setPrefix();
        if ($this->checkUpdate()) {
            $this->restapi = $restapi;
            $this->companies = $companies;
            $this->updateDate();
        }

        $this->setItems();
    }

    private function setPrefix()
    {
        $this->prefix = Config::app()->getPrefix() . '-';
    }

    private function checkUpdate(): bool
    {
        $saveTime = get_option($this->dateField);
        $nextSaveTime = empty($saveTime) ? '' : date('Y-m-d G:i:00', strtotime($this->loop, strtotime($saveTime)));
        $this->currentTime = date('Y-m-d G:i:00');
        $filed = $this->prefix . 'reset-items';
        $reset = get_option($filed);
        if ($reset == 'on' || empty($saveTime) || (strtotime($this->currentTime) >= strtotime($nextSaveTime))) {
            if ($reset == 'on') {
                update_option($filed, '');
            }
            $this->update = true;
        }

        return $this->update;
    }

    private function updateDate(): void
    {
        update_option($this->dateField, $this->currentTime);
    }

    private function setItems(): void
    {
        if ($this->update) {
            $this->updateItems();
        } else {
            $this->json = get_option($this->itemsField);
            $this->items = (empty($this->json)) ? $this->items : json_decode($this->json);
        }
    }

    private function updateItems(): void
    {
        if (count($this->companies)) {
            foreach ($this->companies as $company) {
                $url = str_replace('{company}', $company, $this->restapi);
                $this->items[] = Curl::get($url);
            }
            update_option($this->itemsField, $this->getJson());
        }
    }

}