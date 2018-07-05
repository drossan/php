<?php

namespace  Grdar\core\Paths;

class Paths{

    public static $protocol;
    public static $server_name;
    public static $uri;
    public static $localhost;
    public static $url;
    public static $current_url;
    public static $absolute;

    public function __construct(){
        
        global $settings;
        self::$protocol = "http://";
        self::$server_name = $_SERVER['SERVER_NAME'];
        self::$uri = $_SERVER['REQUEST_URI'];
        self::$localhost = self::$protocol . self::$server_name;
        self::$current_url = self::$localhost . self::$uri;

        self::$absolute = $settings['paths']['absolute'];
    }
}