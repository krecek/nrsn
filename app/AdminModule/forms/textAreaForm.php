<?php

class TextAreaForm extends NAppForm
{
    public function __construct($name, $label, $value=null, $popis_tlacitka='Uložit')
    {
        parent::__construct();
        $this->addTextArea($name, $label)->setDefaultValue($value)->setAttribute('class', 'focus');
        $this->addSubmit('send', $popis_tlacitka);
    }
}

?>
