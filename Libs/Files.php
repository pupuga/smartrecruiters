<?php

namespace Smartrecruiters\Libs;

class Files
{
    public static function getFile(string $file, bool $echo = false, $params = null)
    {
        $html = '';
        if (is_file($file)) {
            if ($echo) {
                require $file;
            } else {
                ob_start();
                require($file);
                $html = ob_get_clean();
            }
        }

        return $html;
    }

    public static function getTemplate(string $template, bool $echo = false, $params = null): ?string
    {
        $file = new \SplFileInfo($template);
        $template .= (empty($file->getExtension())) ? '.php' : '';

        return self::getFile($template, $echo, $params);
    }

}