<?php
namespace Drossan\core\Middlewares;

class Load
{
    public static $middleware = [];

    public static function loadMiddleware($middleware)
    {
        self::$middleware[] = $middleware;
    }

    public static function getMiddleware()
    {
        return self::$middleware;
    }
}