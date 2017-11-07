<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Getter
 *
 * @author Tomek
 */
abstract class ModelBase implements \Countable, \ArrayAccess, \IteratorAggregate {
    
    protected $_modelBaseArray = '';
    
    public function __get($name) {
        if (isset($this->{'_'.$name})) {
            return $this->{'_'.$name};
        } else {
            throw new \Exception(\get_class($this).": property {$name} does not exist.");
        }
    }
    
    private function check() {
        if (empty($this->_modelBaseArray)) {
            throw new \Exception('Model Base interfaces are not available for ' . \get_class($this));
        }
    }
    
    public function count()
    {
        $this->check();
        return \count($this->{$this->_modelBaseArray});
    }
    
    public function offsetExists($offset) {
        $this->check();
        return isset($this->{$this->_modelBaseArray}[$offset]);
    }

    public function offsetGet($offset) {
        $this->check();
        return $this->offsetExists($offset) ? $this->{$this->_modelBaseArray}[$offset] : null;
    }

    public function offsetSet($d1, $d2) {
        throw new \Exception('Action forbidden.');
    }

    public function offsetUnset($d1) {
        throw new \Exception('Action forbidden');
    }

    public function getIterator() {
        $this->check();
        return new \ArrayIterator($this->{$this->_modelBaseArray});
    }
}
