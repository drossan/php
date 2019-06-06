<?php
namespace Drossan\core\Controllers;

use Drossan\core\Views\View;

class Controller extends View 
{
	public function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        return $this->renderHTML('404.twig');
    }
}