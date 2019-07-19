<?php
if (!file_exists('database')) {
    function database($config)
    {
        $db = new Medoo\Medoo($config);
        return $db;
    }
}

if (!file_exists('config')) {
    function config($file, $key = false) {
        $config = new \bihuo\Config();
        return $config->get($file, $key);
//        $config = require_once '../custom.php';
//        if ($Key && isset($config[$Key])) {
//            return $config[$Key];
//        }
//        return $config;
    }
}