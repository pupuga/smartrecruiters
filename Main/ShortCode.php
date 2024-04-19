<?php

namespace Smartrecruiters\Main;

use Smartrecruiters\Config;

final class ShortCode {

    private static $instance;

    /**
     * @return $this
     */
    public static function app(): self
    {
        self::$instance = (self::$instance) ?: new self();

        return self::$instance;
    }

    private function __construct()
    {
        add_shortcode( Config::app()->getName(), array(Add::app(), 'addHtml'));
    }

}