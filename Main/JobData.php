<?php

namespace Smartrecruiters\Main;

use Smartrecruiters\Admin\FieldsData;
use Smartrecruiters\Config;

final class JobData {

    private $data;
    private $imagesFolder = 'sr';
    private $defaultImage = 'logo.png';
    private $config;
    private $prefix;

    public function __construct($response, $atts)
    {
        $this->setPrefix();
        $this->setConfig();
        $this->set($response, $atts);
    }

    public function get(): object
    {
        return $this->data;
    }

    private function setPrefix(): void
    {
        $this->prefix = Config::app()->getPrefix() . '-' ;
    }

    private function setConfig(): void
    {
        $this->config = FieldsData::app()->get();
    }

    private function set($response, $atts): void
    {
        $this->data = new \stdClass();
        if (!empty($response) && isset($response->id)) {
            $this->data->name = $response->name;
            $this->data->address = $response->location->address;
            $this->data->city = $response->location->city;
            $this->data->video = $this->getVideo($response);
            $this->data->image = $this->getImage($response);
            $this->data->country = $this->getCountry($response);
            $this->data->link = $response->applyUrl;
            $this->data->descriptionText = $response->jobAd->sections->jobDescription->text;
            $this->data->additionalInformationText = $response->jobAd->sections->additionalInformation->text;
            $this->data->qualificationsText = $response->jobAd->sections->qualifications->text;

            $this->data->color = get_option($this->prefix . 'job-color');
            $this->data->color = (empty($this->data->color))
                ? $this->config['job']['job-color']['default']
                : $this->data->color;

            $this->data->descriptionTitle = get_option($this->prefix . 'job-description-title');
            $this->data->descriptionTitle = (empty($this->data->descriptionTitle))
                ? $this->config['job']['job-description-title']['default']
                : $this->data->descriptionTitle;

            $this->data->qualificationsTitle = get_option($this->prefix . 'job-qualifications-title');
            $this->data->qualificationsTitle = (empty($this->data->qualificationsTitle))
                ? $this->config['job']['job-qualifications-title']['default']
                : $this->data->qualificationsTitle;

            $this->data->additionalInformationTitle = get_option($this->prefix . 'job-info-title');
            $this->data->additionalInformationTitle = (empty($this->data->additionalInformationTitle))
                ? $this->config['job']['job-info-title']['default']
                : $this->data->additionalInformationTitle;

            $this->data->linkTitle = get_option($this->prefix . 'job-link-title');
            $this->data->linkTitle = (empty($this->data->linkTitle))
                ? $this->config['job']['job-link-title']['default']
                : $this->data->linkTitle;

            $this->data->alert = get_option($this->prefix . 'job-alert');
            $this->data->alert = (empty($this->data->alert))
                ? $this->config['job']['job-alert']['default']
                : $this->data->alert;

            //custom button - begin
            $this->data->customButtonOn = !empty(get_option($this->prefix . 'job-custom-button-on'));

            $this->data->customButtonColor = get_option($this->prefix . 'job-custom-button-color');
            $this->data->customButtonColor = (empty($this->data->customButtonColor))
                ? $this->config['job']['job-custom-button-color']['default']
                : $this->data->customButtonColor;

            $this->data->customButtonTextColor = get_option($this->prefix . 'job-custom-button-text-color');
            $this->data->customButtonTextColor = (empty($this->data->customButtonTextColor))
                ? $this->config['job']['job-custom-button-text-color']['default']
                : $this->data->customButtonTextColor;

            $this->data->customButtonText = get_option($this->prefix . 'job-custom-button-text');

            $this->data->customButtonLink = get_option($this->prefix . 'job-custom-button-link');

            $this->data->customButtonTargetBlank = !empty(get_option($this->prefix . 'job-custom-button-target-blank'));
            //custom button - end

            unset($response);

        } else {
            $this->data->empty = get_option($this->prefix . 'job-empty');
            $this->data->empty = (empty($this->data->alert))
                ? $this->config['job']['job-empty']['default']
                : $this->data->empty;
        }
    }

    private function getCountry($response): string
    {
        $data = '';
        if(isset($response->customField) && is_array($response->customField) && count($response->customField)) {
            foreach ($response->customField as $item) {
                if (strtolower($item->fieldId) === 'country' && !empty($item->valueLabel)) {
                    $data = $item->valueLabel;
                }
            }
        }

        return $data;
    }

    private function getVideo($response): string
    {
        $data = '';
        if(isset($response->jobAd->sections->videos->urls) && is_array($response->jobAd->sections->videos->urls) && count($response->jobAd->sections->videos->urls)) {
            foreach ($response->jobAd->sections->videos->urls as $url) {
                $parts = explode('/', $url);
                $data = end($parts);
                if (strpos($data, '?') !== false && strpos($data, '=') !== false) {
                    $parts = explode('=', $url);
                    $data = end($parts);
                }
            }
        }

        return $data;
    }

    private function getImage($response): string
    {
        $data = '';
        $url = get_home_url() . '/' . $this->imagesFolder . '/';
        if(isset($response->refNumber) && !empty($response->refNumber)) {
            $extensions = array('jpg', 'png', 'svg', 'jpeg', 'gif');
            foreach ($extensions as $extension) {
                if (is_file(ABSPATH . $this->imagesFolder . '/' . $response->refNumber . '.' . $extension)) {
                    $data = $url . $response->refNumber . '.' . $extension;
                    break;
                }
            }
        }
        if (empty($data) && is_file(ABSPATH . $this->imagesFolder . '/' . $this->defaultImage)) {
            $data = $url . $this->defaultImage;
        }

        return $data;
    }
}