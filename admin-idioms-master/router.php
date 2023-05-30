<?php

require_once("./src/main/project/controller/frontController.php");
/**
 * Clase Enrutador
 */
class Router
{
    /**
     * Ruta estandar de los controladores
     */
    private $routeController = "./src/main/project/controller/";
    /**
     * Variable que indica el nombre del controlador, sin la parte de Controller, por ejemplo front yel controlador és frontController
     */
    private $controller;
    /**
     * Método del controlador que va a ser buscado
     */
    private $controllerMethod;
    /**
     * Parametros adicionales, array
     */
    private $params;
    /**
     * Ruta de los archivos de Javascript
     */
    public const ROUTE_JS = '/src/main/resources/js';
    /**
     * Ruta de los archivos css
     */
    public const ROUTE_CSS = '/src/main/resources/css';
    /**
     * Ruta de los archivos de imagenes
     */
    public const ROUTE_IMG = '/src/main/resources/media/img';

    //Ejemplo de URL
    //http://localhost/?Controller=AdminText&method=getAll

    /**
     * Comprueba si el parametro $url corresponde con la ruta de las imagenes, 
     * retorna true si es coincide o false si no.
     */
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

    /**
     * Comprueba si el parametro $url corresponde con la ruta de los scripts de Javascript, 
     * retorna true si es coincide o false si no.
     */
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

    /**
     * Comprueba si el parametro $url corresponde con la ruta de los ficheros de CSS, 
     * retorna true si es coincide o false si no.
     */
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

    /**
     * Comprueba el tipo de ruta en la peticion, si la ruta corresponde con la de los archivos CSS, JS
     * o imagenes, añadira las cabeceras consecuentes; si no coincide, renviara a la pagina principal.
     */
    private function checkRequestUri(){
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
            $controller = new frontController();
            $controller->goLanding();
        }
    }
    /**
     * Método principal. 
     * Comprueba si la peticion recibida contiene métodos GET o POST, si no tiene renvia al metodo 'checkResquestUri'
     * Si contiene un GET o POST, llamara a al controlador y su metodo pasado.
     */
    public function matchRouter()
    {
        if (empty($_GET) && empty($_POST)) {
            $this->checkRequestUri();
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

    /**
     * Contruye la ruta al controlador para ser llamada
     */
    private function constructorImport()
    {
        $string = $this->routeController . $this->controller . ".php";
        require_once($string);
    }
}
