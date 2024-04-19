<?php

namespace Smartrecruiters\Admin;

use Smartrecruiters\Config;

final class StylesScripts {

    private static $instance;

    /**
     * @return static
     */
    public static function app(): self
    {
        self::$instance = (self::$instance) ?: new self();

        return self::$instance;
    }

    private function __construct()
    {
        $this->addStyles();
        $this->addScripts();
    }

    private function addStyles()
    {
        wp_enqueue_style(
            Config::app()->getName() . '-style',
            Config::app()->getDist() . 'admin.css',
            array(),
            Config::app()->getVersion(),
            'all'
        );
    }

    private function addScripts()
    {
        wp_enqueue_script(
            Config::app()->getName() . '-scrypt',
            Config::app()->getDist() . 'admin.js',
            array(),
            Config::app()->getVersion(),
            false
        );
    }
}