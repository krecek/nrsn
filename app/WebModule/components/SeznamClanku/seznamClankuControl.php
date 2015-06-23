<?php

class SeznamClankuControl extends BaseControl
{

    protected $clanky;

    public function __construct($clanky)
    {
        parent::__construct();
        $this->clanky = $clanky;
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/seznamClanku.latte');
        $this->template->clanky = $this->clanky;
        $this->template->render();
    }

}

?>
