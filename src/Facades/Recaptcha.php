<?php 
namespace Grdar\core\Facades;

use  Grdar\core\Facades\Facade;

class Recaptcha extends Facade
{
    public static function getAccessor()
    {
        return 'Recaptcha';
    }
}