<?php

class ZmenitUzivatelskeJmenoForm extends NAppForm
{
    public function __construct($uzivatelske_jmeno=null)
    {
        parent::__construct();
         $this->addText('jmeno', 'Současné uživatelské jméno: ')
                ->setDefaultValue($uzivatelske_jmeno)
                ->setDisabled();
        $this->addText('username', 'Nové uživatelské jméno: ')
                ->setRequired('Zadejte nové uživatelské jméno')
                ->addRule(NForm::MAX_LENGTH, 'Uživatelské jméno může mít maximálně %d znaků', 50);
        $this->addPassword('password', 'Heslo: ')->setRequired('Zadejte stávající heslo');
        $this->addSubmit('send', 'Uložit');
    }
}
?>
