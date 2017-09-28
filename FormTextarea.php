<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 6:41
 */

namespace FM;


class FormTextarea extends InputAbstract {
    public function __construct()
    {
        parent::__construct();
        $this->params['inputType'] = 'textarea';
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