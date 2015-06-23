<?php
class PotvrzeniForm extends NAppForm
{
    public function __construct($nazev_tlacitka)
    {
        parent::__construct();
        $this->addSubmit('storno', 'Storno')->setAttribute('class', 'gray');
        $this->addSubmit('send', $nazev_tlacitka);
        
    }
}
?>
