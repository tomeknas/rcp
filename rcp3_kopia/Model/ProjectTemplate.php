<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectTemplate
 *
 * @author Tomek
 */
class ProjectTemplate extends ActiveRecord {
    protected $_name;
    
    protected static $_tableFields = array(
        '_name' => 'nazwa'
    );
    
    public function getTaskNames() {
        $templateDataObject = new ProjectTemplatesData;
        $dataObjects = $templateDataObject->getWhere("template_id = {$this->id}");
        
        $result = array();
        
        foreach($dataObjects as $object) {
            $result[] = $object->name;
        }
        
        return $result;
    }
    
    public function getTasks()
    {
        $templateTaskObject = new ProjectTemplatesData();
        return $templateTaskObject->getWhere('template_id = ' . $this->_id);
    }
}
