<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author Tomek
 */
class Router
{

    private $path;

    private $args = array();

    public $file;

    public $controller;

    public $action;
    
    private static $auth;

    function __construct()
    {
    }
    
    public static function setAuth($auth)
    {
        self::$auth = $auth;
    }
    
    function setPath($path)
    {
        if (is_dir($path) == false) {
                throw new Exception ('Invalid controller path: `' . $path . '`');
        }
        
        $this->path = $path;
    }
    
    public function loader()
    {
        /*** check the route ***/
        if (empty($this->controller)) {
            $this->getController();
        }

        
        /*** set the file path ***/
        $this->file = $this->path . DS . $this->controller . 'Controller.php';
        
        /*** if the file is not there diaf ***/
        if (is_readable($this->file) == false)
        {
                echo $this->file;
                //die ('404 Not Found');
        }

        /*** include the controller ***/
        include $this->file;

        /*** a new controller class instance ***/
        $class = $this->controller . 'Controller';
        
        /* @var $controller ControllerBase */
        $controller = new $class($this->args);

        /*** check if the action is callable ***/
        if (is_callable(array($controller, $this->action)) == false)
        {
                $action = 'index';
        }
        else
        {
                $action = $this->action;
        }
        
        if (!$controller->accessGranted($action)) {
            if ($controller->isAjax($action)) {
                $this->controller = 'Error';
                $this->action = 'ajaxAccessDenied';
            } else {
                if (self::$auth->isLoggedIn()) {
                    $this->controller = 'Error';
                    $this->action= 'htmlAccessDenied';
                } else {
                    $this->controller = 'Login';
                    $this->action = 'index';
                }
            }
            $this->loader();
            return;
        }
        
        $controller->$action();
        
    }
    
    private function getController()
    {

        /*** get the route from the url ***/
        $route = (empty($_GET['r'])) ? '' : $_GET['r'];

        if (empty($route))  {
                $route = 'Index';
        } else {
            /*** get the parts of the route ***/
            $parts = explode('/', $route);
            if (empty($parts[count($parts)-1])) {
                unset($parts[count($parts)-1]);
            }
            $this->controller = $parts[0];
            if (isset( $parts[1])) {
                    $this->action = $parts[1];
            }
            
            foreach ($parts as $key => $part) {
                if ($key < 2) {
                    continue;
                }
                $this->args[] = $part;
            }
        }

        if (empty($this->controller)) {
                $this->controller = DEFAULT_CONTROLLER;
        }

        /*** Get action ***/
        if (empty($this->action)) {
                $this->action = 'index';
        }
        
    }
    
 
}
