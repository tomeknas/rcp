<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectsController
 *
 * @author Tomek
 */
class ProjectsController extends ControllerBase {
    
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->requireUserAccess('index');
        $this->requireUserAccess('consReport', 2);
        $this->requireUserAccess('report');
        $this->requireUserAccess('addForm', 2);
        $this->requireUserAccess('editForm');
        $this->requireUserAccess('docs', 5);
    }
    
    public function docs(){}
    
    public function index()
    {
        $user = self::$auth->getUser();
        self::$view->assign('user', $user);
        
        /*
        $projectObject = new Project;
        
        $projects = $projectObject->getWhere(($user->accessLevel < 2 ? "kierownik_id = {$user->id}" : '1=1') . ' ORDER BY nazwa ASC');
        $projectTotals = new ProjectTotals;
        
        self::$view->assign('totals', $projectTotals->totals);
        self::$view->assign('projects', $projects);
         * 
         */
        
        $projectTotals = new ProjectTotals2(self::$auth->getUser());
        
        self::$view->assign('groups', $projectTotals->totals);
        self::$view->assign('inactive', $projectTotals->inactive);
        self::$view->display('Views/projects_index2.tpl');
        
    }
    
    public function report()
    {
        $user = self::$auth->getUser();
        $userList = $user->getWhere();
        
        $project = new Project;
        $project->loadById($this->args[0]);
        $projectReport = null;
        $allTime = true;
        if (\count($this->args) < 5) {
            $projectReport = new ProjectReport($project->id);
        } else {
            $allTime = false;
            $projectReport = new ProjectReport($project->id, $this->args[1], $this->args[2], $this->args[3], $this->args[4]);
        }
        
        $projectEventObject = new ProjectEvent();
        
        self::$view->assign('allTime', $allTime);
        self::$view->assign('args', $this->args);
        self::$view->assign('report', $projectReport);
        self::$view->assign('user', $user);
        self::$view->assign('userList', $userList);
        self::$view->assign('project', $project);
        self::$view->assign('projectEvents', $projectEventObject->getWhere("project_id = {$project->id}"));
        self::$view->display('Views/projects_report.tpl');
        
        
    }
    
    public function test()
    {
        /*$user = self::$auth->getUser();
        $year = isset($this->args[0]) ? $this->args[0] : \date('Y');
        
        $consReport = new ConsReport($year);
        
        self::$view->assign('user', $user);
        self::$view->assign('report', $consReport);
        self::$view->assign('year', $year);
        self::$view->display('Views/projects_cons_report.tpl');*/
    }
    
    public function consReport()
    {
        $consReport = null;
        if (count($this->args) < 4) {
            $consReport = new ConsReport2;
        } else {
            $consReport = new ConsReport2(
                    $this->args[0], $this->args[1],
                    $this->args[2], $this->args[3]);
        }
        
        self::$view->assign('user', self::$auth->getUser());
        self::$view->assign('report', $consReport);
        self::$view->display('Views/projects_cons_report2.tpl');
    }
    
    public function addForm()
    {
        $user = self::$auth->getUser();
        $projectTemplateObject = new ProjectTemplate;
        $projectTemplates = $projectTemplateObject->getWhere();
        
        $groupObject = new Group;
        
        self::$view->assign('user', $user);
        self::$view->assign('userList', $user->getWhere());
        self::$view->assign('groupList', $groupObject->getWhere());
        self::$view->assign('templates', $projectTemplates);
        self::$view->display('Views/projects_add_form.tpl');
    }
    
    public function editForm()
    {
        $user = self::$auth->getUser();
        $project = new Project;
        $project->loadById($this->args[0]);
        
        $groupObject = new Group;
        
        self::$view->assign('user', $user);
        self::$view->assign('userList', $user->getWhere());
        self::$view->assign('groupList', $groupObject->getWhere());
        self::$view->assign('project', $project);
        self::$view->display('Views/projects_edit_form.tpl');
    }
    
}
