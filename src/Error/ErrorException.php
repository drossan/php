<?php 
namespace Drossan\core\Error;

use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Util\Misc;
use Whoops\Run;

class ErrorException
{
    private $run;

    public function __construct($ajax = true)
    {
        $this->run = new Run();
        $this->run->pushHandler(new PrettyPageHandler());
        
        if($ajax) $this->jsonResponseHandler();

        $this->run->register();
    }
    
    protected function jsonResponseHandler()
    {
        if (Misc::isAjaxRequest()) {
            $jsonHandler = new JsonResponseHandler();
            $jsonHandler->setJsonApi(true);
            $this->run->pushHandler($jsonHandler);
        }
    }
}