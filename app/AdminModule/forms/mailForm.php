<?php

class MailForm extends NAppForm
{
    public function __construct()
    {
        parent::__construct();
        $this->addText('subject', 'Předmět')->setRequired('Zadejte předmět zprávy');
        $this->addTextArea('message', 'Zpráva')->setRequired('Vyplňte text zprávy');
        $this->addSubmit('send', 'Odeslat');
    }
}

?>
