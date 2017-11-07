<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Task
 *
 * @author Tomek
 */
class Task extends ActiveRecord
{
    protected $_projectId;
    protected $_name;
    protected $_begin;
    protected $_end;
    protected $_progress;
    
    
    protected static $_tableFields = array(
        '_projectId' => 'project_id',
        '_name' => 'nazwa',
        '_begin' => 'begin',
        '_end' => 'end',
        '_progress' => 'progress'
    );
    
    public function getProject() {
        $project = new Project;
        $project->loadById($this->_projectId);
        return $project;
    }
   
}
