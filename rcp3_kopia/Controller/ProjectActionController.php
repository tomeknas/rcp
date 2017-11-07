<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectActionController
 *
 * @author Tomek
 */
class ProjectActionController extends ControllerBase
{
    
    public function __construct($args = array()) {
        parent::__construct($args);
        
        $this->requireUserAccess('add', 2);
        $this->requireUserAccess('edit');
        $this->requireUserAccess('delete', 2);
        $this->requireUserAccess('send');
        $this->requireUserAccess('close', 2);
        $this->addAjax('add');
        $this->addAjax('edit');
        $this->addAjax('delete');
        $this->addAjax('send');
        $this->addAjax('close');
    }
    
    public function index() {}
    
    public function add()
    {
        $project = new Project;
        $project->name = $_POST['name'];
        $project->description = $_POST['description'];
        $project->orderNumber = $_POST['order_number'];
        $project->client = $_POST['client'];
        $project->begin = $_POST['begin'];
        $project->end = $_POST['end'];
        $project->projectManagerId = $_POST['project_manager'];
        $project->budget = $_POST['budget'];
        $project->budgetPLN = $_POST['budgetPLN'];
        $project->groupId = $_POST['group'];
        
        
        try {
            $project->store();
            
            try {
                $projectTemplate = new ProjectTemplate;
                $projectTemplate->loadById($_POST['project_template']);

                $taskNames = $projectTemplate->getTaskNames();

                foreach ($taskNames as $taskName) {
                    $task = new Task;
                    $task->projectId = $project->id;
                    $task->name = $taskName;
                    $task->store();
                }
                echo 'Utworzono nowy projekt.';
                
                $projectEvent = new ProjectEvent();
                $projectEvent->time = time();
                $projectEvent->userId = self::$auth->getUser()->id;
                $projectEvent->projectId = $project->id;
                $projectEvent->event = "Utworzono projekt";
                $projectEvent->store();
            } catch (\Exception $e) {
                $project->delete();
                throw $e;
            }
        } catch (\Exception $e) {
            \header('HTTP/1.1 400' . $e->getMessage());
            echo $e;
        }
    }
    
    public function delete()
    {
        try {
            $project = new Project;
            $project->loadById($this->args[0]);
            $project->delete();
            echo "Usunięto projekt '{$project->name}'";
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
        }
    }
    
    public function edit()
    {
        $project = new Project;
        $project->loadById($this->args[0]);
        
        $project->name = $_POST['name'];
        $project->description = $_POST['description'];
        $project->orderNumber = $_POST['order_number'];
        $project->client = $_POST['client'];
        $project->begin = $_POST['begin'];
        $project->end = $_POST['end'];
        $project->projectManagerId = $_POST['project_manager'];
        $project->budget = $_POST['budget'];
        $project->budgetPLN = $_POST['budgetPLN'];
        $project->groupId = $_POST['group'];
        
        try {
            $project->update();
            echo 'Zapisano zmiany.';
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
        }
        
    }
    
    public function updateProgress()
    {
        try {
            $project = new Project;
            $project->loadById($this->args[0]);
            $project->progress = $_POST['new_progress'];
            $project->update();
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
        }
    }
    
    public function send()
    {
        try {
            $project = new Project;       
            $project->loadById($this->args[0]);
            echo $project->sent = \strtotime($_POST['project_sent_date']);
            $project->update();
            
            $projectEvent = new ProjectEvent();
            $projectEvent->time = time();
            $projectEvent->userId = self::$auth->getUser()->id;
            $projectEvent->projectId = $project->id;
            $projectEvent->event = "Wysyłka";
            $projectEvent->store();
            
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
        }
    }
    
    public function close()
    {
        try {
            $project = new Project;
            $project->loadById($this->args[0]);
            $project->active = !(bool)$project->active;
            $project->update();
            $projectEvent = new ProjectEvent();
            $projectEvent->time = time();
            $projectEvent->userId = self::$auth->getUser()->id;
            $projectEvent->projectId = $project->id;
            $projectEvent->event = "Zamknięcie projektu";
            $projectEvent->store();
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 ' . $e->getMessage());
        }
    }
    
    public function addTask()
    {
        $task = new Task;
        $task->projectId = $this->args[0];
        $task->name = $_POST['task_name'];
        
        try {
            $task->store();
            echo "Dodano zadanie '{$task->name}' ";
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 '. $e->getMessage());
        }
    }
    
    public function deleteTask()
    {
        try {
            $task = new Task;
            $task->loadById($this->args[0]);
            $task->delete();
            echo "Usunięto zadanie '{$task->name}'.";
        } catch (\Exception $e) {
            \header('HTTP/1.1 400 '. $e->getMessage());
        }
    }
    
    public function setTaskBegin()
    {
        $task = new Task;
        $task->loadById($this->args[0]);
        $task->begin = $_POST['new_begin'];
        $task->update();
    }
    
    public function setTaskEnd()
    {
        $task = new Task;
        $task->loadById($this->args[0]);
        $task->end = $_POST['new_end'];
        $task->update();
    }
    
    public function setTaskProgress()
    {
        $task = new Task;
        $task->loadById($this->args[0]);
        $task->progress = $_POST['new_progress'];
        $task->update();
    }
    
    public function setProjectStatus()
    {
        $project = new Project;
        $project->loadById($this->args[0]);
        $project->status = $_POST['new_status'];
        $project->update();
        $projectEvent = new ProjectEvent();
        switch($project->status)
        {
            case 0:
            //    $projectEvent->event = "Odrzucono harmonogram";
                break;
            case 1:
                $projectEvent->time = time();
                $projectEvent->projectId = $project->id;
                $projectEvent->userId = self::$auth->getUser()->id;
                $projectEvent->event = 'Utworzenie planu realizacji';
                $projectEvent->store();
                break;
            case 2:
                $projectEvents = $projectEvent->getWhere("project_id = {$project->id} AND event = 'Utworzenie planu realizacji' ORDER BY id DESC LIMIT 1");
                $projectEvent = $projectEvents[0];
                $projectEvent->acceptedBy = self::$auth->getUser()->id;
                $projectEvent->acceptedTime = time();
                $projectEvent->update();
                break;
        }
        
        //$projectEvent->store();
    }
}
