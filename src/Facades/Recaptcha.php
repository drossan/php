<?php 
namespace Drossan\core\Facades;

use  Drossan\core\Facades\Facade;

class Recaptcha extends Facade
{
    public static function getAccessor()
    {
        return 'Recaptcha';
    }
}