<?php

namespace App\Core;

use App\Controllers\StudentController;
class router
{
    private $routes = [];
    public function add(string $method, string $uri, string $controller, string $function)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'function' => $function,
        ];
    }
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach($this->routes as $router){
            $pattern = str_replace(
               '{id}',
                '([0-9]+)',
                $router['uri']
            );
            $pattern = '#^' . $pattern . '$#';
            if(preg_match($pattern, $uri, $matches)){
                require_once 'App/controllers/' . $route['controller'] . '.php';
                array_shift($matches);
                $controllerClass = 'App\Controllers\\' . $router['controller'];
                $controller = new $controllerClass();
                $function = $router['function'];
                call_user_func_array(callback: [$controller, $function], args:$matches);
                return;
            }
        }
            
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
    }

} 