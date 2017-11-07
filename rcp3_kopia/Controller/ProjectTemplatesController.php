<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectTemplatesController
 *
 * @author Tomek
 */
class ProjectTemplatesController extends ControllerBase
{
    public function __construct($args = array()) {
        parent::__construct($args);
        
        $this->requireUserAccess('index', 2);
        $this->requireUserAccess('addTemplate', 2);
        $this->requireUserAccess('deleteTemplate', 2);
        
        $this->requireUserAccess('addTask', 2);
        $this->requireUserAccess('deleteTask', 2);
        
        $this->addAjax('addTemplate');
        $this->addAjax('deleteTemplate');
        $this->addAjax('addTask');
        $this->addAjax('deleteTask');
    }
 
    public function index()
    {
        $user = self::$auth->getUser();
        self::$view->assign('user', $user);
        $templateObject = new ProjectTemplate();
        self::$view->assign('templates', $templateObject->getWhere());
        self::$view->display('Views/project_templates.tpl');
    }
    
    public function addTemplate()
    {
        $projectTemplate = new ProjectTemplate();
        $projectTemplate->name = $_POST['template_name'];
        $projectTemplate->store();
    }
    
    public function deleteTemplate()
    {
        $projectTemplate = new ProjectTemplate();
        $projectTemplate->loadById($this->args[0]);
        $projectTemplate->delete();
    }
    
    public function renameTemplate()
    {
        $projectTemplate = new ProjectTemplate();
        $projectTemplate->loadById($this->args[0]);
        $projectTemplate->name = $_POST['template_new_name'];
        $projectTemplate->update();
    }
    
    public function addTask()
    {
        $projectTemplateTask = new ProjectTemplatesData();
        $projectTemplateTask->name = $_POST['task_name'];
        $projectTemplateTask->templateId = $this->args[0];
        $projectTemplateTask->store();
    }
    
    public function deleteTask()
    {
        $projectTemplateTask = new ProjectTemplatesData();
        $projectTemplateTask->loadById($this->args[0]);
        $projectTemplateTask->delete();
    }
    
    public function renameTask()
    {
        $projectTemplateTask = new ProjectTemplatesData();
        $projectTemplateTask->loadById($this->args[0]);
        $projectTemplateTask->name = $_POST['task_new_name'];
        $projectTemplateTask->update();
    }
    
}
