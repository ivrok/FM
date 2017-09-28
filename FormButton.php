<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 18:35
 */

namespace FM;


class FormButton extends InputAbstract
{
    public function __construct()
    {
        parent::__construct();
        $this->params['inputType'] = 'button';
        $this->params['type'] = 'submit';
    }
    public function typeButton()
    {
        $this->params['type'] = 'button';
    }
    public function typeSubmit()
    {
        $this->params['type'] = 'submit';
    }
    public function value($val)
    {
        $this->params['value'] = $val;
        return $this;
    }
}