<?php

namespace Smartrecruiters\Main;

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
        ShortCode::app();
    }

}