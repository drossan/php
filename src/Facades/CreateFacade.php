<?php 
namespace Drossan\core\Facades;


class CreateFacade extends Facade
{
    public function __construct($value, $key)
    {
        eval("
            class $value extends Drossan\\core\\Facades\\Facade {
                public static function getAccessor() 
                {
                    return '$key';
                }
            };"
        );
        class_alias("$value", $key);
    }
}