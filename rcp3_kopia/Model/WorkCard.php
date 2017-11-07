<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WorkCard
 *
 * @author Tomek
 */
class WorkCard extends ActiveRecord {
    public $data = array();
    public function __construct() {
        $multi_query = "
            SET @@group_concat_max_len = 65535;
            SET @sql = NULL;
            SELECT
              GROUP_CONCAT(DISTINCT
                CONCAT(
                  'sum(if(ta.project_id = ',
                  ta.project_id,
                  ', timestampdiff(minute,ut.start,ut.stop) / 60, 0)) AS `',
                  ta.project_id,
                  '`'
                )
              ) INTO @sql
            FROM user_tasks ut, tasks ta, projects pr WHERE ut.task_id = ta.id AND ta.project_id = pr.id AND pr.nazwa != 'Ogólne'
            ORDER BY pr.nazwa ASC;
            SET @sql = CONCAT('SELECT us.nazwisko, ', @sql, ' FROM user_tasks ut join users us join tasks ta WHERE ut.task_id = ta.id AND ut.user_id = us.id GROUP BY us.id');

            PREPARE stmt FROM @sql;
            EXECUTE stmt;
            DEALLOCATE PREPARE stmt;";
        
        $mysqli = self::$_mysqli;
        $mysqli->multi_query($multi_query);
        
        $execResult = null;
        do {
            $result = $mysqli->store_result();
            
            if ($result) {
                $execResult = $result;
            }
            
        } while ($mysqli->next_result());
        
        while ($row = $execResult->fetch_assoc()) {
           $this->data[] = $row;
        }
        
                
    }
}
