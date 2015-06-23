<?php

class Web_BasePresenter extends BasePresenter
{

    /** @var Redakce */
    public $redakce;
    public $rubriky;
    public $clanky;
    public $id_rubriky;
    public $akce;
    public $mininavigace = array(
        array('nazev' => 'Home', 'url' => 'Homepage:', 'poradi' => 1),
    );
    public $id_postu = 1; //id v tabulce clanky
    public $id_terminove_listiny = 2; //id v tabulce clanky
    public $nazev_rubriky = 'Česká gymnastická federace';
    public $id_rubriky_pro_akce = null;



    protected function startup()
    {
        parent::startup();
        $this->redakce = $this->getService('redakce');
    }

    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->nazev_rubriky = $this->nazev_rubriky;
        $this->template->id_rubriky = $this->id_rubriky;
        $this->template->pozadi = "<style type='text/css'>
                 body {background-image: url(/css/" . $this->redakce->findPozadiById($this->id_rubriky) . ");}
                </style>";
    }

    public function actionRss()
    {
        $clanky = $this->redakce->nejnovejsiClanky($this->redakce->seznamRubrik());
        foreach ($clanky as $clanek)
        {
            $clanek['nahled_type'] = mime_content_type($clanek['nahled']);
            $clanek['nahled_velikost'] = filesize($clanek['nahled']);
        }
        $this->template->clanky = $clanky;
    }

    protected function createComponentMenu()
    {
        $polozky = $this->redakce->findMenuProRubriku($this->id_rubriky);
        $menu = new PodmenuControl;
        foreach ($polozky as $polozka)
        {
            $menu->addItem($polozka['nazev'], $polozka['url']);
        }
        return $menu;
    }

    protected function createComponentSeznamClanku()
    {
        return new SeznamClankuControl($this->clanky);
    }

    protected function createComponentAkce()
    {
        $preklady = $this->context->parameters['rubriky'];
        $sport = array_search($this->id_rubriky_pro_akce, $preklady);
        $akce = $this->spravceAkci->findByDatum('+1 month', '-3 days', TRUE, $sport);
        $spravceVysledku = new SpravceVysledkuXml();
        foreach($akce as $ak)
        {
            $ak['exisuji_vysledky'] = $spravceVysledku->existujiVysledky($ak->id);
        }
        $control = new SeznamAkciControl($akce, $this->spravceAkci->typy_priloh, $this->getService('sportyRepository')->getSportyNazvy());
        $control->setTerminovaListina($this->redakce->seznamOstatnichPriloh($this->id_terminove_listiny));
        return $control;
    }
    
    protected function createComponentTerminovaListina()
    {
        $control = new TerminovaListinaControl();
        return $control;
    }

    protected function createComponentNavigace()
    {
        $navigace = new WebMenuControl();
        return $navigace;
    }

    protected function createComponentPost()
    {
        $clanek = $this->redakce->findClanekById($this->id_postu);
        return new PostControl($clanek);
    }

    protected function createComponentVyhledavani()
    {
        return new VyhledavanihControl();
    }

    protected function createComponentNeprehlednete()
    {
        $clanky = $this->redakce->clankyNeprehlednete(5);
        return new NeprehledneteControl($clanky);
    }

    protected function createComponentDrobeckovaNavigace()
    {
        $navigace = new DrobeckovaNavigaceControl();
        dd($this->mininavigace, 'mininavigace');
        foreach ($this->mininavigace as $key => $polozka)
        {
            $parametry = isset($polozka['parametry']) ? $polozka['parametry'] : null;
            $navigace->addItem($polozka['nazev'], $polozka['url'], $polozka['poradi'], $parametry);
        }
        return $navigace;
    }

}

?>
