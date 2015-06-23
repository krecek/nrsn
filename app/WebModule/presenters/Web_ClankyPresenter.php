<?php

class Web_ClankyPresenter extends Web_BasePresenter
{

    /** @var OsobyRepository */
    public $osobyRepository;
    public $pocet_podobnych_clanku = 3;
    public $id_clanku;

    protected function startup()
    {
        parent::startup();
        $this->osobyRepository = $this->getService('osobyRepository');
    }

    public function actionDefault($id)
    {
        if (!$clanek = $this->redakce->findClanekByUrl($id))
        {
            $this->id_rubriky = $this->redakce->id_hlavni_skupiny;
            $this->setView('clanekNenalezen');
        }
        elseif ($id != $clanek['url'])
        {
            if ($clanek['zobrazit_od']->getTimestamp() > time() || $clanek['zobrazit_do']->getTimestamp() < time()) $this->setView('clanekNenalezen');
            else $this->redirect('default', $clanek['url']);
        }
        else
        {
            $this->id_clanku = $clanek->id;
            $this->template->clanek = $clanek;
            $this->template->autor = $this->osobyRepository->findById($clanek['autor']);
            $this->clanky = $this->redakce->podobneClanky($clanek->id, $this->pocet_podobnych_clanku, $clanek->rubrika);
            $this->rubriky = $this->rubriky = $this->redakce->findRubrikyByRodic($clanek->rubrika);
            $this->id_rubriky = $clanek->rubrika;
            $rubrika = $this->redakce->findRubrikuById($clanek->rubrika);
            if ($rubrika->rodic == $this->redakce->id_hlavni_skupiny || $rubrika['id'] == $this->redakce->id_hlavni_skupiny)
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
                $this->id_rubriky_pro_akce = $rodic->id;
            }
        }
    }

    protected function createComponentGalerie()
    {
        return new GalerieControl($this->redakce->seznamObrazku($this->id_clanku));
    }

    protected function createComponentSeznamPriloh()
    {
        return new seznamOstatnichPrilohControl($this->redakce->seznamOstatnichPriloh($this->id_clanku));
    }

    protected function createComponentSouvisejiciClanky()
    {
        return new SouvisejiciClankyControl($this->clanky);
    }

}

?>
