<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 6:40
 */

namespace FM;


abstract class InputAbstract {
    protected $params = array();
    public function __construct()
    {

    }
    public function getParams()
    {
        return $this->params;
    }
    public function id($id)
    {
        $this->params['id'] = $id;
        return $this;
    }
    public function addclass($class)
    {
        if (!isset($this->params['class'])) $this->params['class'] = array();
        $this->params['class'][] = $class;
        return $this;
    }
    public function name($name)
    {
        $this->params['name'] = $name;
        return $this;
    }
    public function addWrapper($begin, $end)
    {
        $this->params['inputWrapperBegin'] = $begin;
        $this->params['inputWrapperEnd'] = $end;
        return $this;
    }
    public function addErrWrapper($begin, $end)
    {
        $this->params['inputErrWrapperBegin'] = $begin;
        $this->params['inputErrWrapperEnd'] = $end;
        return $this;
    }
    public function addCustomAttribute($name, $value)
    {
        if (!isset($this->params['customattribute'])) $this->params['customattribute'] = array();
        $this->params['customattribute'][] = array('name' => $name, 'value' => $value);
        return $this;
    }
    public function required()
    {
        $this->params['required'] = true;
        return $this;
    }
    public function getName()
    {
        return isset($this->params['name']) ? $this->params['name'] : '';
    }
    public function err($msg)
    {
        $this->params['err'] = $msg;
        return $this;
    }
    public function errOverOutWrapper()
    {
        $this->params['errPosition'] = 'overOut';
        return $this;
    }
    public function errOverInWrapper()
    {
        $this->params['errPosition'] = 'overIn';
        return $this;
    }
    public function errUnderInWrapper()
    {
        $this->params['errPosition'] = 'underIn';
        return $this;
    }
    public function errUnderOutWrapper()
    {
        $this->params['errPosition'] = 'underOut';
        return $this;
    }
}
