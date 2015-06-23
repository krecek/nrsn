<?php

class PrehledPravControl extends NControl
{

    private $osoby;
    private $id;

    public function __construct($osoby)
    {
        parent::__construct();
        $this->osoby = $osoby;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/prehledPrav.latte');
        $this->template->osoby = $this->osoby;
         $this->template->pravo_uzivatele = $this->presenter->prava->prava($this->presenter->modul, $this->presenter->id, $this->presenter->getUser()->id);
         $this->template->admin = $this->presenter->admin;
         if(isset($this->id)) $this->template->id = $this->id;
        $this->template->render();
       
    }

}