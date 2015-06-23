<?php

class NahledClankuControl extends NControl
{
    private $clanek;
    private $obrazky;
    private $ostatni_prilohy;
    public function __construct($clanek, $obrazky=null, $ostatni_prilohy=null)
    {
        parent::__construct();
        $this->clanek=$clanek;
        $this->obrazky = $obrazky;
        $this->ostatni_prilohy = $ostatni_prilohy;
    }
    
    public function render()
    {
       $this->template->setFile(dirname(__FILE__) . '/nahledClanku.latte');
       $this->template->clanek = $this->clanek;
       $this->template->render();
    }
    
      protected function createComponentGalerie()
    {
        return new GalerieControl($this->obrazky);
    }
    
        protected function createComponentSeznamPriloh()
    {
        return new seznamOstatnichPrilohControl($this->ostatni_prilohy);
    }
}

?>
