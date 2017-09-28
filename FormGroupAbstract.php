<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 17:35
 */

namespace FM;


abstract class FormGroupAbstract extends InputAbstract
{
    public function __construct()
    {
        parent::__construct();
        $this->params['inputType'] = 'group';
    }
    public function addWrapperToEachValue($begin, $end)
    {
        $this->params['wrapperToEachValueBegin'] = $begin;
        $this->params['wrapperToEachValueEnd'] = $end;
        return $this;
    }
    public function value($val, $checked = false, $id = false, $class = false)
    {
        if (!isset($this->params['value'])) $this->params['value'] = array();
        $this->params['value'][] = array('value' => $val, 'id' => $id, 'class' => $class, 'checked' => $checked);
        return $this;
    }
}