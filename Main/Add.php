<?php

namespace Smartrecruiters\Main;

final class Add {

    private static $instance;

    public static function app(): self
    {
        self::$instance = (self::$instance) ?: new self();

        return self::$instance;
    }

    public function __construct()
    {
    }

    public function addHtml($atts): string
    {
        if ($this->checkTemplate($atts)) {
            switch ($atts['template']) {
                case 'table':
                case 'map':
                    $html = Jobs::app()->addHtml($atts);
                    break;
                case 'job':
                    $html = (new Job($atts))->addHtml();
                    break;
            }
        }

        return $html ?? '';
    }

    private function checkTemplate($atts): bool
    {
        return (isset($atts['template']) && !empty($atts['template']));
    }

}