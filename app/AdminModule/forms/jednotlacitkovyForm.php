<?php
class JednotlacitkovyForm extends NAppForm
{
    public function __construct($nazev_tlacitka)
    {
        parent::__construct();
        $this->addSubmit('send', $nazev_tlacitka);
    }
}
?>
