<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaskPickupController
 *
 * @author Tomek
 */
class TaskPickupController extends ControllerBase {
    
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->addAjax('getUserTask');
        $this->addAjax('getTasks');
        $this->addAjax('getProjects');
    }
    
    public function index() {}
    public function getProjects()
    {
        $projectObject = new Project;
        $projects = $projectObject->getWhere("group_id = {$this->args[0]} AND active = TRUE ORDER BY nazwa ASC");
        $result = array();
        foreach ($projects as $project) {
            $newProject = array(
                'id' => $project->id,
                'name' => $project->name
            );
            //$result[$project->id] = $project->name;
            $result[] = $newProject;
        }
        echo \json_encode($result);
    }
    public function getTasks()
    {
        $taskObject = new Task;
        $tasks = $taskObject->getWhere("project_id = {$this->args[0]}");
        $result = array();
        foreach ($tasks as $task) {
            $result[$task->id] = $task->name;
        }
        echo \json_encode($result);
    }
    public function getUserTask()
    {
        $userTask = new UserTask;
        $userTask->loadById($this->args[0]);
        $result = array();
        $result['id'] = $userTask->id;
        $result['taskId'] = $userTask->taskId;
        
        $taskObject = new Task;
        $task = $taskObject->loadById($userTask->taskId);
        $projectId = $task->projectId;
        
        $projectObject = new Project;
        $project = $projectObject->loadById($projectId);
        $groupId = $project->groupId;
        
        $result['projectId'] = $projectId;
        $result['groupId'] = $groupId;
        
        $begin = \strtotime($userTask->begin);
        $end = \strtotime($userTask->end);
        
        $result['beginHour'] = \date('H', $begin);
        $result['beginMinute'] = \date('i', $begin);
        $result['endHour'] = \date('H', $end);
        $result['endMinute'] = \date('i', $end);
        $result['end'] = $userTask->end;
        $result['comment'] = $userTask->comment;
        
        $tasks = $taskObject->getWhere("project_id = {$projectId}");
        foreach ($tasks as $task) {
            $result['tasks'][$task->id] = $task->name;
        }
        
        $projects = $projectObject->getWhere("group_id = {$groupId} AND active = TRUE");
        foreach ($projects as $project) {
            $result['projects'][$project->id] = $project->name;
        }
        
        echo \json_encode($result);
    }
}
