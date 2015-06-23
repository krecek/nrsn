<?php

class PotvrditZmenuHeslaForm extends NAppForm
{
    public function __construct($values)
    {
        parent::__construct();
        $this->addHidden('id_osoby', $values['id_osoby']);
        $this->addHidden('klic', $values['klic']);
        $this->addSubmit('send', 'Ano');
    }
}

?>
