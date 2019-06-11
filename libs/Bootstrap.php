<?php

class Bootstrap
{

    function __construct()
    {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        if (empty($url[0])){
            require 'controllers/index.php';
            $controller = new Index(); 
            $controller->index();
            return false;//stops running the statement after doing the above
        }

        $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            $this->error();
        }

        $controller = new $url[0];
        $controller->loadModel($url[0]);

        //calling methods
        if(isset($url[2])) {
            if (method_exists($controller, $url[1])){
                $controller->{$url[1]}($url[2]);
            } else {
                $this->error();
            }
        } else {
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    $controller->{$url[1]}();                
            } else {
                $this->error();//this SHOULD control any errors, but it isn't
                }
            } else {
                $controller->index();
            }
        }
    }
    public function error() {
        require 'controllers/error_404.php';
        $controller = new Error_404();
        $controller->index();
        return false;

    }

}
