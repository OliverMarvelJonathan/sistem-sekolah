<?php

namespace App\Core;

use App\Controllers\StudentController;
class router
{

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if($method == 'GET' && $uri == '/students'){
           require_once 'App/controllers/StudentController.php';
           $controler = new StudentController();
            $controler->index();
            return;
        }
        
        if($method == 'GET' && $uri == '/students'){
            require_once '../app/controllers/StudentController.php';
           $controler = new StudentController();
            $controler->index();
            return;
        }
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
    }

} 