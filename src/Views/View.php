<?php 
namespace Drossan\core\Views;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Zend\Diactoros\Response\HtmlResponse;

class View
{
    const PATH_VIEWS  = PATH_VIEWS;
    const PATH_CACHE = PATH_CACHE;

    private $templateEngine;
    
    public function __construct()
    {
        $loader = new FilesystemLoader(self::PATH_VIEWS);
        $this->templateEngine =  new Environment($loader, [
            'debug' => true,
            'cache' => self::PATH_CACHE,
        ]);
    }

    public function renderHTML($fileName, $data = [])
    {
        return new HtmlResponse($this->templateEngine->render($fileName, $data));
    }
}
