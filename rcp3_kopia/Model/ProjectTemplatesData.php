<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectTemplatesData
 *
 * @author Tomek
 */
class ProjectTemplatesData extends ActiveRecord
{
    protected $_name;
    protected $_templateId;
    
    protected static $_tableFields = array(
        '_name' => 'nazwa',
        '_templateId' => 'template_id'
    );
    
    protected static $_tableName = 'project_templates_data';
    
    
}
