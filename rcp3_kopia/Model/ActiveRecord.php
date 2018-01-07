<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseEntityModel
 *
 * @author Tomek
 */
abstract class ActiveRecord implements \ArrayAccess
{
    
    /**
     * Database connection handler.
     * 
     * @var \mysqli
     */
    protected static $_mysqli;
    
    /**
     * Unique record identifier.
     * 
     * @var int
     */
    protected $_id;
    
    /**
     * True if instance contains data.
     * 
     * @todo Decide if we actually need it. Handle if positive.
     * 
     * @var bool
     */
    protected $_isLoaded = false;
    
    /**
     * Performs database connection check.
     * 
     * @throws \Exception   On connection error.
     */
    private static function dbCheck()
    {
        if (!self::$_mysqli || self::$_mysqli->connect_errno) {
            throw new \Exception('Mysql engine failure.');
        }
    }
    
    /**
     * Assigns mysqli object instance. Required to perform any
     * database related actions.
     * 
     * @param \mysqli $mysqli   Instance of mysqli object used to
     *                          communicate with the database.
     */
    public static function setMysqli(\mysqli $mysqli)
    {
        self::$_mysqli = $mysqli;
    }
    
    
    public function getClassName()
    {
        return \get_class($this);
    }
    
    public function getTableName()
    {
        $className = $this->getClassName();
        if (isset($className::$_tableName)) {
            return $className::$_tableName;
        } else {
            return \strtolower(
                    \preg_replace('/([A-Z])/', '_$1', \lcfirst(\join('', \array_slice(\explode('\\', $className), -1))))
                ) . 's';
        }
    } // end getTableName()
    
    public function getTableFields()
    {    
        $className = $this->getClassName();
        if (isset($className::$_tableFields)) {
            return $className::$_tableFields;
        } else {
            throw new \Exception('{$className}: Table fields unknown.');
        }
    } // end getTableFields()
    
    /**
     * Returns the record as an array of its values with the
     * keys being camelCaps class properties names without underscores.
     * Result doesn't include computed fields.
     * 
     * Deprecated, use ArrayAccess directly on class instances instead
     * of this. ArrayAccess lets you access computed fields as well, and
     * so does the direct field access.
     * 
     * @deprecated since version 1.0
     * 
     * @return array
     */
    public function toArray()
    {
        $className = $this->getClassName();
        $result = array();
        foreach (\array_keys($className::$_tableFields) as $classField) {
            $result[\substr($classField, 1)] = $this->$classField;
        }
        
        return $result;
    }
    
    /**
     * Lets user read records using
     * " $record->field " pattern.
     * 
     * @param string $name  Name of classField related to a column (without underscore).
     * @return string|int   Value of the requested field.
     * @throws \Exception   In case of trying to access a non-existing field.
     */
    public function __get($name)
    {
        $className = $this->getClassName();
        $tableFields = $this->getTableFields();
        
        if ($name == 'id') {
            return $this->_id;
        }
        
        if (\array_key_exists('_'.$name, $tableFields)) {
            return $this->{'_'.$name};
        }
        
        if (isset($this->{'_'.$name.'_C'})) {
            return $this->{'_'.$name.'_C'};
        }
        
        throw new \Exception("Trying to access invalid property '{$name}' of {$className}.");
        
    }
    
    /**
     * Lets user edit records using
     * " $record->field = $value " pattern.
     * 
     * @param type $name    Name of classField related to a column (without underscore).
     * @param type $value   New value for the requested field.
     * @return type         Returns modified value.
     * @throws \Exception   In case of trying to access a non-existing field.
     */
    public function __set($name, $value)
    {
        $className = \get_class($this);
        $tableFields = $className::$_tableFields;
        
        if (\array_key_exists('_'.$name, $tableFields)) {
            return $this->{'_'.$name} = $value;
        }
        
        throw new \Exception('Trying to update invalid property of ' . $className . '.');
        
    }
    
    /**
     * Implements getters and setters. Lets user use
     * setOneFieldName($newValue) and
     * getOtherField().
     * 
     * @param type $name                setFieldName or getFieldName
     * @param type $arguments           Empty for the getter;
     *                                  New value for the setter.
     * @return \EntityBase|string|int   $this for setters' fluent interface;
     *                                  string/int values for getters.      
     * @throws \Exception               In case of invalid call.
     */
    public function __call($name, $arguments)
    {
        if (\strpos($name, 'set') === 0 && count($arguments) == 1) {
            $this->__set(\lcfirst(\substr($name, 3)), $arguments[0]);
            return $this;
        }
        elseif (\strpos($name, 'get') === 0 && count($arguments) == 0) {
            return $this->__get(\lcfirst(\substr($name, 3)));
        }
        else {
            throw new \Exception('Invalid get/set method call.');
        }
    }
    
    /**
     * 
     * @param int $id
     * @return ActiveRecord Fluent interface.
     * @throws \Exception
     */
    public function loadById($id)
    {
        self::dbCheck();
        
        $className = $this->getClassName();
        $tableName = $this->getTableName();
        $tableFields = $this->getTableFields();
        
        if (!\is_numeric($id) || $id < 0) {
            throw new \Exception("Invalid {$className} id.");
        }
        
        $query = 'SELECT id, ';
        foreach ($tableFields as $tableField) {
            $query .= $tableField . ', ';
        }
        
        $query = \substr($query, 0, -2);
        $query .= " FROM {$tableName} WHERE id = {$id} LIMIT 1";
        
        /* @var $res \mysqli_result */
        $res = self::$_mysqli->query($query);
        if ($res->num_rows < 1) {
            throw new \Exception($className . ' not found.');
        }
        
        $row = $res->fetch_row();
        $i = 0;
        $this->_id = $row[$i++];
        foreach ($tableFields as $classField => $tableField) {
            $this->$classField = $row[$i++];
        }
        
        $this->compute();
        
        return $this;
        
    } // end loadById()
    
