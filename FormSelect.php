<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 6:43
 */

namespace FM;


class FormSelect extends InputAbstract {
    public function __construct()
    {
        parent::__construct();
        $this->params['inputType'] = 'select';
    }
    public function option($val, $name, $selected = false)
    {
        $this->params['options'][] = array('value' => $val, 'name' => $name, 'selected' => $selected);
        return $this;
    }
    public function options($options, $valueField, $titleField, $shouldBeSelected)
    {
        foreach ($options as $option) {
            $this->option($option[$valueField], $option[$titleField], $option[$valueField] == $shouldBeSelected);
        }
        return $this;
    }
}