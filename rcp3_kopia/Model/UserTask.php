<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usertask
 *
 * @author Tomek
 */
class UserTask extends ActiveRecord
{
    protected $_userId;
    protected $_taskId;
    protected $_begin;
    protected $_end;
    protected $_comment;
    
    protected $_duration_C;
    protected $_beginTime_C;
    protected $_endTime_C;
    
    
    protected static $_tableFields = array(
            '_userId' => 'user_id',
            '_taskId' => 'task_id',
            '_begin' => 'start',
            '_end' => 'stop',
            '_comment' => 'komentarz'
        );
    
    public function compute() {
        $this->setComputed('duration', $this->duration());
        $this->setComputed('beginTime', \date('H:i', \strtotime($this->_begin)));
        $this->setComputed('endTime', \date('H:i', \strtotime($this->_end)));
    }
    
    public function duration()
    {
        return (\strtotime($this->_end) - \strtotime($this->_begin)) / 3600;
    }
    
    public function validate()
    {
        $collidingUserTask = $this->getWhere(
            "user_id = {$this->userId}
            AND stop > '{$this->begin}'
            AND start < '{$this->end}'
            AND id != '{$this->id}'
            LIMIT 1");
        
        if (\count($collidingUserTask) > 0) {
            throw new \Exception('Entry collision');
        }
        
    } // end validate()
    
    /**
     * 
     * @return \User
     */
    public function getUser()
    {
        $user = new User;
        $user->loadById($this->_userId);
        return $user;
    }
    
    /**
     * 
     * @param \User $user
     * @return \Usertask    Returns $this for fluent interface.
     */
    public function setUser(\User $user)
    {
        $this->_userId = $user->getId();
        return $this;
    }
    
    /**
     * 
     * @return \Task
     */
    public function getTask()
    {
        $task = new Task;
        $task->loadById($this->_taskId);
        return $task;
    }
    
    /**
     * 
     * @param \Task $task
     * @return \Usertask    Returns $this for fluent interface.
     */
    public function setTask(\Task $task)
    {
        $this->_taskId = $task->getId();
        return $this;
    }
    
}
