<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Project
 *
 * @author Tomek
 */
class Project extends ActiveRecord
{
    protected $_name;
    protected $_description;
    protected $_orderNumber;
    protected $_client;
    protected $_begin;
    protected $_end;
    protected $_projectManagerId;
    protected $_projectCoordinator;
    protected $_budget;
    protected $_budgetPLN;
    protected $_budgetPM;
    protected $_progress;
    protected $_groupId;
    protected $_sent;
    protected $_active = 1;
    protected $_status = 0;


    protected $_beginTimeStamp_C;
    protected $_endTimeStamp_C;
    protected $_projectManager_C;
    protected $_projectCoordinat_C;
    
    protected static $_tableFields = array(
        '_name' => 'nazwa',
        '_description' => 'opis',
        '_orderNumber' => 'nr_zlecenia',
        '_client' => 'klient',
        '_begin' => 'data_roz',
        '_end' => 'data_zak',
        '_projectManagerId' => 'kierownik_id',
        '_projectCoordinator' => 'koordynator',
        '_budget' => 'budget',
        '_budgetPLN' => 'budgetPLN',
        '_budgetPM' => 'budgetPM',
        '_progress' => 'progress',
        '_groupId' => 'group_id',
        '_sent' => 'sent',
        '_active' => 'active',
        '_status' => 'status'
    );
    
    public function groupName() {
        $groupObject = new Group;
        $groupObject->loadById($this->_groupId);
        return $groupObject->name;
    }
    
    private function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') == $date;
    }
        
    public function timeProgress()
    {
        
        if (!$this->validateDate($this->begin) || !$this->validateDate($this->end)) {
            return null;
        }
        
        if ($this->sent)
        {
            $current = $this->sent;
        } else
        {
            $current = \time();
        }
        
        $begin = \strtotime($this->begin);
        $end = \strtotime($this->end);
        
        
        if ($current < $begin) {
            return 0.;
        }
        
        if ($current > $end) {
//            return 100.;
        }
        
        return (float)($current - $begin) / ($end - $begin) * 100;
        
    }


    public function compute() {
        $this->setComputed('beginTimeStamp', \strtotime($this->_begin));
        $this->setComputed('endTimeStamp', \strtotime($this->_end));
        $projectManager = new User;
        $projectManager->loadById($this->_projectManagerId);
           // print_r($projectManager->getfullName());
        $this->setComputed('projectManager', $projectManager);
        $projectCoordinat = new User;
        $projectCoordinat->loadById($this->_projectCoordinator);
        $this->setComputed('projectCoordinat', $projectCoordinat);
    
    }
    
    public function getTasks()
    {
        $taskObject = new Task;
        return $taskObject->getWhere("project_id = $this->_id");
    }
}
