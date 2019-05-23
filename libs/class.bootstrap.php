<?php

class Bootstrap
{

    function __construct()
    {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        // $url = $_GET['url']; //is replaced by the above code
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        // $url = explode('/', $_GET['url']);
        // $$url = explode('/', filter_var(rtrim($_GET['url'], '/')), FILTER_SANITIZE_URL);

        if (empty($url[0])){
            require 'controllers/index.php';
            $controller = new Index(); 
            $controller->index();
            return false;//stops running the statement after doing the above

        }
        $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            
            // print_r($url); //debugging
            require $file;
        } else {
            require 'controllers/error_404.php';
            $controller = new Error_404();
            return false;//stops running the statement after doing the above
        }

        $controller = new $url[0];

        //calling methods
        //community solution to this:
                                        // method is set and exists
                                        if (isset($url[1]) && method_exists($controller, $url[1])) {
                                            if (isset($url[2])) {
                                                $controller->{$url[1]}($url[2]);
                                            } else {
                                                $controller->{$url[1]}();
                                            }

                                            // method is not set
                                        } elseif (!isset($url[1])) {
                                            $controller->index();

                                            // method is set but not exists
                                        } else {
                                            require "controllers/error.php";
                                            $error = new Error();
                                            $error->index('501: <code>\'' . $url[1] . '\'</code> not implemented!');
                                            return FALSE;
                                        }

        /*
        if (isset($url[2])) {
            if ($method_exists($controller, $url[1])){
            $controller->{$url[1]}($url[2]); //checking to see if there is an existing controller for this page
        }else{
            echo 'errrrrr';
            }
        } elseif (isset($url[1])) {
            $controller->{$url[1]}(); //this is checking to see if there are any values that can be passed into the function
        }else{
            $controller->index();
        } 
        */
    }
}
