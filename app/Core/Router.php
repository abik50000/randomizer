<?php 

namespace App\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception;
use Symfony\Component\Routing\Route;

class Router
{   
    protected static $instance;

    protected function __construct() {}

    public static function getInstance()
    {
		if (self::$instance == null) {	
			self::$instance = new Router;
		}
		return self::$instance;
	}

    public function initialize(array $routes)
    {
        $routeCollection = new \Symfony\Component\Routing\RouteCollection();
        $this->fill($routeCollection, $routes);

        $this->processRequest($routeCollection);
    }

    private function fill(RouteCollection $routeCollection, array $routes)
    {
        foreach($routes as $route) {
            $methods = $route[0];
            $uri = $route[1];
            $controller = $route[2][0];
            $method = $route[2][1];
            $requirements = $route[3];
            $name = $route[4];
    
            $routeCollection->add(
                $name, 
                new Route(
                    $uri,
                    ['controller' => $controller, 'method'=> $method],
                    $requirements,
                    [],
                    '',
                    [],
                    $methods
                )
            );
        };
    }

    private function processRequest(RouteCollection $routes)
    {
        $context = new RequestContext();
        $context->fromRequest(Request::createFromGlobals());

        try {
            $arrayUri = explode('?', $_SERVER['REQUEST_URI']);
            $matcher = (new UrlMatcher($routes, $context))->match($arrayUri[0]);
            
            $callback = [
                new ('\\App\\Controllers\\' . $matcher['controller'])($routes),
                $matcher['method']
            ];

            $params = array_slice($matcher, 2, -1);

            call_user_func_array($callback, $params);
            
        } catch (Exception\MethodNotAllowedException $e) {
            response(405, 'Route method is not allowed.');
        } catch (Exception\ResourceNotFoundException $e) {
            response(404, 'Route does not exists.');
        } catch (\Throwable $e) {
            
            if(DEBUG_MODE) {
                echo $e->getMessage();
                exit();
            }
            response(500, 'Internal Server Error.');
        }
    }
}