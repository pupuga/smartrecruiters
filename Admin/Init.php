<?php

namespace Smartrecruiters\Admin;

final class Init {

    private static $instance;

    public static function app(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        OptionPages::app();
        StylesScripts::app();
    }

}
