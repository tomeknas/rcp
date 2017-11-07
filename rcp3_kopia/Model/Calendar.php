<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Calendar
 *
 * @author Tomek
 */
class Calendar extends ModelBase
{
    /**
     *
     * @var User
     */
    protected $_user;
    
    /**
     *
     * @var integer
     */
    protected $_daysCount;
    
    /**
     *
     * @var CalendarDay[]
     */
    protected $_calendarDays;
    
    protected $_yearNum;
    protected $_monthNum;
    
    protected $_monthName;


    protected $_nextMonth;
    protected $_nextMonthYear;
    protected $_prevMonth;
    protected $_prevMonthYear;
    
    protected $_summary = array();
    protected $_soFar = array();
    
    public function timestamp() {
        return \mktime(0, 0, 0, $this->_monthNum, 0, $this->_yearNum);
    }
        
    public function __construct(User $user, $year, $month)
    {
        $this->_modelBaseArray = '_calendarDays';
        $this->_user = $user;
        $this->_yearNum = $year;
        $this->_monthNum = $month;
        $this->_daysCount = \cal_days_in_month(1, $month, $year);
        for ($day = 1; $day <= $this->_daysCount; ++$day) {
            $this->_calendarDays[$day] = new CalendarDay($this->_user, $year, $month, $day);
        }
        $this->_nextMonth = $this->_monthNum == 12 ? 1 : $this->_monthNum + 1;
        $this->_nextMonthYear = $this->_monthNum == 12 ? $this->_yearNum + 1 : $this->_yearNum;
        $this->_prevMonth = $this->_monthNum == 1 ? 12 : $this->_monthNum - 1;
        $this->_prevMonthYear = $this->_monthNum == 1 ? $this->_yearNum - 1 : $this->_yearNum;
        $monthNames = array( 1 =>
                'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
                'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'
            );
        $this->_monthName = $monthNames[$this->_monthNum];
        
        
        $this->_summary['total'] = 0;
        $this->_summary['workingDays'] = 0;
        $this->_summary['totalsCount'] = 1;
        $this->_summary['projects'] = array();
        
        foreach ($this->_calendarDays as $dayNumber => $calendarDay) {
            foreach ($calendarDay as /* @var $userTask UserTask */ $userTask) {
                $task = $userTask->getTask();
                $project = $task->getProject();
                
                if(isset($this->_summary['projects'][$project->name]['tasks'][$task->name])) {
                    $this->_summary['projects'][$project->name]['tasks'][$task->name] += $userTask->duration;
                }
                else {
                    ++$this->_summary['totalsCount'];
                    $this->_summary['projects'][$project->name]['tasks'][$task->name] = $userTask->duration;
                }
                
                $this->_summary['total'] += $userTask->duration;
            }
            
            $this->_summary['workingDays'] += ($calendarDay->isHoliday ? 0 : 1);
            $this->_soFar['workingDays'][$dayNumber] = $this->_summary['workingDays'];
            $this->_soFar['total'][$dayNumber] = $this->_summary['total'];
        }
        
        foreach ($this->_summary['projects'] as $projectName => $project) {
            $this->_summary['projects'][$projectName]['total'] = 0;
            foreach ($project['tasks'] as $duration) {
                $this->_summary['projects'][$projectName]['total'] += $duration;
            }
        }
        
        $this->_summary['totalsCount'] += \count($this->_summary['projects']);
        $this->_summary['overHours'] = $this->_summary['total'] - (float)$this->_user->hoursDaily * $this->_summary['workingDays'];
    } // end __construct()
    
    public function overHoursSoFar($dayNumber) {
        return $this->_soFar['total'][$dayNumber] - (float)$this->_user->hoursDaily * $this->_soFar['workingDays'][$dayNumber];
    }
    
    public function getCalendarDays() {
        return $this->_calendarDays;
    }
    
    public function getUserTasks()
    {
        $result = array();
        for ($day = 1; $day <= $this->_daysCount; ++$day) {
            $result[$day] = $this->_calendarDays[$day]->getUserTasks();
        }
        
        return $result;
    }
    
}
