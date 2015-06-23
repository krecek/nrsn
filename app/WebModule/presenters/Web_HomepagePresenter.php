<?php

class Web_HomepagePresenter extends Web_BasePresenter
{

    public $pocet_clanku_na_strance = 10;
    public $pocet_top_clanku_na_hlavni_strane = 1;
    public $top_clanky;
    public $nejnovejsi_clanky;
    public $neprehlednete;

//    public $rubriky;

    protected function startup()
    {
        parent::startup();
    }

    public function actionDefault($id = null)
    {
        $clanky = $this->redakce->clankyNaHlavniStranu($this->pocet_top_clanku_na_hlavni_strane, $this->pocet_clanku_na_strance);
        $this->top_clanky = $clanky['top_clanky']['top_clanek'];
        $this->clanky = $clanky['clanky'];
        $this->neprehlednete = $this->redakce->clankyNeprehlednete(5);
        $this->template->clanky = $clanky;
        $this->template->pocet_top_clanku = $this->pocet_top_clanku_na_hlavni_strane;
        $this->rubriky = $this->redakce->findRubrikyByRodic();
    }

    public function actionRubriky($id)
    {
        if (!$rubrika = $this->redakce->findRubrikuByUrl($id))
        {
            $this->id_rubriky = $this->redakce->id_hlavni_skupiny;
            $this->setView('clanekNenalezen');
        }
        else
        {
            $clanky = $this->redakce->clankyProRubriku($rubrika->id);
            $this->clanky = $clanky;
            if (!$rubrika['je_hlavni']) $this->rubriky = $this->redakce->findRubrikyByRodic($rubrika->rodic);
            else $this->rubriky = $this->redakce->findRubrikyByRodic($rubrika->id);
            $this->id_rubriky = $rubrika->id;
            if ($rubrika['je_hlavni'])
            {
                
                $this->mininavigace[] = array('nazev' => $rubrika->nazev, 'url' => 'Homepage:rubriky', 'parametry' => $rubrika->url, 'poradi' => '2');
                $this->nazev_rubriky = $rubrika->nazev;
                $this->id_rubriky_pro_akce=$rubrika->id;
            }
            else
            {
                $rodic = $this->redakce->findRubrikuById($rubrika->rodic);
                $this->mininavigace[] = array('nazev' => $rodic->nazev, 'url' => 'Homepage:rubriky', 'parametry' => $rodic->url, 'poradi' => '2');
                $this->mininavigace[] = array('nazev' => $rubrika->nazev, 'url' => 'Homepage:rubriky', 'parametry' => $rodic->url . '/' . $rubrika->url, 'poradi' => '3');
                $this->nazev_rubriky = $rodic->nazev;
                $this->id_rubriky_pro_akce=$rodic->id;
            }
        }
    }

    public function actionKalendar()
    {
        
    }

    protected function createComponentTopClanky()
    {
        return new TopClankyControl($this->top_clanky, 'top_clanek');
    }

    protected function createComponentSportyMenu()
    {
        return new SportyMenuControl();
    }

//    protected function createComponentKalendar()
//    {
//        $kalendar = new SimpleCalendar;
//        $kalendar->setLanguage(SimpleCalendar::LANG_CZ); // české názvy měsíců a dnů
//        $kalendar->setFirstDay(SimpleCalendar::FIRST_MONDAY); // týden začne pondělkem
//        $kalendar->setEvents($this->getService('akce'));
//        return $kalendar;
//    }
    
    protected function createComponentKalendar($name)
    {
        $kalendar = new KalendarControll($this->spravceAkci);
        return $kalendar;
    }

}

?>