    protected function setComputed($name, $value)
    {
        $this->{'_'.$name.'_C'} = $value;
    }
    public function compute() {}
    
    public function validate() {}
    
    public function store()
    {
        self::dbCheck();
        
        $className = $this->getClassName();
        $tableName = $this->getTableName();
        $tableFields = $this->getTableFields();
        
        $query = "INSERT INTO {$tableName} (";
        foreach ($tableFields as $tableField) {
            $query .= "{$tableField}, ";
        }
        
        $query = \substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($tableFields as $classField => $tableField) {
            $ap = (\is_numeric($this->$classField) ? '' : '\'');
            $query .= $ap . self::$_mysqli->real_escape_string($this->$classField) . $ap . ', ';
        }
        
        $query = \substr($query, 0, -2);
        $query .= ')';
        
        self::$_mysqli->query($query);
        if (self::$_mysqli->errno) {
            throw new \Exception("Nie można zapisać {$className}. ::: ".$query);
        }
        $this->_id = self::$_mysqli->insert_id;
    } // end save()
    
    public function update()
    {
        self::dbCheck();
       
        $className = $this->getClassName();
        $tableName = $this->getTableName();
        $tableFields = $this->getTableFields();
        
        $query = "UPDATE {$tableName} SET ";
        
        foreach ($tableFields as $classField => $tableField) {
            $ap = (\is_numeric($this->$classField) ? '' : '\'');
            $query .= "{$tableField} = {$ap}"
                . self::$_mysqli->real_escape_string($this->$classField)
                . "{$ap}, ";
        }
        
        $query = \substr($query, 0, -2);
        $query .= " WHERE id = {$this->_id} LIMIT 1";
        
      
        self::$_mysqli->query($query);
        
        if (self::$_mysqli->errno || self::$_mysqli->affected_rows < 1) {
            throw new \Exception("Could not update {$className}.");
        }
    } // end update()
    
    public function getId() {
        return $this->_id;
    }
    
    public function setId($id) {
        $this->_id = $id;
        return $this;
    }
    
    public function delete()
    {
        self::dbCheck();
        
        $className = $this->getClassName();
        $tableName = $this->getTableName();
        
        $query = "DELETE FROM {$tableName} WHERE id = {$this->id} LIMIT 1";
        
        self::$_mysqli->query($query);
        
        if (self::$_mysqli->errno || self::$_mysqli->affected_rows < 1) {
            throw new \Exception("Nie można usunąć {$className}.");
        }
    }
    
    /**
     * 
     * @deprecated since version 0.0
     */
    public function isLoaded() {
        return $this->_isLoaded;
    }
    
    public static function countQuery($table, $conditions = '', $multi = false, $multiFields = '*,')
    {
        self::dbCheck();
        $mysqli = self::$_mysqli;
        
        $query = 'SELECT '. ($multi ? $multiFields : '') ."COUNT(*) FROM `{$table}`";
        if(!empty($conditions)) {
            $query .= " WHERE {$conditions}";
        }
        
        /* @var $result mysqli_result */
        $result = $mysqli->query($query);
        $row = array();
        if ($multi) {
            while($row[] = $result->fetch_assoc());
        } else {
            $row[0] = $result->fetch_row();
        }
        if ($multi) {
            return $row;
        }
        
        return $row[0][0];
    }
    
    /**
     * Returns array of objects of calling class type that
     * meet the conditions given in raw SQL format.
     * 
     * @todo Update conditions handling. Strings are bad.
     * 
     * @param string $conditions                Conditions, raw sql format.
     * @return \Rcp\Models\Entities\className[] Array of objects meeting the
     *                                          conditions.
     * @throws \Exception
     */
    public function getWhere($conditions = 'TRUE')
    {
        self::dbCheck();
        
        $className = $this->getClassName();
        $tableName = $this->getTableName();
        $tableFields = $this->getTableFields();
        
        $query = 'SELECT id, ';
        foreach ($tableFields as $tableField) {
            $query .= $tableField . ', ';
        }
        
        $query = \substr($query, 0, -2);
        $query .= " FROM {$tableName} WHERE {$conditions}";
        
        /* @var $res \mysqli_result */
        $res = self::$_mysqli->query($query);
        
        /* @var $result ActiveRecord */
        $result = array();
        
        if (self::$_mysqli->errno) {
            throw new \Exception("Could not select {$className}s.");
        }
        
        while ($row = $res->fetch_row()) {
            $newObject = new $className;
            $i = 0;
            $newObject->_id = $row[$i++];
            foreach ($tableFields as $classField => $tableField) {
                $newObject->$classField = $row[$i++];
            }
            
            $newObject->compute();
            $result[] = $newObject;
        }
        return $result;
        
    } // end getWhere()
    
    
    
    /**
     * \ArrayAccess interface implementation.
     */
    
     public function offsetExists($offset) {
         $className = $this->getClassName();
         return isset($className::$_tableFields[$offset]);
     }

     public function offsetGet($name) {
         return $this->__get($name);
     }

     public function offsetSet($name, $value) {
         return $this->__set($name, $value);
     }

     public function offsetUnset($offset) {
         throw new \Exception('Action forbidden.');
     }
     
     /**
      * End of \ArrayAccess interface implementation.
      */

    
}
