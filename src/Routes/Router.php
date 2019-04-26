<?php
namespace Drossan\core\Routes;

use Aura\Router\RouterContainer;

use WoohooLabs\Harmony\Harmony,
	WoohooLabs\Harmony\Middleware\DispatcherMiddleware,
	WoohooLabs\Harmony\Middleware\HttpHandlerRunnerMiddleware,
	Zend\Diactoros\ServerRequestFactory,
	Zend\Diactoros\Response,
	Zend\HttpHandlerRunner\Emitter\SapiEmitter,
	Middlewares\AuraRouter,
	Drossan\core\Middlewares,
	Drossan\core\Middlewares\Load;

class Router {

    protected $container;
    protected $request;
    protected $routerContainer;
    protected $map;

	public function __construct()
	{
        $this->container = new \DI\Container();
		$this->routerContainer = new RouterContainer();
		$this->map = $this->routerContainer->getMap();
	}

	public function get($name, $uri, $controller, $method)
	{
		$this->map->get($name, $uri, [$controller, $method]);
	}

	public function patch($name, $uri, $controller, $method)
	{
		$this->map->patch($name, $uri, [$controller,$method]);
	}

	public function post($name, $uri, $controller, $method)
	{
		$this->map->post($name, $uri, [$controller,$method]);
	}

	public function delete($name, $uri, $controller, $method)
	{
		$this->map->delete($name, $uri, [$controller, $method]);
	}

	public function attach($namePrefix, $pathPrefix, $routes, $tokens = [])
	{
		$this->map->attach($namePrefix, $pathPrefix, function ($map) use($routes, $tokens) {
			$this->map->tokens($tokens);
			foreach ($routes as $key => $route) {
				$this->{$route[0]}($route[1], $route[2], $route[3], $route[4]);
			}
		});
	}

    public function run()
	{
        $this->request = ServerRequestFactory::fromGlobals($_SERVER, $_GET,$_POST, $_COOKIE, $_FILES);
        $matcher = $this->routerContainer->getMatcher();
		$route = $matcher->match($this->request);

		try{
			foreach ($route->attributes as $key => $val) {
				$this->request = $this->request->withAttribute($key, $val);
			}

			$harmony = new Harmony($this->request, new Response());
			$harmony->addMiddleware(new HttpHandlerRunnerMiddleware(new SapiEmitter()));

			if (getenv('DEBUG') === "true") {
				$harmony->addMiddleware(new \Franzl\Middleware\Whoops\WhoopsMiddleware);
			}

			$harmony->addMiddleware(new AuraRouter($this->routerContainer));
			foreach (Load::getMiddleware() as $key => $value) {
				$harmony->addMiddleware(new $value);
			}

			$harmony->addMiddleware(new DispatcherMiddleware($this->container, 'request-handler'));

			$harmony();
		} catch (Exception $e) {
			$log->error($e->getMessage());
			$emitter = new SapiEmitter();
			$emitter->emit(new Response\EmptyResponse(500));
		} catch (Error $e) {
			$emitter = new SapiEmitter();
			$emitter->emit(new Response\EmptyResponse(500));
		}
	}
}
