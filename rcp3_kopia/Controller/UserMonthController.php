<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserMonth
 *
 * @author Tomek
 */
class UserMonthController extends ControllerBase
{
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->requireUserAccess('index');
    }
    
    public function accessGranted($action) {
        if (!parent::accessGranted($action)) {
            return false;
        }
        
        $user = self::$auth->getUser();
        if ($action == 'index') {
            return (empty($this->args) || $this->args[0] == $user->id || $user->accessLevel >= 2);
        }
        
        return true;
    }
    
    public function index()
    {
        $user = self::$auth->getUser();
        
        $year = 0;
        $month = 0;
        $calendarUser = new User;
        
        if (!empty($this->args)) {
            $calendarUser->loadById($this->args[0]);
        } else {
            $calendarUser = $user;
        }
        
        if (\count($this->args) < 3) {
            $year = \date('Y');
            $month = \date('n');
        } else {
            $year = (int)$this->args[1];
            $month = (int)$this->args[2];
        }
        
        $cal = new Calendar($calendarUser, $year, $month);
        $groupObject = new Group;
        $mediabox = new Mediabox($user->id);
        self::$view->assign('showMediabox', $mediabox->visible());
        
        self::$view->assign('user', $user);
        self::$view->assign('cal', $cal);
        
        
        self::$view->assign('groups', $groupObject->getWhere());
        //self::$view->assign('projects', $projectsObject->getWhere('1=1 ORDER BY nazwa ASC'));
        self::$view->display('Views/user_month.tpl');
    }
    
    public function summary()
    {
        $year = 2015;
        $userObject = new User;
        $users = $userObject->getWhere('true order by nazwisko asc');
        $me = self::$auth->getUser();
        echo '<table border=1 cellspacing=0>';
        echo '<tr>';
        echo '<th></th>';
        for($month = 1; $month < (date('Y') == $year ? date('n') : 13); ++$month)
        {
            $cal = new Calendar($me, $year, $month);
            echo '<th colspan=\''.count($cal).'\'>'.$cal->monthName.'</th>';
        }

        echo '</tr>';
        foreach($users as /* @var $user User */ $user)
        {
            echo '<tr>';
            echo '<th>' . $user->getFullName() . '</th>';
            for($month = 1; $month < (date('Y') == $year ? date('n') : 13); ++$month)
            {
                foreach(new Calendar($user, $year, $month) as $calDay)
                    echo '<td>' . $calDay->overHoursDaily . '</td>';
            }
            
            echo '</tr>';
        }
        echo '</table>';
        
        
        self::$view->assign('me', $me);
        self::$view->assign('calObj', $calObject);
        self::$view->assign('userObj', $userObj);
        
    }
}
