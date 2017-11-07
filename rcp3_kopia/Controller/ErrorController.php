<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AjaxError
 *
 * @author Tomek
 */
class ErrorController extends ControllerBase {
    public function index() {}
    
    public function ajaxAccessDenied()
    {
        \header('HTTP/1.1 400 Access denied');
    }
    
    public function htmlAccessDenied()
    {
        echo 'Access denied.';
    }
}
