<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectTotals
 *
 * @author Tomek
 */
class ProjectTotals extends ActiveRecord {
    public $totals = array();
    
    public function __construct() {
        $projectObject = new Project;
        $projects = $projectObject->getWhere();
        foreach ($projects as $project) {
            $this->totals[$project->id] = 0;
        }
        
        $query = 
           "SELECT pr.id, SUM(TIMESTAMPDIFF(MINUTE, ut.start, ut.stop)) / 480
            FROM projects pr, tasks ta, user_tasks ut
            WHERE
             ut.task_id = ta.id AND ta.project_id = pr.id
            GROUP BY pr.id
            ORDER BY pr.nazwa ASC";
        $res = self::$_mysqli->query($query);
        while($row = $res->fetch_row()) {
            $this->totals[$row[0]] = $row[1];
        }
    }
}
