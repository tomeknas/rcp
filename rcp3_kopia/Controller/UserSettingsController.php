<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserSettingsController
 *
 * @author Tomek
 */
class UserSettingsController extends ControllerBase {
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->requireUserAccess('index');
        $this->requireUserAccess('passwordChange');
        $this->addAjax('passwordChange');
        
    }
    public function index()
    {
        $user = self::$auth->getUser();
        
        self::$view->assign('user', $user);
        self::$view->display('Views/user_settings.tpl');
    }
    
    public function passwordChange()
    {
        $user = self::$auth->getUser();
        
        if (\strlen($_POST['new_password']) < 5) {
            \header('HTTP/1.1 400 Nowe haslo jest za krotkie.');
            return;
        }
        try {
            $user->password = $_POST['new_password'];
            $user->update();
            echo 'Hasło zostało zmienione';
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
        }
        
    }
}
