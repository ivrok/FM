<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 6:42
 */

namespace FM;


class FormRadio extends FormGroupAbstract {
    public function __construct()
    {
        parent::__construct();
        $this->params['type'] = 'radio';
    }
}