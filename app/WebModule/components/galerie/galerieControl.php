<?php

class GalerieControl extends NControl
{
   private $obrazky;

    public function __construct($obrazky)
    {
        parent::__construct();
        $this->obrazky = $obrazky;
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/galerie.latte');
        $this->template->obrazky = $this->obrazky;
        $this->template->pocet_obrazku = count($this->obrazky);
        $this->template->render();
    }
}

?>
