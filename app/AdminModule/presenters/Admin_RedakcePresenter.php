<?php

class Admin_RedakcePresenter extends SecuredPresenter
{

    public $id;
    public $id_clanku;
    public $modul = 'REDAKCE';
    public $clanek;
    public $rubrika;
    public $seznam_clanku;
    private $prava_k_clankum;
    private $prava_k_rubrikam;
    public $vyse_prav = array(
        'clanek_edit' => 1,
        'clanek_publikovat' => 2,
        'vsechny_clanky' => 3,
        'rubrika_edit' => 4);
    private $order;
    private $text;
    private $backlink;

    /** @var Redakce */
    private $redakce;

    protected function startup()
    {
        
        parent::startup();
        $this->redakce = $this->getService('redakce');
        dd($this->admin, 'admin');
    }

    public function beforeRender()
    {
        parent::beforeRender();
        if (isset($this->id))
        {
            if (!isset($this->rubrika)) $this->rubrika = $this->redakce->findRubrikuById($this->id);
            $this->template->rubrika = $this->rubrika;
        }
        if (isset($this->id_clanku))
        {
            if (!isset($this->clanek)) $this->clanek = $this->redakce->findClanekById($this->id_clanku);
            $this->template->clanek = $this->clanek;
        }
        $this->template->id_hlavni_skupiny = $this->redakce->id_hlavni_skupiny;
        if (isset($this->opravneni)) $this->template->opravneni = $this->opravneni;
        $datum = new NDateTime53($this->redakce->zobrazit_od_datum_neschvaleneho_clanku . ' ' . $this->redakce->zobrazit_od_cas_neschvaleneho_clanku);
        $this->template->zobrazit_od_neschvaleneho_clanku = $datum;
        $this->template->backlink = $this->backlink;
    }

    //=========================== ČLÁNKY =======================================
    public function actionDefault($order = null)
    {
        $this->opravneni = $this->opravneni();
        $this->order = $order;
    }

    public function renderDefault()
    {
        $clanky = array();
        $this->backlink = $this->storeRequest();
        $moje_clanky = $this->pravaKClankum($this->redakce->findClankyByAutor($this->getUser()->id));
        $clanky_ke_schvaleni = $this->pravaKClankum($this->redakce->clankyKeSchvaleni($this->prava->seznamPrav($this->modul), $this->vyse_prav['vsechny_clanky']));
        $seznam_clanku = array_merge($clanky_ke_schvaleni, $moje_clanky);

        $razeni = array('od' => 'DESC');
        if ($this->order)
        {
            if (preg_match('~(.*)_DESC~', $this->order, $tmp)) $razeni = array($tmp[1] => 'DESC');
            else $razeni = array($this->order => 'ASC');
            if (isset($razeni['rubrika']))
            {

                foreach ($seznam_clanku as $key => $clanek)
                {
                    $rubriky[$key] = join(' - ', $clanek['rubrika_nazev']);
                }
                if ($razeni['rubrika'] == 'ASC') asort($rubriky);
                else arsort($rubriky);
                foreach ($rubriky as $key => $rubrika)
                {
                    $clanky[] = $seznam_clanku[$key];
                }
            }
            else $clanky = $seznam_clanku;
        }
        else $clanky = $seznam_clanku;

        $this->template->clanky = $clanky;
        $this->template->razeni = $razeni;
    }

    public function actionAdd()
    {
        $this->opravneni = $this->opravneni();
        if (!$this->opravneni['clanek_add']) $this->redirect('default');
        $_SESSION['adresa_prilohy']='';
    }

    protected function createComponentNovyClanekForm()
    {
        $form = new UpravitClanekForm($this->redakce->nazvyRubrikProClanky(), $this->prava->getPristupy($this->modul));
        $form->onSuccess[] = callback($this, 'novyClanekFormSubmitted');
        return $form;
    }

