<?php

class ZmenitHesloForm extends NAppForm
{

    public function __construct()
    {
        parent::__construct();
     
        $this->addPassword('old_password', 'Zadejte staré heslo: ')
                ->setRequired('Zadejte staré heslo.');
        $this->addPassword('password', 'Zadejte nové heslo: ')
                ->setRequired('Zadejte nové heslo');
        $this->addPassword('confirm_password', 'Potvrďte nové heslo')
                ->setRequired('Nové heslo je nutné zadat ještě jednou pro potvrzení.')
                ->addRule(NForm::EQUAL, 'Zadaná hesla se musí shodovat.', $this['password']);
        $this->addSubmit('send', 'Uložit');
    }

}

?>
