<?php

require_once("./src/main/project/controller/AdminTextController.php");

class Router
{
    private $routeController = "./src/main/project/controller/";
    private $controller;
    private $controllerMethod;
    private $params;
    public const ROUTE_JS = '/src/main/resources/js';
    public const ROUTE_CSS = '/src/main/resources/css';
    public const ROUTE_IMG = '/src/main/resources/media/img';

    //Ejemplo de URL
    //http://localhost/?Controller=AdminText&method=getAll

    private function checkMediaImgRoute($uri)
    {
        $urlExploited = explode("/", $uri);
        $routeMediaExploded = explode("/", self::ROUTE_IMG);
        for ($i = 0; $i < count($routeMediaExploded); $i++) {
            if ($urlExploited[$i] !== $routeMediaExploded[$i]) {
                return false;
            }
        }
        return true;
    }

    private function checkJsRoute($uri)
    {
        $urlExploited = explode("/", $uri);
        $routeMediaExploded = explode("/", self::ROUTE_JS);
        for ($i = 0; $i < count($routeMediaExploded); $i++) {
            if ($urlExploited[$i] !== $routeMediaExploded[$i]) {
                return false;
            }
        }
        return true;
    }

    private function checkCssRoute($uri)
    {
        $urlExploited = explode("/", $uri);
        $routeMediaExploded = explode("/", self::ROUTE_CSS);
        for ($i = 0; $i < count($routeMediaExploded); $i++) {
            if ($urlExploited[$i] !== $routeMediaExploded[$i]) {
                return false;
            }
        }
        return true;
    }

    public function matchRouter()
    {
        if (empty($_GET) && empty($_POST)) {
            if (isset($_SERVER['REQUEST_URI'])) {
                $uri = $_SERVER['REQUEST_URI'];
                if (
                    $this->checkJsRoute($uri) ||
                    $this->checkCssRoute($uri) ||
                    $this->checkMediaImgRoute($uri)
                ) {
                    $file = __DIR__ . '/' . $uri;
                    if (file_exists($file)) {
                        if ($this->checkJsRoute($uri)) {
                            header('Content-Type: application/javascript');
                        } else if ($this->checkCssRoute($uri)) {
                            header('Content-Type: text/css');
                        } else {
                            header('Content-Type: image/jpeg');
                            header('Content-Length: ' . filesize($file));
                            header('Cache-Control: no-store, no-cache, must-revalidate');
                        }
                        readfile($file);
                        exit();
                    }
                } else {
                    $controller = new AdminTextController();
                    $controller->goLanding();
                }
            }
        }
        if (!empty($_GET)) {
            $this->controller = $_GET['Controller'] . "Controller";
            $this->controllerMethod = $_GET['method'];
            $this->params = [];
            foreach ($_GET as $key => $value) {
                if ($key != $this->controller && $key != $this->controllerMethod) {
                    $this->params[$key] = $value;
                }
            }
            $this->constructorImport();
            $objectController = new $this->controller();
            call_user_func(array($objectController, $this->controllerMethod), $this->params);
        } elseif (!empty($_POST)) {
            $this->controller = $_POST['Controller'] . "Controller";
            $this->controllerMethod = $_POST['method'];
            $this->params = [];
            foreach ($_POST as $key => $value) {
                if ($key != $this->controller && $key != $this->controllerMethod) {
                    $this->params[$key] = $value;
                }
            }
            $this->constructorImport();
            $objectController = new $this->controller();
            call_user_func(array($objectController, $this->controllerMethod), $this->params);
        }
    }

    private function constructorImport()
    {
        $string = $this->routeController . $this->controller . ".php";
        require_once($string);
    }
}
