<?php

namespace Smartrecruiters\Main;

use Smartrecruiters\Config;

final class StylesScripts {

    private static $instance;

    public static function app($name = 'main', $custom = false)
    {
        self::$instance = (self::$instance) ?: new self($name, $custom);

        return self::$instance;
    }

    private function __construct($name, $custom)
    {
        if (!$custom) {
            $this->addStyles($name);
            $this->addScripts($name);
        }
    }

    public function addStyles($name = 'main')
    {
        wp_enqueue_style(
            Config::app()->getName() . '-' . $name,
            Config::app()->getDist() . $name . '.css',
            array(),
            Config::app()->getVersion(),
            'all'
        );
    }

    public function addScripts($name = 'main')
    {
        wp_enqueue_script(
            Config::app()->getName() . '-' . $name,
            Config::app()->getDist() . $name . '.js',
            array(),
            Config::app()->getVersion(),
            true
        );
    }

}