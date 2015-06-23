<?php

class ZapomenuteHesloForm extends NAppForm
{
    public function __construct()
    {
        parent::__construct();
        $this->addText('email', 'Email:')->setRequired('Vyplňte Váš e-mail.')->setAttribute('class', 'focus');
        $this->addSubmit('send', 'Odeslat');
    }
}

?>
