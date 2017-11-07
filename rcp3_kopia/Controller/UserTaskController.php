<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserTaskController
 *
 * @author Tomek
 */
class UserTaskController extends ControllerBase
{
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->requireUserAccess('add');
        $this->requireUserAccess('update');
        $this->requireUserAccess('delete');
        $this->addAjax('add');
        $this->addAjax('update');
        $this->addAjax('delete');
    }
    
    public function accessGranted($action) {
        if (!parent::accessGranted($action)) {
            return false;
        }
        
        $user = self::$auth->getUser();
        if ($action == 'add') {
            return ( !empty($this->args) && ($this->args[0] == $user->id || $user->accessLevel >= 2) );
        }
        
        if ($action == 'update') {
            return ( \count($this->args) == 4 );
        }
        
        return true;
    }
    
    public function index()
    {
        
    }
    
    public function add()
    {
        $userTask = new UserTask;
        $userTask->userId = $this->args[0];
        $year = $this->args[1];
        $month = $this->args[2];
        $day = $this->args[3];
        
        $beginTimeStamp = \mktime($_POST['begin_Hour'], $_POST['begin_Minute'], 0, $month, $day, $year);
        $endTimeStamp = \mktime($_POST['end_Hour'], $_POST['end_Minute'], 0, $month, $day, $year);
        
        $userTask->begin = \date(DATE_FORMAT_MYSQL, $beginTimeStamp);
        $userTask->end = \date(DATE_FORMAT_MYSQL, $endTimeStamp);
        
        if ($beginTimeStamp > $endTimeStamp) {
            $userTask->end = \date(DATE_FORMAT_MYSQL, \strtotime($userTask->end . ' +1 day'));
        }
        
        $userTask->taskId = $_POST['task_id'];
        $userTask->comment = $_POST['comment'];
        
        try {
            $userTask->validate();
            $userTask->store();
            echo 'Stored.';
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    public function update()
    {
        $userTask = new UserTask;
        $userTask->loadById($this->args[0]);
        
        $year = $this->args[1];
        $month = $this->args[2];
        $day = $this->args[3];
        
        $beginTimeStamp = \mktime($_POST['begin_Hour'], $_POST['begin_Minute'], 0, $month, $day, $year);
        $endTimeStamp = \mktime($_POST['end_Hour'], $_POST['end_Minute'], 0, $month, $day, $year);
        
        $userTask->begin = \date(DATE_FORMAT_MYSQL, $beginTimeStamp);
        $userTask->end = \date(DATE_FORMAT_MYSQL, $endTimeStamp);
        
        if ($beginTimeStamp > $endTimeStamp) {
            $userTask->end = \date(DATE_FORMAT_MYSQL, \strtotime($userTask->end . ' +1 day'));
        }
        
        $userTask->taskId = $_POST['task_id'];
        $userTask->comment = $_POST['comment'];
        
        try {
            $userTask->validate();
            $userTask->update();
            echo 'Updated.';
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    public function delete()
    {
        try {
            $userTask = new UserTask;
            $userTask->loadById($this->args[0]);
            $userTask->delete();
            echo 'Deleted.';
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
            echo $e->getMessage();
        }
    }
}
