<?php
namespace Grdar\core\Controllers;

use Grdar\core\Container;

class Controller{

	public static $container;

	public static function getInstance($intance, $var)
	{
		self::$container = Container::getInstance();
		self::$container->instance($intance, $var);
	}
}