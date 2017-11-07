<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectReport
 *
 * @author Tomek
 */
class ProjectReport extends ActiveRecord
{
    protected $_project;
    
    
    protected $_usersIds = array();
    
    public $data = array();
    public $tasks = array();
    public $users = array();
    public $projectId;
    
    public $usersTotal = array();
    public $tasksTotal = array();
    public $total = 0;
    
    private $_userTasks = array();
    
    public function __construct($projectId, $yearFrom = 0, $monthFrom = 0, $yearTo = 0, $monthTo = 0)
    {
        $this->projectId = $projectId;
        $this->_project = new Project;
        $this->_project->loadById($projectId);
        $this->tasks = $this->_project->getTasks();
        
        
        
        $query = "SELECT ut.user_id, ut.task_id, ut.start, ut.stop FROM user_tasks ut, tasks ta
                    WHERE ut.task_id = ta.id AND ta.project_id = {$projectId}";
        
        if ($yearFrom && $monthFrom && $yearTo && $monthTo) {
            $dateFrom = \date(DATE_FORMAT_MYSQL, \mktime(0, 0, 0, $monthFrom, 1, $yearFrom));
            $dateTo = \date(DATE_FORMAT_MYSQL, \mktime(23, 59, 59, $monthTo, \cal_days_in_month(1, $monthTo, $yearTo), $yearTo));
            $query .= " AND ut.start >= '{$dateFrom}' AND ut.start <= '{$dateTo}'";
        }
        
        /* @var $res \mysqli_result */
        $res = self::$_mysqli->query($query);
        
        while ($row = $res->fetch_row()) {
            if (!\in_array($row[0], $this->_usersIds)) {
                $this->_usersIds[] = $row[0];
            }
            $userTask = new UserTask;
            $userTask->userId = $row[0];
            $userTask->taskId = $row[1];
            $userTask->begin = $row[2];
            $userTask->end = $row[3];
            $this->_userTasks[] = $userTask;
        }
        
        foreach($this->tasks as $task) {
            $this->data[$task->id] = array();
            $this->tasksTotal[$task->id] = 0;
            foreach($this->_usersIds as $userId) {
                $this->usersTotal[$userId] = 0;
                $this->data[$task->id][$userId] = 0;
            }
        }
        
        foreach($this->_usersIds as $userId) {
            $user = new User;
            $user->loadById($userId);
            $this->users[] = $user;
        }
        
        foreach($this->_userTasks as $userTask) {
            $this->data[$userTask->taskId][$userTask->userId] += $userTask->duration();
            $this->usersTotal[$userTask->userId] += $userTask->duration();
            $this->tasksTotal[$userTask->taskId] += $userTask->duration();
            $this->total += $userTask->duration();
        }
    }
}
