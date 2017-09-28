# FM
PHP simple form maker.

To install clone this git and include classes \FM\\* .
```

$form = new \FM\FormMaker();
//add atributes to a tag form
$form->action('action.php')->id('test')->post();

//add an input and attributes to this one
$form->addInput()->id('input')->addclass('classinput')->err('wrong class')->name('name')->type('number')->value('123');

//add a select and attributes to this one and options
$form->addSelect()->id('select')->addclass('selectclass')->name('name')->option(1, 'test')->option(2, 'selected value', true);

//add a checkbox and attributes to this one and choses with error field and wrappers
$form->addCheckbox()
    ->id('checkbox')
    ->addclass('checkboxclass')
    ->addclass('firstCheckbox')
    ->name('checkbox')
    ->value('yes 1')
    ->value('yes 2')
    ->addWrapper('<h3>', '</h3>')
    ->err('YOU SHOULD CHOOSE!')
    ->addErrWrapper('<span style="color:red;">', '</span>');
    
//add a radio button with attributes and choses
$form->addRadio()->id('radio')->addclass('radioclass')
  ->addclass('radio')->name('radio')->value('yes', true)->value('no')->value('maybe');

//add an input submit with attributes
$form->addSubmit()->id('submit')->addclass('submitclass')->addclass('secondclass')->value('press');

//add a button with attributes and custom attribute onClick
$form->addButton()->name('button')->value('click me')->addCustomAttribute('onClick', 'alert(\'You clicked\');')->typeButton();

//render class which one should implement the FormRenderInterface interface 
$renderObj = new \FM\FormRender();

//add common wrappers for elements which doesn't have custom wrappers
$renderObj->addWrapperInput('<div><span>field</span>', '</div>');
$renderObj->addErrorWrapper('<span class="error">', '</span>');

//show rendered form
echo $form->getRender($renderObj);
```
