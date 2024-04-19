<?php
/*
Plugin Name: SmartRecruiters Plugin by ARDOR GROUP
Description: Plugin 
Version: 1.1
Author: Alex Shandor | <a href="https://www.amselrehhase.de" target="_blank">amselrehhase - form is function</a>
License: MIT
*/

if ( ! defined( 'WPINC' ) ) {
	die;
} else {
    add_action( 'init',  function () {
        require_once __DIR__ . '/Init.php';
    }, 10000);
}

spl_autoload_register(function($class) {
    $class = explode('\\', $class);
    unset($class[0]);
    $class = implode('/', $class);
    $file = plugin_dir_path( __FILE__ ) . $class . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});