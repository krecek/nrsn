<?php

class SelectForm extends NAppForm
{
    public function __construct($name, $label=null, $items=null, $selected_value=null, $odesilaci_tlacitko='Odeslat', $automaticke_odeslani=TRUE, $size=null)
    {
        parent::__construct();
        $select = $this->addSelect($name, $label, $items, $size);
        if($automaticke_odeslani) $select->setAttribute('onchange', 'submit()');
        if($selected_value) $select->setDefaultValue ($selected_value);
        $this->addSubmit('send', $odesilaci_tlacitko);        
    }
}

?>
