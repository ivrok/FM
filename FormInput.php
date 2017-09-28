<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 6:40
 */

namespace FM;


class FormInput extends InputAbstract {
    public function __construct()
    {
        parent::__construct();
        $this->params['inputType'] = 'input';
    }
    public function type($type)
    {
        $this->params['type'] = $type;
        return $this;
    }
    public function value($val)
    {
        $this->params['value'] = $val;
        return $this;
    }
    public function placeholder($ph)
    {
        $this->params['placeholder'] = $ph;
        return $this;
    }
}