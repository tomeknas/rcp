<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author Tomek
 */
class LoginController extends ControllerBase
{
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->requireUserAccess('loginByUserId', 2);
        $this->addAjax('loginByUserId');
        
    }
    
    public function index()
    {
        self::$view->display('Views/login_page.tpl');
    }
    
    public function login()
    {
        try {
            self::$auth->login($_POST['user_name'], $_POST['password']);
            $userFullName = self::$auth->getUser()->getFullName();
            echo "Użytkownik {$userFullName} zalogowany.";
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . \json_encode($e->getMessage()));
            echo $e->getMessage();
        }
    }
    
    public function loginByUserId()
    {
        try {
            $newUser = new User;
            $newUser->loadById($this->args[0]);
            if (self::$auth->getUser()->accessLevel <= $newUser->accessLevel) {
                throw new Exception('Brak dostępu');
            }
            self::$auth->loginByUserId($this->args[0]);
            $userFullName = self::$auth->getUser()->getFullName();
            echo "Użytkownik {$userFullName} zalogowany.";
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . \json_encode($e->getMessage()));
            echo $e->getMessage();
        }
    }
    
    public function logout()
    {
        self::$auth->logout();
    }
}
