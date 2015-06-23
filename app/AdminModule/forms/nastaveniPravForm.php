<?php
class NastaveniPravForm extends NAppForm
{
    public function __construct($items=null, $value=null)
    {
        parent::__construct();
        $this->addSelect('prava', 'Oprávnění: ', $items);
        $this->addSubmit('send', 'Uložit');
        
        if(isset($value))
        {
            $this['prava']->setDefaultValue($value);
        }
    }
}
?>