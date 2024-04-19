<?php

namespace Smartrecruiters;

use Smartrecruiters\Admin\Init as Admin;
use Smartrecruiters\Main\Init as Main;

final class Init
{
    private static $instance;

    /**
     * @return $this
     */
    public static function app(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->bootstrap();
    }

    private function bootstrap(): void
    {
        if (is_admin() && current_user_can('administrator')) {
            Admin::app();
        } else {
            Main::app();
        }
    }
}

Init::app();