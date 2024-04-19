<?php

namespace Smartrecruiters\Main;

use Smartrecruiters\Admin\FieldsData;
use Smartrecruiters\Config;
use Smartrecruiters\Libs\Files;

final class Jobs {

    private static $instance;
    private $restapi = 'https://api.smartrecruiters.com/v1/companies/HRDpt/postings/?custom_field.5ab1506f6d8bc519b1d9db47={company}';
    private $prefix;
    private $config;
    private $url;
    private $slug;
    private $atts;
    private $data;
    private $companies;
    private $json;
    private $fetch = false;
    private $html;

    public static function app(): self
    {
        self::$instance = (self::$instance) ?: new self();

        return self::$instance;
    }

    public function addHtml($atts = array()): string
    {
        $this->atts = $atts;
        $this->html = (is_null($this->companies)) ? $this->setScripts() : '';
        $this->html .= ($this->checkCompanies()) ? $this->addTemplate() : '';

        return $this->html;
    }

    private function __construct()
    {
        $this->setPrefix();
        $this->setConfig();
        $this->setSlug();
        $this->url = get_home_url();
    }

    private function setPrefix(): void
    {
        $this->prefix = Config::app()->getPrefix() . '-' ;
    }

    private function setConfig(): void
    {
        $this->config = FieldsData::app()->get();
    }

    private function setSlug(): void
    {
        $this->slug = get_option($this->prefix . 'slug');
        $this->slug = (empty($this->slug))
            ? $this->config['general']['slug']['default']
            : $this->slug;
    }

    private function setScripts(): ?string
    {
        if (($this->checkCompanies())) {
            $this->addStylesScripts();
            $this->setParams();
            $this->html = $this->addJson();
        }

        return $this->html;
    }

    private function checkCompanies(): bool
    {
        if (is_null($this->companies)) {
            $this->companies = explode(',', str_replace(' ', '', trim(get_option($this->prefix . 'companies'), ',')));
        }

        return (is_array($this->companies) && isset($this->companies[0]) && !empty($this->companies[0]));
    }

    private function addStylesScripts(): void
    {
        StylesScripts::app();
    }

    private function setParams(): void
    {

        $fullTime = get_option($this->prefix . 'table-full-time');
        $fullTime = (empty($fullTime))
            ? $this->config['table']['table-full-time']['default']
            : $fullTime;

        $partTime = get_option($this->prefix . 'table-part-time');
        $partTime = (empty($partTime))
            ? $this->config['table']['table-part-time']['default']
            : $partTime;

        $this->json = (json_encode(array(
            'companies' => $this->companies,
            'url' => trim($this->url, '/') . '/' . $this->slug . '/',
            'restapi' => $this->restapi,
            'dist' => Config::app()->getDist(),
            'fetch' => $this->fetch,
            'full-time' => $fullTime,
            'part-time' => $partTime,
        )));
    }

    private function addJson() : string
    {
        return Files::getTemplate(
            __DIR__ ."/templates/json",
            false,
            array(
                'json' => $this->json,
                'items' => ($this->fetch)
                    ? json_encode(array())
                    : Items::app($this->restapi, $this->companies)->getJson()
            )
        );
    }

    private function addTemplate(): string
    {
        $this->setData();

        return $this->setTemplate();
    }

    private function setData(): void
    {
        $this->data = new \stdClass();
        switch ($this->atts['template']) {
            case 'table':
                $this->data->color = get_option($this->prefix . 'table-color');
                $this->data->color = (empty($this->data->color))
                    ? $this->config['table']['table-color']['default']
                    : $this->data->color;

                $this->data->textHoverColor = get_option($this->prefix . 'table-text-hover-color');
                $this->data->textHoverColor = (empty($this->data->textHoverColor))
                    ? $this->config['table']['table-text-hover-color']['default']
                    : $this->data->textHoverColor;

                $this->data->titleName = get_option($this->prefix . 'table-name-title');
                $this->data->titleName = (empty($this->data->titleName))
                    ? $this->config['table']['table-name-title']['default']
                    : $this->data->titleName;

                $this->data->titleType = get_option($this->prefix . 'table-type-title');
                $this->data->titleType = (empty($this->data->titleType))
                    ? $this->config['table']['table-type-title']['default']
                    : $this->data->titleType;

                $this->data->titleCategory = get_option($this->prefix . 'table-category-title');
                $this->data->titleCategory = (empty($this->data->titleCategory))
                    ? $this->config['table']['table-category-title']['default']
                    : $this->data->titleCategory;

                $this->data->searchPlaceholder = get_option($this->prefix . 'table-search-placeholder');
                $this->data->searchPlaceholder = (empty($this->data->searchPlaceholder))
                    ? $this->config['table']['table-search-placeholder']['default']
                    : $this->data->searchPlaceholder;

                $this->data->filterDefault = get_option($this->prefix . 'table-default-filter');
                $this->data->filterDefault = (empty($this->data->filterDefault))
                    ? $this->config['table']['table-default-filter']['default']
                    : $this->data->filterDefault;

                break;
            case 'map':

                $this->data->color = get_option($this->prefix . 'map-color');
                $this->data->color = (empty($this->data->color))
                    ? $this->config['map']['map-color']['default']
                    : $this->data->color;
                $this->data->color = implode(',', sscanf($this->data->color, "#%02x%02x%02x"));

                $this->data->textMarkerColor = get_option($this->prefix . 'map-marker-text-color');
                $this->data->textMarkerColor = (empty($this->data->textMarkerColor))
                    ? $this->config['map']['map-marker-text-color']['default']
                    : $this->data->textMarkerColor;

                $this->data->gray = get_option($this->prefix . 'map-gray');

                $markerTextSingle = get_option($this->prefix . 'map-marker-text-single');
                $markerTextSingle = (empty($markerTextSingle))
                    ? $this->config['map']['map-marker-text-single']['default']
                    : $markerTextSingle;

                $style = get_option($this->prefix . 'map-style');
                $style = (empty($style))
                    ? $this->config['map']['map-style']['options']['default']
                    : $this->config['map']['map-style']['options'][$style];

                $markerTextMany = get_option($this->prefix . 'map-marker-text-many');
                $markerTextMany = (empty($markerTextMany))
                    ? $this->config['map']['map-marker-text-many']['default']
                    : $markerTextMany;

                $alert = get_option($this->prefix . 'map-alert');
                $alert = (empty($alert))
                    ? $this->config['map']['map-alert']['default']
                    : $alert;

                $this->data->json = json_encode(array(
                    'markers' => Markers::app(Items::app()->get())->get(),
                    'alert' => $alert,
                    'style' => $style,
                    'markerText' => array(
                        'single' => $markerTextSingle,
                        'many' => $markerTextMany
                    )
                ));
                break;
        }
    }

    private function setTemplate(): string
    {
        return Files::getTemplate(
            __DIR__ ."/templates/" . $this->atts['template'],
            false,
            $this->data
        );
    }

}