<?php

class SeznamAkciControl extends BaseControl
{

    private $seznam_akci;
    public $terminova_listina;
    public $prilohy;
    private $typy_priloh;
    private $sporty;

    public function __construct($seznam_akci, $typy_priloh, $sporty)
    {
        parent::__construct();
        $this->seznam_akci = $seznam_akci;
        $this->typy_priloh = $typy_priloh;
        $this->sporty = $sporty;
    }

    public function setTerminovaListina($prilohy)
    {
        $this->terminova_listina = $prilohy;
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/seznamAkci.latte');

//        $this->template->setFile(dirname(__FILE__) . '/terminovaListina.latte');
//        $this->template->terminova_listina = $this->terminova_listina;
        $this->template->seznam_akci = $this->seznam_akci;
        $this->template->typy_priloh = $this->typy_priloh;
        $this->template->sporty = $this->sporty;
        $this->template->render();
    }

    public function createTemplate($class = NULL)
    {
        $template = parent::createTemplate($class);
        $template->registerHelper('datumKonani', callback($this, 'helperDatumKonani'));
        return $template;
    }

    public function helperDatumKonani($datum1, $datum2)
    {
        if ($datum1 == $datum2) return date('j.n.Y', strtotime($datum1));
        else return date('j.n.Y', strtotime($datum1)) . ' - ' . date('j.n.Y', strtotime($datum2));
    }


}

?>