    public function novyClanekFormSubmitted(UpravitClanekForm $form)
    {
        $this->opravneni = $this->opravneni();
        if (!$this->opravneni['clanek_add']) $this->redirect('default');
        $values = $form->getValues();
        if ($values->perex == 'perex') $values->perex = '';
        $clanek = new Clanek();
        if (!in_array($values->rubrika, $this->prava->getPristupy($this->modul, $this->vyse_prav['clanek_publikovat'])))
        {
            $values['zobrazit_od_datum'] = $this->redakce->zobrazit_od_datum_neschvaleneho_clanku;
            $values['zobrazit_od_cas'] = $this->redakce->zobrazit_od_cas_neschvaleneho_clanku;
        }
        $values['autor'] = $this->getUser()->id;
        $clanek->setUdaje($values);
        $zaznam = $this->redakce->ulozitClanek($clanek);
        $this->logg('Novy clanek - nazev: ' . $zaznam->nadpis . ', zobrazit: ' . $zaznam->zobrazit_od . ' - ' . $zaznam->zobrazit_do);
        $this->flashMessage('Článek byl uložen.');
        $this->redirect('default');
    }

    public function actionEditClanek($id, $backlink=null)
    {
        $this->overitClanek($id);
        $this->backlink = $backlink;
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['view']) $this->redirect('default');
        $this->id_clanku = $id;
        $this->template->clanek = $this->clanek;
        $adresare = $this->redakce->najit_adresare($id);
        $_SESSION['adresa_prilohy']='/'.$adresare['target_adresar'].'/';
    }

    protected function createComponentEditClanekForm()
    {
        $form = new UpravitClanekForm($this->redakce->nazvyRubrikProClanky(), $this->prava->getPristupy($this->modul), $this->clanek);
        $form->onSuccess[] = callback($this, 'editClanekFormSubmitted');
        return $form;
    }

    public function editClanekFormSubmitted(UpravitClanekForm $form)
    {
        $this->overitClanek($this->id_clanku);
        $this->opravneni = $this->opravneni(0, $this->id_clanku);
        if (!$this->opravneni['clanek_edit']) $this->redirect('default');
        $values = $form->getValues();
        if ($values->perex == 'perex') $values->perex = '';
        $values['upravil'] = $this->getUser()->id;
        $clanek = new Clanek($this->id_clanku);
        $clanek->setUdaje($values);
        $zaznam = $this->redakce->ulozitClanek($clanek);
        $this->logg('upraven clanek ' . $zaznam->id);
        $this->flashMessage('Změny byly uloženy.');
        $this->restoreRequest($this->backlink);
        $this->redirect('default');
    }

    protected function createComponentNahledClanku()
    {
        return new NahledClankuControl($this->clanek, $this->redakce->seznamObrazku($this->id_clanku), $this->redakce->seznamOstatnichPriloh($this->id_clanku));
    }

    public function actionDeleteClanek($id, $backlink=null)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('default');
        $this->backlink=$backlink;
        if ($error = $this->redakce->smazatClanek($id)) $this->flashMessage($error);
        else
        {
            $this->logg('smazan clanek ' . $id);
            $this->flashMessage('Článek byl smazán.');
        }
        if($this->backlink) $this->restoreRequest($this->backlink);
        else $this->redirect('default');
    }

    // nastaví začátek platnosti článku
    public function actionNastavitZacatek($id, $backlink=null)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_publikovat']) $this->redirect('default');
        $this->backlink=$backlink;
        $this->id_clanku = $id;
    }

    protected function createComponentNastavitDatumOdForm()
    {
        if ($this->clanek->zobrazit_od->format('Y-m-d') == $this->redakce->zobrazit_od_datum_neschvaleneho_clanku)
        {
            $values['datum'] = date('j.n.Y');
            $values['cas'] = date('H:i');
        }
        else
        {
            $values['datum'] = $this->clanek->zobrazit_od->format('j.n.Y');
            $values['cas'] = $this->clanek->zobrazit_od->format('H:i');
        }
        $form = new NastavitDatumCasForm($values, 'zobrazit_od_');
        $form->onSuccess[] = callback($this, 'nastavitDatumOdFormSubmitted');
        return $form;
    }

    public function nastavitDatumOdFormSubmitted(NastavitDatumCasForm $form)
    {
        $values = $form->getValues();
        $clanek = new Clanek($this->id_clanku);
        if ($this->redakce->findClanekById($this->id_clanku)->top == 'A' && strtotime(PrevodnikDatumu::prevestDatumNaAnglicke($values->zobrazit_od_datum) . ' ' . $values->zobrazit_od_cas) > time())
        {
            $form->addError('Článek je top. Datum nelze nastavit.');
        }
        else
        {
            $clanek->setUdaje($values);
            $this->redakce->ulozitClanek($clanek);
            $this->logg('clanku ' . $this->id_clanku . ' nastaven zacatek zobrazeni: ' . $values->zobrazit_od_datum . ' ' . $values->zobrazit_od_cas);
            $this->flashMessage('Změny byly uloženy.');
            $this->restoreRequest($this->backlink);
            $this->redirect('default');
        }
    }

    public function actionNastavitKonec($id, $backlink=null)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('default');
        $this->backlink=$backlink;
        $this->id_clanku = $id;
    }

    protected function createComponentNastavitDatumDo()
    {
        $values['datum'] = $this->clanek->zobrazit_do->format('j.n.Y');
        $values['cas'] = $this->clanek->zobrazit_do->format('H:i');
        $form = new NastavitDatumCasForm($values, 'zobrazit_do_');
        $form->onSuccess[] = callback($this, 'nastavitDatumDoFormSubmitted');
        return $form;
    }

    public function nastavitDatumDoFormSubmitted(NastavitDatumCasForm $form)
    {
        $values = $form->getValues();
        $clanek = new Clanek($this->id_clanku);
        if ($this->redakce->findClanekById($this->id_clanku)->top == 'A' && strtotime(PrevodnikDatumu::prevestDatumNaAnglicke($values->zobrazit_do_datum) . ' ' . $values->zobrazit_do_cas) < time())
        {
            $form->addError('Článek je top. Datum nelze nastavit.');
        }
        else
        {
            $clanek->setUdaje($values);
            $this->redakce->ulozitClanek($clanek);
            $this->logg('clanku ' . $this->id_clanku . ' nastaven konec zobrazeni: ' . $values->zobrazit_do_datum . ' ' . $values->zobrazit_do_cas);
            $this->flashMessage('Změny byly uloženy.');
            $this->restoreRequest($this->backlink);
            $this->redirect('default');
        }
    }

    public function handleNastavitHlavniStranu($id_clanku, $hodnota)
    {
        $this->overitClanek($id_clanku);
        $this->opravneni = $this->opravneni(0, $id_clanku);
        if (!$this->opravneni['clanek_publikovat']) $this->redirect('default');
        $values['hlavni_strana'] = $hodnota ? 'A' : 'N';
        $clanek = new Clanek($id_clanku);
        $clanek->setUdaje($values);
        $this->redakce->ulozitClanek($clanek);
        $this->logg('clanek ' . $this->id_clanku . ' nastaven na hlavni stranu');
        if ($this->isAjax())
        {
            $this->invalidateControl('seznamClanku');
        }
        else
        {
            $this->flashMessage('Úpravy byly uloženy.');
            $this->redirect('default');
        }
    }

    public function handleNastavitTopClanek($id_clanku)
    {
        $this->overitClanek($id_clanku);
        $this->opravneni = $this->opravneni(0, $id_clanku);
        if (!$this->opravneni['nastavit_top']) $this->redirect('default');
        if (!$this->redakce->nastavitTopClanek($id_clanku)) $zprava = 'Nelze nastavit, článek není publikovaný.';
        else
        {
            $this->logg('clanek ' . $this->id_clanku . ' nastaven jako top');
            $zprava = 'Úpravy byly uloženy.';
        }
        $this->flashMessage($zprava);
        if ($this->isAjax())
        {
            $this->invalidateControl('seznamClanku');
        }
        else
        {
            $this->redirect('default');
        }
    }

    //přehled článků v rubrice
    public function actionClanky($id)
    {
        $this->overitRubriku($id);
        $this->opravneni = $this->opravneni($id);
        $this->id = $id;
    }

    public function renderClanky()
    {
        $this->template->clanky = $this->pravaKClankum($this->redakce->findClankyByRubrika($this->id));
    }

    //================================== PŘÍLOHY ================================
    public function actionPrilohy($id)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('default');
        $this->id_clanku = $id;
    }

    public function renderPrilohy()
    {
        if (!isset($this->template->prilohy))
        {
            $this->template->prilohy = $this->redakce->seznamPriloh($this->id_clanku, TRUE);
        }
        $this->template->clanek = $this->redakce->findClanekById($this->id_clanku);
        $this->template->max_rozmery_obrazku = $this->redakce->max_rozmery_obrazku;
    }

    public function actionUpload($id)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('prilohy', $id);
        $this->id_clanku = $id;
        $this->ulozitPrilohu($this->id_clanku);
    }

    protected function createComponentNahratSouboryForm()
    {
        $form = new NahratSouboryForm(5);
        $form->onSuccess[] = callback($this, 'nahratSouboryFormSubmitted');
        return $form;
    }

    public function nahratSouboryFormSubmitted(NahratSouboryForm $form)
    {
        $this->overitClanek($this->id_clanku);
        $this->opravneni = $this->opravneni(0, $this->id_clanku);
        if (!$this->opravneni['clanek_edit']) $this->redirect('prilohy', $this->id_clanku);
        $values = $form->getValues();
        foreach ($values as $key => $polozka)
        {
            if (preg_match('~soubor_(.*)~', $key))
            {
                $prilohy[] = $polozka;
            }
        }
        $vysledek_chyby = $this->redakce->ulozitPrilohy($prilohy, $this->id_clanku);
        if (count($vysledek_chyby))
        {
            foreach ($vysledek_chyby as $id => $chyba)
            {
                $form->addError("$id - $chyba");
            }
        }
        else
        {
            foreach ($prilohy as $priloha)
            {
                $this->logg('k clanku ' . $this->id_clanku . ' nahrana priloha ' . $priloha);
            }
            $this->flashMessage('Přílohy byly nahrány.');
            $this->redirect('prilohy', $this->id_clanku);
        }
    }

    public function handleDeletePriloha($id, $priloha)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('prilohy', $id);
        $this->id_clanku = $id;
        $this->redakce->smazatPrilohu($this->id_clanku, $priloha);
        $this->logg("u clanku $id smazana priloha $priloha");
        $this->flashMessage('Příloha byla smazána.');
        if ($this->isAjax())
        {
            $this->invalidateControl('seznamPriloh');
        }
        else
        {
            $this->redirect('prilohy', $this->id_clanku);
        }
    }

    public function handleNastavitHlavniObr($id, $priloha)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('prilohy', $id);
        $this->id_clanku = $id;
        $this->redakce->nastavitHlavniObr($this->id_clanku, $priloha);
        $this->logg("u clanku $id nastavena priloha $priloha jako hlavni obrazek");
        if ($this->isAjax())
        {
            $this->invalidateControl('seznamPriloh');
        }
        else
        {
            $this->redirect('prilohy', $this->id_clanku);
        }
    }

    public function handleZrusitHlavniObr($id)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('prilohy', $id);
        $this->id_clanku = $id;
        $this->redakce->zrusitHlavniObr($id);
        $this->logg("u clanku $id zrusen hlavni obrazek");
        if ($this->isAjax())
        {
            $this->invalidateControl('seznamPriloh');
        }
        else
        {
            $this->redirect('prilohy', $this->id_clanku);
        }
    }

    public function handleNastavitObrHlavniStrana($id, $priloha)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('prilohy', $id);
        $this->id_clanku = $id;
        $this->redakce->nastavitObrTopClanek($this->id_clanku, $priloha);
        $this->logg("u clanku $id nastavena priloha $priloha jako obrazek na hlavni stranu");
        if ($this->isAjax())
        {
            $this->invalidateControl('seznamPriloh');
        }
        else
        {
            $this->redirect('prilohy', $this->id_clanku);
        }
    }

    public function handleZrusitObrHlavniStrana($id, $priloha)
    {
        $this->overitClanek($id);
        $this->opravneni = $this->opravneni(0, $id);
        if (!$this->opravneni['clanek_edit']) $this->redirect('prilohy', $id);
        $this->id_clanku = $id;
        $this->redakce->zrusitObrTopClanek($this->id_clanku, $priloha);
        $this->logg("u clanku $id zrusena priloha $priloha jako hlavni obrazek");
        if ($this->isAjax())
        {
            $this->invalidateControl('seznamPriloh');
        }
        else
        {
            $this->redirect('prilohy', $this->id_clanku);
        }
    }

    protected function createComponentNastavitGaleriiForm()
    {
        $values = $this->clanek;
        $form = new NastavitGaleriiForm($values);
        $form->onSuccess[] = callback($this, 'nastavitGaleriiFormSubmitted');
        return $form;
    }

    public function nastavitGaleriiFormSubmitted(NastavitGaleriiForm $form)
    {
        $values = $form->getValues();
        $clanek = new Clanek($this->id_clanku);
        $clanek->setUdaje($values);
        $zaznam = $this->redakce->ulozitClanek($clanek);
        $this->logg("u článku " . $this->id_clanku . " nastaveny vlastnosti: galerie - " . $zaznam->galerie . ", prilohy - " . $zaznam->prilohy);
        $this->flashMessage('Změny byly uloženy');
        $this->redirect('prilohy', $this->id_clanku);
    }

    // ================= VYHLEDAT ČLÁNEK =============================================
    public function actionHledat($text = null)
    {
        $this->opravneni = $this->opravneni();
        $clanky = '';
        $this->text = $text;
        $this->backlink = $this->storeRequest();
    }

    public function renderHledat()
    {
        $clanky = array();
        if (isset($this->text))
        {
            $clanky = $this->pravaKClankum($this->redakce->findClankyFulltext($this->text, TRUE));
        }
        $this->template->clanky = $clanky;
    }

    protected function createComponentVyhledatClanekForm()
    {
        $form = new VyhledatForm('Vyhledat článek');
        $form->onSuccess[] = callback($this, 'vyhledatClanekFormSubmitted');
        return $form;
    }

    public function vyhledatClanekFormSubmitted(VyhledatForm $form)
    {
        $values = $form->getValues();
        $text = $values['popis'];
        if (!$this->redakce->findClankyFulltext($text)) $form->addError('Nebyl nalezen žádný článek s požadovaným textem');
        $this->redirect('hledat', $text);
    }

    //===================== RUBRIKY ====================================================
    public function actionRubriky($id = 0)
    {
        $this->overitRubriku($id);
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['view']) $this->redirect('default');
        $this->id = $id;
        $this->backlink = $this->storeRequest();
    }

    public function renderRubriky()
    {
        $this->template->clanky = $this->pravaKClankum($this->redakce->findClankyByRubrika($this->id));
        $rubriky = $this->redakce->findRubrikyByRodic($this->id);
        $this->pravaKRubrikam();
        foreach ($rubriky as $key => $rubrika)
        {
            $rubrika['podrubriky'] = $this->redakce->findRubrikyByRodic($rubrika->id);
            $this->pravaKRubrikam();
            if (isset($this->prava_k_rubrikam[$rubrika->id]) && $this->prava_k_rubrikam[$rubrika->id] >= $this->vyse_prav['rubrika_edit']) $rubrika['rubrika_edit'] = TRUE;
            else $rubrika['rubrika_edit'] = FALSE;
        }
        $this->template->rubriky = $rubriky;
    }

    protected function createComponentNovaRubrikaForm()
    {
        $form = new UpravitRubrikuForm($this->redakce->nazvyHlavnichRubrik(), $this->prava->getPristupy($this->modul, $this->vyse_prav['rubrika_edit'], NULL, TRUE), array('rodic' => $this->id));
        $form->onSuccess[] = callback($this, 'novaRubrikaFormSubmitted');
        return $form;
    }

    public function novaRubrikaFormSubmitted(UpravitRubrikuForm $form)
    {
        $this->overitRubriku($this->id);
        $this->opravneni = $this->opravneni($this->id);
        if (!$this->opravneni['rubrika_edit']) $this->redirect('rubriky', $this->id);
        $values = $form->getValues();
        $rubrika = new Rubrika;
        $rubrika->setUdaje($values);
        $zaznam = $this->redakce->ulozitRubriku($rubrika);
        $rodic = $this->redakce->findRubrikuById($zaznam->rodic);
        $uroven = 0;
        if (!$uroven = $this->prava->prava($this->modul, $rubrika->rodic)) $uroven = $this->prava->prava($this->modul, $rodic->rodic);
        $this->prava->setPrava($this->getUser()->id, $this->modul, $zaznam->id, $uroven);
        $this->logg("nova rubrika - id: " . $zaznam->id . ", nazev: " . $zaznam->nazev . " rodic: " . $zaznam->rodic);
        $this->flashMessage('Rubrika byla vytvořena.');
        $this->redirect('rubriky', $values->rodic);
    }

    public function actionEditRubrika($id)
    {
        $this->overitRubriku($id);
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['rubrika_edit']) $this->redirect('rubriky', $id);
        $this->id = $id;
        $this->template->rubrika = $this->rubrika;
    }

    protected function createComponentEditRubrikaForm()
    {
        $rubriky = $this->redakce->nazvyHlavnichRubrik();
        unset($rubriky[$this->id]);
        $form = new UpravitRubrikuForm($rubriky, $this->prava->getPristupy($this->modul, $this->vyse_prav['rubrika_edit'], null, TRUE), $this->rubrika);
        $form->onSuccess[] = callback($this, 'editRubrikaFormSubmitted');
        return $form;
    }

    public function editRubrikaFormSubmitted(UpravitRubrikuForm $form)
    {
        $this->overitRubriku($this->id);
        $this->opravneni = $this->opravneni($this->id);
        if (!$this->opravneni['rubrika_edit']) $this->redirect('rubriky', $this->id);
        $values = $form->getValues();
        $rubrika = new Rubrika($this->id);
        $rubrika->setUdaje($values);
        $zaznam = $this->redakce->ulozitRubriku($rubrika);
        $this->logg("upravena rubrika " . $this->id);
        $this->flashMessage('Změny byly uloženy.');
        $this->redirect('rubriky', $this->id);
    }

    public function actionEditMenu($id)
    {
        $this->overitRubriku($id);
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['menu_edit']) $this->redirect('rubriky', $id);
        $this->id = $id;
    }

    protected function createComponentUpravitMenuForm()
    {
        $values = $this->redakce->findMenuByRubrika($this->id);
        $form = new UpravitMenuForm($values);
        $form->onSuccess[] = callback($this, 'upravitMenuFormSubmitted');
        return $form;
    }

    public function upravitMenuFormSubmitted(UpravitMenuForm $form)
    {
        $this->overitRubriku($this->id);
        $this->opravneni = $this->opravneni($this->id);
        if (!$this->opravneni['menu_edit']) $this->redirect('rubriky', $this->id);
        $values = $form->getValues();
        $polozky = array();
        $poradi = 0;
        foreach ($values as $key => $value)
        {
            if (preg_match('~nazev_(.*)~', $key, $tmp))
            {
                $i = $tmp[1];
                if (!$value) continue; //pokud není název, není platná položka
                $poradi++;
                $polozka['nazev'] = $value;
                $polozka['url'] = $values["url_$i"];
                $polozka['poradi'] = $poradi;
                $polozka['id'] = $values["id_$i"];
                $polozky[$poradi] = $polozka;
            }
        }
        $menu = new Menu($this->id);
        $menu->setPolozky($polozky);
        $this->redakce->ulozitMenu($menu);
        $this->logg("upraveno menu rubriky " . $this->id);
        $this->flashMessage('Menu je upraveno.');
        $this->redirect('rubriky', $this->id);
    }

    public function actionDeleteRubrika($id)
    {
        $this->overitRubriku($id);
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['rubrika_delete']) $this->redirect('default');
        $rodic = $this->redakce->findRubrikuById($id)->rodic;
        if ($id == $this->redakce->id_hlavni_skupiny)
        {
            $this->flashMessage('Nelze smazat hlavní skupinu.');
            $this->redirect('rubriky');
        }

        if ($this->redakce->smazatRubriku($id))
        {
            $this->prava->smazatPravaRedakce($id);
            $this->flashMessage('Rubrika byla smazána');
        }
        else
        {
            $this->flashMessage('Rubriku nelze smazat, obahuje články nebo podrubriky.');
        }
        $this->redirect('rubriky', $rodic);
    }

    public function actionPrevzitPrava($id)
    {
        $this->overitRubriku($id);
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['prevzit_pravo']) $this->redirect('rubriky', $id);
        $rodic = $this->redakce->findRubrikuById($this->rubrika->rodic);
        $uroven = 0;
        if (!$uroven = $this->prava->prava($this->modul, $this->rubrika->rodic)) $uroven = $this->prava->prava($this->modul, $rodic->rodic);
        $this->prava->setPrava($this->getUser()->id, $this->modul, $id, $uroven);
        $this->flashMessage('Práva byla nastavena.');
        $this->redirect('rubriky', $id);
    }

    //======================== NÁPOVĚDA ============================ 
    public function actionNapoveda()
    {
        $this->opravneni = $this->opravneni($this->id);
        $adresa = '';
        if (preg_match('~gis(.*)~', $this->context->getService('httpRequest')->getUrl()->host, $tmp))
        {
            $adresa = "http://gymfed$tmp[1]";
        }
        $this->template->adresa = $adresa;

//        $this->id = null;
    }

    //============================================================
    protected function createComponentBocniMenu()
    {

        $menu = new MenuControl();
        $id = $this->getUser()->id;

        $menu->addItem('Moje články', 'default');
        $menu->addItem('Nový článek', 'add');
        $menu->addItem('Hledat', 'hledat');
        $menu->addItem('Rubriky', 'rubriky');
        $menu->addItem('Práva', "prava", $this->id);
        $menu->addItem('Nápověda', 'napoveda');
        return $menu;
    }

    //===============================================================
    public function opravneni($id_rubriky = 0, $id_clanku = null)
    {
        $opravneni = array(
            'view' => FALSE,
            'clanek_add' => FALSE,
            'clanek_edit' => FALSE,
            'clanek_publikovat' => FALSE,
            'nastavit_top' => FALSE,
            'rubrika_edit' => FALSE,
            'rubrika_delete' => FALSE,
            'menu_edit' => FALSE,
            'prevzit_pravo' => FALSE,
        );
        if ($id_clanku)
        {
            $clanek = $this->redakce->findClanekById($id_clanku);
            $id_rubriky = $clanek->rubrika;
            $autor = $clanek->autor;
        }

        $prava_modul = $this->prava->prava($this->modul);

        $prava = $this->prava->prava($this->modul, $id_rubriky); //práva se vždy týkají konkrétní rubriky
        $this->admin = $prava;
        $opravneni['view'] = TRUE;
        $opravneni['clanek_add'] = TRUE;

        if ($id_clanku)
        {
            if ($prava >= $this->vyse_prav['clanek_edit'] && $autor == $this->getUser()->id) $opravneni['clanek_edit'] = TRUE; //1
            if ($prava >= $this->vyse_prav['clanek_publikovat'] && $autor == $this->getUser()->id) $opravneni['clanek_publikovat'] = TRUE; //2
        }
        if ($prava >= $this->vyse_prav['vsechny_clanky']) //3
        {
            $opravneni['clanek_edit'] = TRUE;
            $opravneni['clanek_publikovat'] = TRUE;
        }
        if ($prava >= $this->vyse_prav['rubrika_edit']) //4
        {
            $opravneni['rubrika_edit'] = TRUE;
        }
        if ($prava >= 4)
        {
            $opravneni['menu_edit'] = TRUE;
        }
        if ($this->prava->prava($this->modul) >= 4) //nastavit top může osoba, která má v jekékoli rubrice práva vyšší než 3
        {
            $opravneni['nastavit_top'] = TRUE;
        }

        if (!$id_clanku && $id_rubriky != 0) // pouze práce s rubrikami, není potřeba načítat při práci s články
        {
            //převzetí práva - pokud mám právo 4 a vyšší na nějakou rodičovskou rubriku
            $rubrika = $this->redakce->findRubrikuById($id_rubriky);
            $rodic = $this->redakce->findRubrikuById($rubrika->rodic);
            if (!$prava)
            {
                if ($a = $this->prava->prava($this->modul, $rubrika->rodic) >= 4 || $b = $this->prava->prava($this->modul, $rodic->rodic) >= 4) $opravneni['prevzit_pravo'] = TRUE;
            }
            //smazání rubriky - pokud mám práva na nadřazenou rubriku
            if ($this->prava->prava($this->modul, $rodic['id']) >= 4) $opravneni['rubrika_delete'] = TRUE;
        }
        dd($opravneni, 'oprávněni');
        return $opravneni;
    }

    //========================= NENALEZENO ==================================
    public function overitClanek($id)
    {
        if (!$this->clanek = $this->redakce->findClanekById($id))
        {
            $this->redirect('default');
        }
    }

    public function overitRubriku($id)
    {
        if (!$this->rubrika = $this->redakce->findRubrikuById($id))
        {
            $this->redirect('default');
        }
    }

    public function pravaKClankum($clanky)
    {
        $this->pravaKRubrikam();
        $return = array();
        foreach ($clanky as $key => $clanek)
        {
            $prava['edit'] = FALSE;
            $prava['publikovat'] = FALSE;
            $id_rubriky = $clanek['rubrika'];
            if (isset($this->prava_k_rubrikam[$clanek->rubrika]) && $this->prava_k_rubrikam[$clanek->rubrika] >= $this->vyse_prav['clanek_edit'] && $clanek->autor == $this->getUser()->id) $prava['edit'] = TRUE;
            if (isset($this->prava_k_rubrikam[$clanek->rubrika]) && $this->prava_k_rubrikam[$clanek->rubrika] >= $this->vyse_prav['clanek_publikovat'] && $clanek->autor == $this->getUser()->id) $prava['publikovat'] = TRUE;
            if (isset($this->prava_k_rubrikam[$clanek->rubrika]) && $this->prava_k_rubrikam[$clanek->rubrika] >= $this->vyse_prav['vsechny_clanky'])
            {
                $prava['edit'] = TRUE;
                $prava['publikovat'] = TRUE;
            }
            $clanek['prava'] = $prava;
            $return[$key] = $clanek;
        }
        return $return;
    }

    public function pravaKRubrikam()
    {
        if (!isset($this->prava_k_rubrikam)) $this->prava_k_rubrikam = $this->prava->seznamPrav($this->modul);
    }

    //================================================================

    /**
     * Uloží přílohu nahranou pomocí plupload
     * @param type $id_clanku
     */
    public function ulozitPrilohu($id_clanku)
    {

        @set_time_limit(5 * 60);

        //určit a případně vytvořit adresář
        $adresare = $this->redakce->najit_adresare($id_clanku, TRUE);
        $targetDir = $adresare['target_adresar'];
        $nahledy_adresar = $adresare['nahledy_adresar'];

        $cleanupTargetDir = true;
        $maxFileAge = 5 * 3600;
        if (isset($_REQUEST["name"])) $fileName = $_REQUEST["name"];
        elseif (!empty($_FILES)) $fileName = $_FILES["file"]["name"];
        else $fileName = uniqid("file_");
        $filePath = $targetDir . '/' . $fileName;
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Remove old temp files	
        if ($cleanupTargetDir)
        {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            while (($file = readdir($dir)) !== false)
            {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") continue;

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge))
                {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }

        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb"))
        {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES))
        {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"]))
            {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }
            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb"))
            {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }
        else
        {
            if (!$in = @fopen("php://input", "rb"))
            {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }
        while ($buff = fread($in, 4096))
        {
            fwrite($out, $buff);
        }
        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1)
        {
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);
        }

        //vytvoření náhledu
        $mime_type_obr = $this->redakce->prilohy->obrazky;
        if (in_array(mime_content_type($filePath), $mime_type_obr))
        {
            if (preg_match('~_tn_.*~', $fileName)) $this->redakce->vytvorit_nahled($filePath, $nahledy_adresar . '/' . $fileName); //jedná se o náhled, pouze přepsat stávající náhled
            else $this->redakce->vytvorit_nahled($filePath, $nahledy_adresar . '/_tn_' . $fileName);
            if (!$this->redakce->findClanekById($this->id_clanku)->obr) $this->redakce->nastavitHlavniObr($this->id_clanku, $fileName);
            if (!$this->redakce->jeObrTopClanek($this->id_clanku)) $this->redakce->nastavitObrTopClanek($this->id_clanku, $fileName);
        }

        $this->logg('k clanku ' . $id_clanku . ' nahrana priloha ' . $fileName);

        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }

}

?>
