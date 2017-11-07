<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mediabox
 *
 * @author Tomek
 */
class Mediabox extends ActiveRecord {
    protected $_userId;
    protected static $_tableFields = array ( '_userId' => 'user_id');
    protected static $_tableName = 'mediabox';
    public function __construct($userId) {
        $this->_userId = $userId;
    }
    public function visible()
    {
        $query = "SELECT 1 FROM mediabox WHERE user_id = {$this->_userId} LIMIT 1";
        /* @var $res mysqli_result */
        $res = self::$_mysqli->query($query);
        return $res->num_rows < 1;
    }
}
