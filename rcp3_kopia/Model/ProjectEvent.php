<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectEvent
 *
 * @author Tomek
 */
class ProjectEvent extends ActiveRecord {
    protected $_time;
    protected $_userId;
    protected $_event;
    protected $_projectId;
    protected $_acceptedBy;
    protected $_acceptedTime;
    
    
    protected static $_tableFields = array(
        '_time' => 'time',
        '_userId' => 'user_id',
        '_event' => 'event',
        '_projectId' => 'project_id',
        '_acceptedBy' => 'accepted_by',
        '_acceptedTime' => 'accepted_time'
    );
    
    public function getUser()
    {
        $user = new User;
        $user->loadById($this->_userId);
        return $user;
    }
    
    public function getAccepts()
    {
        if (!$this->_acceptedBy) {
            return null;
        }
        $user = new User;
        $user->loadById($this->_acceptedBy);
        return $user;
    }
}
