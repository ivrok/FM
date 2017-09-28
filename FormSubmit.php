<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 6:43
 */

namespace FM;


class FormSubmit extends InputAbstract {
    public function __construct()
    {
        parent::__construct();
        $this->params['inputType'] = 'input';
        $this->params['type'] = 'submit';
    }
    public function value($val)
    {
        $this->params['value'] = $val;
        return $this;
    }
}