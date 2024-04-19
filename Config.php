<?php

namespace Smartrecruiters;

final class Config
{
    private static $instance;
    private $version = '1.1';
    private $name;
    private $title;
    private $path;
    private $dist;
    private $prefix = 'smartrecruiters';

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

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getDist(): string
    {
        return $this->dist;
    }

    private function __construct()
    {
        $this->setName();
        $this->setTitle();
        $this->setPath();
        $this->setDist();
    }

    private function setName(): void
    {
        $pathParts = explode('/', plugin_dir_path( __FILE__ ));
        $this->name = $pathParts[count($pathParts) - 2];
    }

    private function setTitle(): void
    {
        $this->title = ucfirst(strtolower(str_replace(array('_', '-') , '', $this->name)));
    }

    private function setPath(): void
    {
        $this->path = plugin_dir_path( __FILE__ );
    }

    private function setDist(): void
    {
        $this->dist = plugin_dir_url( __FILE__ ) . 'assets/dist/';
    }
}