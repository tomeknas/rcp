<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author Tomek
 */
class IndexController extends ControllerBase
{
   
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->requireUserAccess('index');
    }
    
    public function index()
    {
    }
}
