<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OverHours
 *
 * @author Tomek
 */
class OverHour extends ActiveRecord {
    protected $_userId;
    protected $_value;
    protected $_year;
    protected $_month;
    protected $_day;
    
    protected static $_tableFields = array(
        '_userId' => 'user_id',
        '_value' => 'value',
        '_year' => 'year',
        '_month' => 'month',
        '_day' => 'day',
    );
    
    
}
