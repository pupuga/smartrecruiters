<?php

namespace Smartrecruiters\Main;

use Smartrecruiters\Libs\Curl;
use Smartrecruiters\Libs\Files;

final class Job {

    private $atts;
    private $restapi = 'https://api.smartrecruiters.com/v1/companies/{company}/postings/{id}';
    private $html = '';

    public function __construct($atts)
    {
        $this->atts = $atts;
        if ($this->checkUrl()) {
            $this->addStylesScripts();
        }
        $this->html = Files::getTemplate(
            __DIR__ ."/templates/" . $this->atts['template'],
            false,
            $this->getData()
        );
    }

    public function addHtml(): string
    {
        return $this->html;
    }

    private function checkUrl(): bool
    {
        $parts = explode('?', $_SERVER['REQUEST_URI']);
        $part = isset($parts[1]) ? $parts[1] : '';
        $urlParts = explode('-', $part);
        if (isset($urlParts[0]) && isset($urlParts[1]) && !empty($urlParts[0]) && !empty($urlParts[1])) {
            $params = array(
                '{company}' => $urlParts[0],
                '{id}' => $urlParts[1]
            );
            $this->restapi = str_replace(array_keys($params), array_values($params), $this->restapi);
            $check = true;
        }

        return $check ?? false;
    }

    private function addStylesScripts(): void
    {
        StylesScripts::app($this->atts['template']);
    }

    private function getData(): object
    {
        return (new JobData(Curl::get($this->restapi), $this->atts))->get();
    }
}