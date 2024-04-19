<?php

namespace Smartrecruiters\Admin;

use Smartrecruiters\Config;
use Smartrecruiters\Libs\Files;
use Smartrecruiters\Libs\OptionPage;

final class OptionPages {

    private $fields;
    private $fieldsHtml;
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
        $this->fields = FieldsData::app()->get();
        $this->setMenu();
        $this->setSubMenus();
        add_action('admin_init', array($this, 'registerFields'));
    }

    private function setMenu()
    {
        $this->addOptionGeneralPage();
    }

    private function addOptionGeneralPage(): void
    {
        $menu = array_key_first($this->fields);
        $this->setFieldsHtml($menu);
        $this->addOptionPage(
            $menu,
            array(
                'type' => 'menu',
                'parent' => '1000',
                'title' => Config::app()->getTitle(),
                'icon' => 'dashicons-location-alt'
            )
        );
    }

    private function setSubMenus()
    {
        if (count($this->fields) > 1) {
            foreach (array_slice($this->fields,1) as $menu => $fields) {
                $this->addOptionSubPage($menu);
            }
        }
    }

    private function addOptionSubPage($menu): void
    {
        $this->setFieldsHtml($menu);
        $this->addOptionPage(
            $menu,
            array(
                'type' => 'submenu',
                'parent' => 'menu-' .  Config::app()->getName(),
                'title' => ucfirst(strtolower(str_replace(array('_', '-') , '', $menu)))
            )
        );
    }

    private function setFieldsHtml($menu): void
    {
        $this->fieldsHtml = Files::getTemplate(
            __DIR__ ."/templates/fields",
            false,
            array(
                'name' => Config::app()->getName(),
                'fields' => $this->fields[$menu]
            )
        );
    }

    private function addOptionPage($menu, array $config): void
    {
        new OptionPage(
            $config,
            __DIR__  .'/templates/option-page',
            array(
                'group' => Config::app()->getName() . "-{$menu}",
                'html-fields' => $this->fieldsHtml
            )
        );
    }

    public function registerFields(): void
    {
        foreach ($this->fields as $menu => $fields) {
            foreach ($fields as $key => $field) {
                $group =  Config::app()->getName() . "-{$menu}";
                $option =  Config::app()->getName() . "-{$key}";
                register_setting($group, $option);
            }
        }
    }
}