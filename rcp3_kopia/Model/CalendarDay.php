<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of CalendarDay
 *
 * @author Tomek
 */
class CalendarDay extends ModelBase
{
    
    /**
     *
     * @var int
     */
    protected $_dayNum;
    protected $_monthNum;
    protected $_yearNum;
    
    protected $_isHoliday;
    protected $_isToday;
    
    protected $_totalDuration = 0;
    protected $_overHoursDaily = 0;
    protected $_overHoursTaken = 0;
    protected $_leaves = 0;
    protected $_overHoursSoFar;
    
    protected $_userTasksCount;
    
    /**
     *
     * @var User
     */
    protected $_user;
    
    /**
     *
     * @var UserTask[]
     */
    protected $_userTasks = array();
    
    /**
     * 
     * @return int 0: no holiday, 1: holiday, 2: holiday - additionally
     */
    
    public function getUserTasks() {
        return $this->_userTasks;
    }
    
    public function timestamp() {
        return \mktime(0, 0, 0, $this->_monthNum, $this->_dayNum, $this->_yearNum);
    }
    
    private function setIsHoliday()
    {
	$hol=array('01-01', '01-06', '05-01','05-03','08-15','11-01','11-11','12-25','12-26'); 
	$dodatkowo_wolne = array('2014-11-10');
	$data = new \DateTime();
	$data->setDate($this->_yearNum, $this->_monthNum, $this->_dayNum);
	if (\in_array($data->format('Y-m-d'), $dodatkowo_wolne)) {
            return $this->_isHoliday = 2;
        }
        $easter = \date('m-d', \easter_date($this->_yearNum));
	$date = \strtotime($this->_yearNum . '-' . $easter);  
	$easterSec = \date('m-d', \strtotime('+1 day', $date));  
	$cc = \date('m-d', \strtotime('+60 days', $date));  
	$hol[] = $easter;  
	$hol[] = $easterSec;  
	$hol[] = $cc; 
	$md = $data->format('m-d');
	$dw = $data->format('w');
	if (($dw == 0) || ($dw == 6) || \in_array($md, $hol)) {
            return $this->_isHoliday = 1;
        }
        return $this->_isHoliday = 0;
    }
    
    public function __construct(User $user, $year, $month, $day)
    {
        $this->_modelBaseArray = '_userTasks';
        $this->_user = $user;
        $this->_yearNum = $year;
        $this->_monthNum = $month;
        $this->_dayNum = $day;
        $this->setIsHoliday();
        $this->_isToday = (date('%Y-%m-%d') == date('%Y-%m-%d', $this->timestamp()));
        $this->_userTasks = $this->_user->getUserTasksByDay($year, $month, $day);
        $this->_userTasksCount = \count($this->_userTasks);
        foreach ($this->_userTasks as $userTask) {
            $this->_totalDuration += $userTask->duration;
            if ($userTask->taskId == 14) {
                $this->_overHoursTaken += $userTask->duration;
            }
            if ($userTask->taskId == 12) {
                $this->_leaves += $userTask->duration / (float)$this->_user->hoursDaily;
            }
        }
        $this->_overHoursDaily = $this->_totalDuration - ($this->_isHoliday ? 0 : (float)$this->_user->hoursDaily); 
    }
}
