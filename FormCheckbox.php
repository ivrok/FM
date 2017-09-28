<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 6:41
 */

namespace FM;


class FormCheckbox extends FormGroupAbstract {
    public function __construct()
    {
        parent::__construct();
        $this->params['type'] = 'checkbox';
    }
}