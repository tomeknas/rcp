<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaskPickup
 *
 * @author Tomek
 */
class TaskPickup extends ModelBase
{
    public $_projects = array();
    
    public function __construct()
    {
        $this->_modelBaseArray = '_projects';
        $projectObject = new Project;
        $taskObject = new Task;
        $this->_projects = $projectObject->getWhere();
        foreach ($this->_projects as /* @var $project Project */ $project) {
            $project['tasks'] = $project->getTasks();
        }
    }
}
