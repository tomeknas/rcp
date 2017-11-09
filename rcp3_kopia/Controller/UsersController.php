<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author Tomek
 */
class UsersController extends ControllerBase
{
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->requireUserAccess('index', 2);
        $this->requireUserAccess('report', 2);
        $this->requireUserAccess('report2', 2);
        
    }
    
    public function index()
    {
        $user = self::$auth->getUser();
        
        $userList = $user->getWhere('TRUE ORDER BY nazwisko ASC');
        
        self::$view->assign('user', $user);
        self::$view->assign('userList', $userList);
        self::$view->display('Views/users_index.tpl');
    }
    
    public function report()
    {
        $user = self::$auth->getUser();
        
        $report = null;
        $allTime = true;
        if (count($this->args) < 4) {
            $report = new WorkCard2;
        } else {
            $report = new WorkCard2($this->args[0], $this->args[1], $this->args[2], $this->args[3]);
            $allTime = false;
        }
        self::$view->assign('user', $user);
        self::$view->assign('report', $report);
        self::$view->assign('args', $this->args);
        self::$view->display('Views/work_card.tpl');
    }
    
    public function report2()
    {
        $user = self::$auth->getUser();
        $users = $user->getWhere('TRUE ORDER BY nazwisko ASC');
        $monthNames = array( 1 =>
            'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
            'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'
        );
        self::$view->assign('user', $user);
        self::$view->assign('users', $users);
        self::$view->assign('monthNames', $monthNames);
        self::$view->display('Views/over_hours.tpl');
    }
    
    public function leaves()
    {
        $user = self::$auth->getUser();
        $users = $user->getWhere('TRUE ORDER BY nazwisko ASC');
        $monthNames = array( 1 =>
            'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
            'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'
        );
        self::$view->assign('user', $user);
        self::$view->assign('users', $users);
        self::$view->assign('monthFilter', $this->args[0]);
        self::$view->assign('monthNames', $monthNames);
        self::$view->display('Views/leaves.tpl');
    }
    
    public function updateLeaves2014()
    {
        $user = new User();
        $user->loadById($this->args[0]);
        $user->leaves2014 = $_POST['new_value'];
        $user->update();
    }
    
    public function updateLeaves()
    {
        $user = new User();
        $user->loadById($this->args[0]);
        $user->leaves = $_POST['new_value'];
        $user->update();
    }
    
    public function updateHoursDaily()
    {
        $user = new User();
        $user->loadById($this->args[0]);
        $user->hoursDaily = $_POST['new_value'];
        $user->update();
    }
     public function updateName()
    {
        $user = new User();
        $user->loadById($this->args[0]);
        $user->firstName = $_POST['new_name'];
        $user->lastName = $_POST['new_lastname'];
        $user->update();
    }

    public function delete()
    {
        $user = new User();
        $user->loadById($this->args[0]);
        $user->delete();

    }
    
    public function updateOverHours()
    {
        $overHour = new OverHour();
        $newRecord = false;
        $overHourQuery = $overHour->getWhere(
                "user_id = {$this->args[0]}"
                . " AND year = {$this->args[1]}"
                . " AND month = {$this->args[2]}"
                . " AND day = {$this->args[3]}"
                . " LIMIT 1"
            );
        if (\count($overHourQuery) > 0)
        {
            $overHour = $overHourQuery[0];
        } else {
            $overHour->userId = $this->args[0];
            $overHour->year = $this->args[1];
            $overHour->month = $this->args[2];
            $overHour->day = $this->args[3];
            $newRecord = true;
        }
        $overHour->value = $_POST['new_value'];
        if ($newRecord)
        {
            $overHour->store();
        } else
        {
            $overHour->update();
        }
        if ($overHour->value == 0)
        {
            $overHour->delete();
        }
    }
    
    public function addUser()
    {
        $user = self::$auth->getUser();
        
        self::$view->assign('user', $user);
        self::$view->display('Views/users_add.tpl');
    }
    
    public function newUser()
    {
        $newUser = new User;
        
        $newUser->firstName= $_POST['first_name'];
        $newUser->lastName= $_POST['last_name'];
        $newUser->username= $_POST['username'];
        $newUser->password= $_POST['password'];
        $newUser->hoursDaily= $_POST['hours_daily'];
        
        try {
            $newUser->store();
            echo 'Dodano użytkownika: ' . $newUser->getFullName();
        } catch (Exception $e) {
            \header('HTTP/1.1 400' . $e->getMessage());
            echo $e;
        }
    }
    
}
