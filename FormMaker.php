<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 5:53
 */
namespace FM;
class FormMaker
{
    private $params = array();
    public function __construct()
    {
        $params['inputs'] = array();
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
    public function post()
    {
        $this->params['method'] = 'post';
        return $this;
    }
    public function get()
    {
        $this->params['method'] = 'get';
        return $this;
    }
    public function action($action)
    {
        $this->params['action'] = $action;
        return $this;
    }
    public function enctype($enct)
    {
        $this->params['enctype'] = $enct;
        return $this;
    }
    public function encMultFormData()
    {
        $this->enctype('multipart/form-data');
        return $this;
    }
    public function addInput()
    {
        $obj = new FormInput();
        $this->params['inputs'][] = $obj;
        return $obj;
    }
    public function addTextarea()
    {
        $obj = new FormTextarea();
        $this->params['inputs'][] = $obj;
        return $obj;
    }
    public function addCheckbox()
    {
        $obj = new FormCheckbox();
        $this->params['inputs'][] = $obj;
        return $obj;
    }
    public function addRadio()
    {
        $obj = new FormRadio();
        $this->params['inputs'][] = $obj;
        return $obj;
    }
    public function addSelect()
    {
        $obj = new FormSelect();
        $this->params['inputs'][] = $obj;
        return $obj;
    }
    public function addSubmit()
    {
        $obj = new FormSubmit();
        $this->params['inputs'][] = $obj;
        return $obj;
    }
    public function addButton()
    {
        $obj = new FormButton();
        $this->params['inputs'][] = $obj;
        return $obj;
    }
    public function getInputObjects()
    {
        return $this->params['inputs'];
    }
    public function getInputObjectByName($name)
    {
        foreach ($this->getInputObjects() as $obj) {
            return $obj->getName() == $name;
        }
        return false;
    }
    public function getRender(FormRenderInterface $obj)
    {
        return $obj->getRender($this->params);
    }
}