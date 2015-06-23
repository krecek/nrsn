<?php

class SouvisejiciClankyControl extends SeznamClankuControl
{

 

    public function __construct($clanky)
    {
        parent::__construct($clanky);
       
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/souvisejiciClanky.latte');
        $this->template->clanky = $this->clanky;
        $this->template->render();
    }

}

?>
