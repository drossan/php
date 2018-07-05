<?php 
namespace  Grdar\core\Views;
use Grdar\core\Container;

class View
{
    const INCLUDES  = PATH_INCLUDES;
    const VIEWS     = PATH_VIEWS;

    private static $template;
    private static $vars;
    private static $templateContent;
    

    public function isArray()
    {
        if(is_array(self::$vars)){
            return extract(self::$vars);
        }
        return get_object_vars(self::$vars);
    }

    public static function getInstance()
    {
        $container = Container::getInstance();
        return get_object_vars($container);
    }


    public static function html()
    {
       
        isset(self::$vars) ? $this->isArray() : false;
        self::getInstance();
        
        ob_start();
        echo '
        <!doctype html>
        <html lang="'.idioma(),'">';
            require self::INCLUDES .'head.php';
        echo '<body>'; 
            require self::INCLUDES . 'header.php'; 
            require self::VIEWS . self::$template . '.php';
            require self::INCLUDES . 'footer.php'; 
        echo '</body>
        </html>';
        
        self::$templateContent = ob_get_clean();
    }

    public static function view($template, $vars = null)
    {
        self::$template = $template;
        self::$vars     = $vars;
        self::html();
        return self::$templateContent;
    }

    public function abort404($message)
    {
        http_response_code(404);
        view('404');
        exit();
    }
}
