<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserPermission
 *
 * @author Tomek
 */
class UserPermission extends ActiveRecord
{
    protected $_userId;
    protected $_resource;
    protected $_accessLevel;
    
    protected static $_tableFields = array(
        '_userId' => 'user_id',
        '_resource' => 'resource',
        '_accessLevel' => 'access_level'
    );
    
}
