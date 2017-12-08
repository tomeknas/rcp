<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectTotals2
 *
 * @author Tomek
 */
class ProjectTotals2 extends ActiveRecord {
    public $totals = array();
    public $inactive = array();
    
    public function __construct(User $user) {
        $query = "SELECT * FROM v_project_totals";
        if ($user->accessLevel < 2 && $user->isCoordinator() && !$user->isProjectManager()) {
            $query .=" WHERE coordinator_id = {$user->id}";
        } else if ($user->accessLevel < 2 && $user->isProjectManager() && !$user->isCoordinator()){
            $query .=" WHERE manager_id = {$user->id}";
        }
        else if ($user->accessLevel < 2 && $user->isCoordinator() && $user->isProjectManager()){
            $query .=" WHERE manager_id = {$user->id} OR coordinator_id = {$user->id}";
        }


        $res = self::$_mysqli->query($query);
       
             while($row = $res->fetch_row()) {
            if ($row[7] == 0) {
                $projectObject = new Project;
                $projectObject->loadById($row[2]);
                $project = array(
                    'id' => (int)$row[2],
                    'name' => $row[3],
                    'total' => (float)$row[4],
                    'project' => $projectObject
                );
                $this->inactive[] = $project;
                continue;
            }
            
            if (!isset($this->totals[$row[0]])){
                $this->totals[$row[0]]['name'] = $row[1];
                $this->totals[$row[0]]['projects'] = array();
                $this->totals[$row[0]]['count'] = 0;
            }
            $projectObject = new Project;
            $projectObject->loadById($row[2]);
            $project = array(
                'id' => (int)$row[2],
                'name' => $row[3],
                'total' => (float)$row[4],
                'project' => $projectObject
            );
            $this->totals[$row[0]]['projects'][] = $project;
            ++$this->totals[$row[0]]['count'];
          
        }
    }
}
