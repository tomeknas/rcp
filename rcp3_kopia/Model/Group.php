<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author Tomek
 */
class Group extends ActiveRecord {
    protected $_name;
    
    protected static $_tableFields = array(
        '_name' => 'name'
    );
}
