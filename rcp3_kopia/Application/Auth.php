<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Auth
 *
 * @author Tomek
 */
class Auth
{
   /**
     *
     * @var User
     */
    private $_user;
    
    /**
     *
     * @var boolean
     */
    private $_isLoggedIn = false;
    
    private $_userPermissions = array();
    
    public function __construct()
    {
        $this->_user = new User;
        \session_start();
        if (isset($_SESSION['user_id'])) {
            $this->_isLoggedIn = true;
            $this->_user->loadById($_SESSION['user_id']);
            $this->loadPermissions();
        }
    }
    
    public function login($username, $password)
    {
        /* @var $matchingUsers User[] */
        $matchingUsers = $this->_user->getWhere("nazwa = '{$username}' AND haslo = '{$password}' LIMIT 1");
        if (empty($matchingUsers)) {
            $this->logout();
            throw new Exception('Błąd logowania.');
        }
        
        $this->_user = $matchingUsers[0];
        $_SESSION['user_id'] = $this->_user->id;
        $this->_isLoggedIn = true;
        $this->loadPermissions();
    }
    
    public function loginByUserId($userId) {
        $_SESSION['user_id'] = $userId;
        $this->_user->loadById($userId);
        $this->_isLoggedIn = true;
        $this->loadPermissions();
    }
    
    public function logout()
    {
        \session_unset();
        \session_destroy();
        $this->_isLoggedIn = false;
    }
    
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
    
    public function getUser()
    {
        return $this->_user;
    }
    
    private function loadPermissions()
    {
        $permissions = $this->_user->getPermissions();
        foreach ($permissions as $userPermission) {
            $this->_userPermissions[$userPermission->resource] = $userPermission->accessLevel;
        }
    }
    
    public function isAllowed($resource, $minAccessLevel = 1)
    {
        return $this->_userPermissions[$resource] >= $minAccessLevel;
    }


}
