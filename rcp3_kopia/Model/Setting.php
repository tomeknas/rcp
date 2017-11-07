<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Setting
 *
 * @author Tomek
 */
class Setting extends ActiveRecord {
    protected $_class;
    protected $_property;
    protected $_value;
    
    protected static $_tableFields = array(
        '_class' => 'class',
        '_property' => 'property',
        '_value' => 'value'
    );
    
}
