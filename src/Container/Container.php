<?php
namespace Drossan\core\Container;

class Container {
    public static $instance;

	public static function init()
	{
        if (static::$instance == null) {
            static::$instance = new \Illuminate\Container\Container();
        }

        return static::$instance;
    }
    
    public static function setConatiner($key, $instance)
    {
        static::$instance->instance($key, new $instance);
    }

    public static function getContainer()
    {
        return static::$instance;
    }
}