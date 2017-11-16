<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of User
 *
 * @author Tomek
 */
class User extends ActiveRecord
{
    protected $_firstName;
    protected $_lastName;
    protected $_username;
    protected $_password;
    protected $_accessLevel = 1;
    protected $_leaves = 0;
    protected $_leaves2014 = 0;
    protected $_hoursDaily = 8;
    protected $_archive;
    
    protected static $_tableFields = array(
        '_firstName' => 'imie',
        '_lastName' => 'nazwisko',
        '_username' => 'nazwa',
        '_password' => 'haslo',
        '_accessLevel' => 'perm',
        '_leaves' => 'leaves',
        '_leaves2014' => 'leaves2014',
        '_hoursDaily' => 'hours_daily',
        '_archive' => 'archives',
       );
    
    public function getFullName() {
        return $this->_firstName . ' ' . $this->_lastName;
    }
    
    public function isProjectManager()
    {
        $projectObject = new Project;
        $rows = $projectObject->getWhere("kierownik_id = {$this->_id} LIMIT 1");
        return \count($rows) > 0;
    }
    
    public function getPermissions()
    {
        $userPermissionObject = new UserPermission;
        return $userPermissionObject->getWhere("user_id = {$this->id}");
    }
    
    public function getUserTasksByDay($year, $month, $day)
    {
        if (!\is_numeric($year) || !\is_numeric($month) || !\is_numeric($day)) {
            throw new \Exception('Invalid date.');
        } 
        $userTask = new UserTask;
        return $userTask->getWhere("user_id = {$this->_id} AND YEAR(start) = {$year} AND MONTH(start) = {$month} AND DAY(start) = {$day} ORDER BY start ASC");
    }
    
    public function getOverHours($year)
    {
        $result = array();
        $total = 0;
        $modTotal = 0;
        $takenTotal = 0;
        $currentMonth = \date('m');
        $currentDay = \date('d');
        for ($month = 1; $month <= $currentMonth; ++$month)
        {
            $result[$month] = array();
            $calendar = new Calendar($this, $year, $month);
            for ($day = 1; $day <= \count($calendar); ++$day)
            {
                if ($month == $currentMonth && $day == $currentDay)
                {
                    break;
                }
                $result[$month][$day] = array();
                $result[$month][$day]['count'] = $calendar[$day]->overHoursDaily;
                $result[$month][$day]['isHoliday'] = $calendar[$day]->isHoliday;
                $result[$month][$day]['taken'] = $calendar[$day]->overHoursTaken;
                $result[$month][$day]['leaves'] = $calendar[$day]->leaves;
                $overHourObject = new OverHour();
                $modQuery = $overHourObject->getWhere("user_id = {$this->_id} AND year = $year AND month = $month AND day= $day LIMIT 1");
                $mod = 0.0;
                if (\count($modQuery) > 0)
                {
                    $mod = $modQuery[0]->value;
                }
                $result[$month][$day]['mod'] = $mod;
                $total += $result[$month][$day]['count'];
                $modTotal += $mod;
                $takenTotal += $result[$month][$day]['taken'];
                $leavesTotal += $result[$month][$day]['leaves'];
            }
            
        }
        return array(
            'daily' => $result, 
            'total' => $total, 
            'modTotal' => $modTotal, 
            'takenTotal' => $takenTotal, 
            'leavesTotal' => $leavesTotal
                );
    }
}
