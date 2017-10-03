<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.09.2017
 * Time: 6:59
 */

namespace FM;


class FormRender implements FormRenderInterface {
    protected $beginWrap = '';
    protected $endWrap = '';
    protected $beginErrWrap = '';
    protected $endErrWrap = '';
    protected $errPosition = 'overOut';
    protected static $elementCounter = 0;

    public function addWrapperInput($begin, $end)
    {
        $this->beginWrap = $begin;
        $this->endWrap = $end;
    }
    public function addErrorWrapper($begin, $end)
    {
        $this->beginErrWrap = $begin;
        $this->endErrWrap = $end;
    }
    public function getRender($params)
    {
        return $this->render($params);
    }
    protected function render($params)
    {
        ob_start();
        ?>
        <form <?=$this->getAttributs($params);?>>
            <? foreach ($params['inputs'] as $item) echo $this->renderItem($item->getParams()) . PHP_EOL;?>
        </form>
        <?
        return ob_get_clean();
    }
    protected function getAttributs($params)
    {
        $attributs = array();
        $attrnames = array('id', 'class', 'action', 'enctype', 'method', 'placeholder', 'required', 'name', 'value', 'checked', 'selected', 'type', 'customattribute');
        foreach ($attrnames as $attrname) {
            if (isset($params[$attrname])) {
                if ($attrname == 'checked' || $attrname == 'selected' || $attrname == 'required') {
                    if ($params[$attrname]) $attributs[] = $attrname; //if selected or checked = true
                    continue;
                }
                if ($attrname == 'customattribute' && $params[$attrname]) {
                    foreach ($params[$attrname] as $param) :
                        $attributs[] = $param['name'] . '="' . $param['value'] . '"';
                    endforeach;
                    continue;
                }
                if ($attrname == 'class' && $params[$attrname]) {
                    $attributs[] = $attrname . '="' . implode(' ', $params[$attrname]) . '"';
                    continue;
                }
                $attributs[] = $attrname . '="' . $params[$attrname] . '"';
            }
        }
        return implode(' ', $attributs);
    }
    protected function leaveError($item)
    {
        $beginErrWrap = isset($item['inputErrWrapperBegin']) ? $item['inputErrWrapperBegin'] : $this->beginErrWrap;
        $endErrWrap = isset($item['inputErrWrapperEnd']) ? $item['inputErrWrapperEnd'] : $this->endErrWrap;
        if (isset($item['err'])) {
            echo $beginErrWrap . PHP_EOL;
            echo $item['err'] . PHP_EOL;
            echo $endErrWrap  . PHP_EOL;
        }
    }
    public function errOverOutWrapper()
    {
        $this->errPosition = 'overOut';
    }
    public function errOverInWrapper()
    {
        $this->errPosition = 'overIn';
    }
    public function errUnderInWrapper()
    {
        $this->errPosition = 'underIn';
    }
    public function errUnderOutWrapper()
    {
        $this->errPosition = 'underOut';
    }
    protected function getErrPosition($item)
    {
        $position = isset($item['errPosition']) ? $item['errPosition'] : $this->errPosition;
        return $position;
    }
    protected function leaveErrorOverOutWrapper($item)
    {
        if ($this->getErrPosition($item) =='overOut') $this->leaveError($item);
    }
    protected function leaveErrorOverInsideWrapper($item)
    {
        if ($this->getErrPosition($item) =='overIn') $this->leaveError($item);
    }
    protected function leaveErrorUnderInsideWrapper($item)
    {
        if ($this->getErrPosition($item) =='underIn') $this->leaveError($item);
    }
    protected function leaveErrorUnderOutWrapper($item)
    {
        if ($this->getErrPosition($item) =='underOut') $this->leaveError($item);
    }
    protected function renderItem($item)
    {
        self::$elementCounter++;
        if (!isset($item['class'])) $item['class'] = array();
        $item['class'][] = str_replace('\\', '_', __CLASS__) . '_Element';
        $item['class'][] = str_replace('\\', '_', __CLASS__) . '_Element' . self::$elementCounter;
        ob_start();

        $beginWrap = isset($item['inputWrapperBegin']) ? $item['inputWrapperBegin'] : $this->beginWrap;
        $endWrap = isset($item['inputWrapperEnd']) ? $item['inputWrapperEnd'] : $this->endWrap;

        $this->leaveErrorOverOutWrapper($item);
        echo $beginWrap . PHP_EOL;
        $this->leaveErrorOverInsideWrapper($item);
        switch ($item['inputType']) {
            case 'group' :
                switch ($item['type']) {
                    case 'checkbox' :
                        $this->renderCheckbox($item);
                        break;
                    case 'radio' :
                        $this->renderRadio($item);
                        break;
                    default :
                        $this->renderInput($item);
                        break;
                }
                break;
            case 'input' :
                $this->renderInput($item);
                break;
            case 'select' :
                $this->renderSelect($item);
                break;
            case 'button' :
                $this->renderButton($item);
                break;
            case 'textarea' :
                $this->renderTextarea($item);
                break;
        }
        $this->leaveErrorUnderInsideWrapper($item);
        echo  PHP_EOL . $endWrap . PHP_EOL;
        $this->leaveErrorUnderOutWrapper($item);
        return ob_get_clean();
    }
    protected function renderRadio($item)
    {
        $this->renderCheckbox($item);
    }
    protected function renderCheckbox($item)
    {
        foreach ($item['value'] as $value) :
            $itemClone = $item;
            $itemClone = array_merge($itemClone, $value);
            if (isset($item['wrapperToEachValueBegin'])) echo $item['wrapperToEachValueBegin'];
            $this->renderInput($itemClone);
            if (isset($item['wrapperToEachValueEnd'])) echo $item['wrapperToEachValueEnd'];
        endforeach;
    }
    protected function renderInput($item)
    {
        ?>
        <input <?=$this->getAttributs($item);?>>
        <?
    }
    protected function renderSelect($item)
    {
        ?>
        <select <?=$this->getAttributs($item);?>>
            <? foreach ($item['options'] as $option) : ?>
                <option value="<?=$option['value'];?>" <?=$option['selected'] ? 'selected' : '';?>><?=$option['name'];?></option>
            <? endforeach; ?>
        </select>
        <?
    }
    protected function renderButton($item)
    {
        $val = '';
        if (isset($item['value'])) {
            $val = $item['value'];
            unset($item['value']);
        }
        ?>
        <button <?=$this->getAttributs($item);?>><?=$val;?></button>
        <?
    }
    protected function renderTextarea($item)
    {
        $val = '';
        if (isset($item['value'])) {
            $val = $item['value'];
            unset($item['value']);
        }
        ?>
        <textarea <?=$this->getAttributs($item);?>><?=$val;?></textarea>
        <?
    }
}