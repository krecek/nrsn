<?php

class Admin_OsobyPresenter extends SecuredPresenter
{

    public $osoba;
    public $id;
    public $modul = 'OSOBY';
    public $aktualni_registrace;
    public $opravneni;

    protected function startup()
    {
        parent::startup();
        dd($this->admin, 'admin');
//        $this->template->admin = $this->admin;
    }

    public function beforeRender()
    {
        parent::beforeRender();
//        if (isset($this->opravneni))
//        {
//            $this->template->opravneni = $this->opravneni;
//        }
    }

    public function actionDefault($text = null)
    {
        $this->id = null;
        $this->opravneni = $this->opravneni();
        if (!$this->opravneni['hledat'])
        {
            $this->redirect("Osoby:prehled", $this->getUser()->id);
        }

        if ($text)
        {
            $vyhledane_osoby = $this->osobyRepository->vyhledatOsoby($text);
            $i = 1;
            foreach ($vyhledane_osoby as $osoba)
            {
                $osoby[$i] = $osoba;
                $i++;
            }
            foreach ($osoby as $key => $osoba)
            {
                $zobrazit_osoby[$key]['prijmeni'] = $osoba['prijmeni'];
                $zobrazit_osoby[$key]['jmeno'] = $osoba['jmeno'];

                if ($key == 1)
                {
                    $zobrazit_osoby[$key]['detail'] = $osoba['narozeni']->format('Y');
                }
                if ($key > 1)
                {
                    if ($osoba['prijmeni'] == $osoby[$key - 1]['prijmeni'] && $osoba['jmeno'] == $osoby[$key - 1]['jmeno'] && $osoba['narozeni'] == $osoby[$key - 1]['narozeni'])
                    {
                        $zobrazit_osoby[$key]['detail'] = $osoba['narozeni']->format('d.m.Y') . ' (' . $osoba['id'] . ')';
                        $zobrazit_osoby[$key - 1]['detail'] = $osoby[$key - 1]['narozeni']->format('d.m.Y') . ' (' . $osoby[$key - 1]['id'] . ')';
                    }
                    elseif ($osoba['prijmeni'] == $osoby[$key - 1]['prijmeni'] && $osoba['jmeno'] == $osoby[$key - 1]['jmeno'] && $osoba['narozeni']->format('Y') == $osoby[$key - 1]['narozeni']->format('Y'))
                    {
                        $zobrazit_osoby[$key]['detail'] = $osoba['narozeni']->format('d.m.Y');
                        $zobrazit_osoby[$key - 1]['detail'] = $osoby[$key - 1]['narozeni']->format('d.m.Y');
                    }
                    else
                    {
                        $zobrazit_osoby[$key]['detail'] = $osoba['narozeni']->format('Y');
                    }
                }

                $zobrazit_osoby[$key]['id'] = $osoba['id'];
            }
            $this->template->osoby = $zobrazit_osoby;
//            $this->template->osoby = $this->osobyRepository->vyhledatOsoby($text);
        }
    }

    public function renderDefault()
    {
        
    }

//======================= VYHLEDÁVAČ =============================
    protected function createComponentVyhledatOsobuForm()
    {
        $form = new VyhledatForm('Vyhledat osobu: ', 'vyhledat_osobu');

        $form->onSuccess[] = callback($this, 'vyhledatOsobuFromSubmitted');
        return $form;
    }

    public function vyhledatOsobuFromSubmitted(VyhledatForm $form)
    {
        $values = $form->getValues();

        //je zadané id (pouze přes autocomplete)
        if ($values->id)
        {
            if ($osoba = $this->osobyRepository->findById($values->id))
            {
                $this->redirect("prehled", $values->id);
            }
            else
            {
                $form->addError('Nebyla nalezena osoba se zadaným id');
            }
        }
        else
        {//id, rodné číslo  nebo část jména?
            if (intval($values->popis))
            {
                if (NStrings::length($values->popis) == 6)
                {
                    if ($osoba = $this->osobyRepository->findById($values->popis))
                    {
                        $this->redirect("prehled", $values->popis);
                    }
                    else
                    {
                        $form->addError('Nebyla nalezena osoba se zadaným id');
                    }
                }
                elseif (NStrings::length($values->popis) == 9 || NStrings::length($values->popis) == 10)
                {
                    if ($osoba = $this->osobyRepository->findBy(array('rc' => $values->popis))->fetch())
                    {
                        $this->redirect('prehled', $osoba->id);
                    }
                    else
                    {
                        $form->addError('Nebyla nalezena osoba se zadaným rodným číslem');
                    }
                }
                else
                {
                    $form->addError('Nebyla nalezena osoba se zadaným id nebo rodným číslem');
                }
            }
            else
            {
                $text = NStrings::firstUpper($values->popis);
                if ($vyhledane_osoby = $this->osobyRepository->vyhledatOsoby($text))
                {
                    if (($vyhledane_osoby->getRowCount()) == 0)
                    {
                        $form->addError('Nebyla nalezena osoba se zadaným jménem');
                    }
                    elseif (($vyhledane_osoby->getRowCount()) == 1)
                    {
                        $id = $vyhledane_osoby->fetch()->id;
                        $this->redirect("prehled", $id);
                    }
                    else
                    {
                        $this->redirect("default", $text);
                    }
                }
            }
        }
    }

    public function actionAutoComplete($term)
    {
        $text = NStrings::firstUpper(trim($term));
        if ($text !== '')
        {
            $vyhledane_osoby = $this->osobyRepository->vyhledatOsoby($text);
            $i = 1;
            foreach ($vyhledane_osoby as $osoba)
            {
                $payload[$i]['label'] = $osoba['prijmeni'] . ' ' . $osoba['jmeno'] . ' ' . $this->helperRokNarozeni($osoba['rc']);
                $payload[$i]['value'] = $osoba['id'];
                $i++;
            }
        }
        $this->sendResponse(new NJsonResponse($payload));
    }

//===================== DETAIL OSOBY ============================
    public function actionPrehled($id = null)
    {

        if (!$id)
        {
            $id = $this->getUser()->id;
        }

        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['view'] || !$this->osoba = $this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
    }

    public function renderPrehled()
    {
        $this->template->osoba = $this->osoba;
    }

//=================== UPRAVIT OSOBU ============================= ID=1 omezeně,  A=2 vše
    public function actionEdit($id)
    {
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['edit'] || !$this->osoba = $this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
        $this->id = $id;
        $this->template->osoba = $this->osoba;
    }

    protected function createComponentUpravitOsobuForm()
    {
        $rezim = $this->admin > 2 ? 2 : 1;
        $values = $this->osoba;
        $form = new UpravitOsobuForm($rezim, $values);
        $form->onSuccess[] = callback($this, 'upravitOsobuFormSubmitted');
        $form->onValidate[] = callback($this, 'kontrolaMailu');
        return $form;
    }

    public function upravitOsobuFormSubmitted(UpravitOsobuForm $form)
    {
        $values = $form->getValues();
        $errors = array();

        //odeslat upozornění o změně mailu nebo telefonu
        $zaznam = $this->osobyRepository->findById($this->id);
        if ($zaznam->email && ($zaznam->email != $values->email || $zaznam->telefon != $values->telefon || $zaznam->mobil != $values->mobil))
        {
            $mail = $this->odeslani_mailu->createMail();
            $mail->addTo($zaznam->email)
                    ->setSubject('GIS - Změna osobních údajů');

//                $mail = new OdesilaniMailu($this->context->parameters["debugMode"]);
//                $mail->setFrom($this->context->parameters['mail']['from'])
//                        ->addTo($zaznam->email)
//                        ->setSubject('GIS - Změna osobních údajů');
            $body = '';
            if ($zaznam->email != $values->email)
            {
                $body.="Byla změnena e-mailová adresa z $zaznam->email na $values->email. ";
            }
            if ($zaznam->telefon != $values->telefon)
            {
                $body.="Bylo změněno tefelonní číslo z $zaznam->telefon na $values->telefon";
            }
            if ($zaznam->mobil != $values->mobil)
            {
                $body.="Bylo změněno telefonní číslo z $zaznam->mobil na $values->mobil";
            }
            $mail->setBody($body)
                    ->send();
        }

        //uložit změny
        $osoba = new Osoba($this->id);
        $osoba->setUdaje($values, ($form->rezim == 1) ? FALSE : TRUE);
        if (!isset($osoba->error))
        {
            try{
            $zaznam = $this->osobyRepository->ulozitOsobu($osoba);
            $this->logg("osoba $this->id upravena");
            if ($zaznam['novy_mail'])
            {
                $this->vygenerovatPristupoveUdaje($this->id);
            }
            $this->redirect("Osoby:prehled", $this->id);
            }
            catch(GException $e)
            {
                $form->addError($e->getMessage());
            }
        }
        else
        {
            $errors[] = $osoba->error;
            foreach ($errors as $error)
            {
                $form->addError($error);
            }
        }
    }

    public function renderEdit()
    {
        
    }

//================ HISTORIE ===================  
    public function actionHistorie($id = null)
    {
        if (!$id)
        {
            $id = $this->getUser()->id;
        }
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['view'] || !$this->osoba = $this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
        $this->id = $id;
        $this->template->osoba = $this->osoba;
        $this->template->sporty = $this->getService('sportyRepository')->getSporty();
        $this->template->registrace = $this->registrace->oddilyOsoba($this->osoba->id);
        $this->template->evidence = $this->registrace->oddilyOsoba($this->osoba->id, 'E');
        $this->template->lze_smazat_registrace = $this->registrace->posledniZaznam($id, 'R');
        $this->template->lze_smazat_evidence = $this->registrace->posledniZaznam($id, 'E');
    }

    public function actionHistorieDelete($id, $id_zaznamu, $typ_zaznamu)
    {
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['historie_delete'] || !$this->osoba = $this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
        if (!in_array($id_zaznamu, $this->registrace->posledniZaznam($id, $typ_zaznamu)))
        {
            $this->flashMessage('Lze odstranit pouze poslední záznam');
            $this->redirect('historie', $id);
        }

        $this->id = $id;

        if ($zaznam = $this->registrace->smazatZaznam($id_zaznamu, $typ_zaznamu))
        {
            if ($typ_zaznamu == 'R')
            {
                $this->logg("osoba $id zrušena registrace - oddíl: $zaznam[oddil], sport: $zaznam[sport], rok: " . date('Y'));
            }
            elseif ($typ_zaznamu == 'E')
            {
                $this->logg("osoba $id zrušena evidence - oddil: $zaznam[oddil], rok: " . date('Y'));
            }
            $this->flashMessage('Záznam byl odstraněn.');
        }
        else
        {
            $this->flashMessage('Zaznam nelze odstranit.');
        }
        $this->redirect('historie', $id);
    }

//================ NOVÁ OSOBA ================= A=2
    public function actionAdd()
    {
        $this->opravneni = $this->opravneni();
        if (!$this->opravneni['add'])
        {
            $this->redirect('default');
        }
    }

    protected function createComponentAddOsobaForm()
    {

        $form = new UpravitOsobuForm(2);
        $form->onSuccess[] = callback($this, 'addOsobaFormSubmitted');
        $form->onValidate[] = callback($this, 'kontrolaMailu');
        return $form;
    }

    public function kontrolaMailu(NAppForm $form)
    {
        $values = $form->getValues();
        if ($values->email && !$this->osobyRepository->zkontrolovatDostupnostMailu($values->email))
        {
            $form->addError('Shodnou e-mailovou adresu může mít maximálně 5 osob. Zadejte jinou adresu.');
        }
    }

    public function addOsobaFormSubmitted(UpravitOsobuForm $form)
    {
        $potvrzeni = $this->getSession('potvrzeni');
        $values = $form->getValues();

        $osoba = new Osoba;
        $osoba->setUdaje($values);
        if (isset($osoba->error))
        {
            $form->addError($osoba->error);
        }
        else
        {
            //osoby s podobnými údaji (pokud se najdou, neukládat, pouze zobrazit)
            $podobne_osoby['narozeni'] = $this->osobyRepository->findByNarozeni($osoba->narozeni);
            $podobne_osoby['jmeno'] = $this->osobyRepository->findByJmenoPrijmeni($osoba->jmeno, $osoba->prijmeni);
            $this->template->podobne_osoby = $podobne_osoby;

            //jsou osoby se stejnými údaji?
            if (($podobne_osoby['narozeni']->count() > 0 || $podobne_osoby['jmeno']->count() > 0) && ($potvrzeni->narozeni != $values->narozeni || $potvrzeni->jmeno != $values->jmeno || $potvrzeni->prijmeni != $values->prijmeni))
            {
                //vypsat do šablony a znova uložit hodnoty do session, NEUKLÁDÁ SE
                $potvrzeni->jmeno = $values->jmeno;
                $potvrzeni->prijmeni = $values->prijmeni;
                $potvrzeni->narozeni = $values->narozeni;
            }
            else
            {
                try
                {
                    $zaznam = $this->osobyRepository->ulozitOsobu($osoba, TRUE);
                    unset($potvrzeni->jmeno);
                    unset($potvrzeni->prijmeni);
                    unset($potvrzeni->narozeni);
                    if (isset($zaznam['dotaz']))
                    {
                        $potvrzeni_admina = $this->getSession('nova_osoba_admin');
                        $potvrzeni_admina->osoba = $osoba;
                        $this->redirect('novaOsobaPotvrzeni');
//                    $this->template->rozhodnuti_admina = TRUE;
//                    dd($this->template->rozhodnuti_admina, 'potrvzeni_admina');
                    }
                    else
                    {
                        if (!isset($zaznam['dotaz']))
                        {
                            if ($zaznam['akce'] == 'insert')
                            {
                                $this->logg("nová osoba $zaznam->id - jméno: $zaznam->prijmeni $zaznam->jmeno, narozeni: $zaznam->narozeni");
                            }
                            elseif ($zaznam['akce'] == 'update')
                            {
                                $this->logg("osoba $zaznam->id upravena");
                            }
                            if ($zaznam['novy_mail'])
                            {
                                $this->vygenerovatPristupoveUdaje($zaznam['id']);
                            }
                            $this->redirect('prehled', $zaznam->id);
                        }
                    }
                }
                catch (GException $e)
                {
                    $form->addError($e->getMessage());
                }
            }
        }
    }

    public function actionNovaOsobaPotvrzeni()
    {
        $this->opravneni = $this->opravneni();
        $potvrzeni_admina = $this->getSession('nova_osoba_admin');
        $osoba = $potvrzeni_admina->osoba->getUdaje();
        $this->template->nova_osoba = $osoba;
//        $this->template->osoba = $potvrzeni_admina->osoba->getUdaje();
        $this->template->nalezene_osoby = $this->osobyRepository->findBy(array('jmeno' => $osoba['jmeno'], 'prijmeni' => $osoba['prijmeni'], 'narozeni' => $osoba['narozeni']));
    }

    protected function createComponentNovaOsobaPotvrzeniForm()
    {
        $form = new JednotlacitkovyForm('Vytvořit novou osobu');
        $form->onSuccess[] = callback($this, 'novaOsobaPotvrzeniFormSubmitted');
        $form->addSubmit('storno', 'Storno')->onClick[] = callback($this, 'novaOsobaPotvrzeniFormStorno');
        return $form;
    }

    public function novaOsobaPotvrzeniFormStorno(NButton $button)
    {
        $this->redirect('default');
    }

    public function novaOsobaPotvrzeniFormSubmitted(NAppForm $form)
    {
        $this->redirect('potvrzeniAdd', true);
    }

    public function actionPotvrzeniAdd($vytvorit_novou_osobu)
    {
        $potvrzeni_admina = $this->getSession('nova_osoba_admin');
        $osoba = $potvrzeni_admina->osoba;
        try
        {
            if ($vytvorit_novou_osobu)
            {
                $zaznam = $this->osobyRepository->ulozitOsobu($osoba, TRUE, 'I');
                $this->logg("nová osoba $zaznam->id - jméno: $zaznam->prijmeni $zaznam->jmeno, narození: $zaznam->narozeni");
            }
            else
            {
                $zaznam = $this->osobyRepository->ulozitOsobu($osoba, TRUE, 'U');
                $this->logg("osoba $zaznam->id upravena");
            }
            $this->redirect('prehled', $zaznam->id);
        }
        catch (GException $e)
        {
            $this->flashMessage($e->getMessage());
        }
    }

//======================== PŘESTUP ======================================== A=2
    public function actionPrestup($id)
    {
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['prestup'])
        {
            $this->redirect('default');
        }
        $this->id = $id;
        $this->aktualni_registrace = $this->registrace->registraceKPrestupu($this->id);
        $this->template->osoba = $this->osobyRepository->findById($id);
        $this->template->povolit_prestup = count($this->aktualni_registrace);
    }

    protected function createComponentPrestupForm()
    {
        $form = new PrestupForm($this->aktualni_registrace);
        $form->onSuccess[] = callback($this, 'prestupFormSubmitted');
        $form->onValidate[] = callback($this, 'prestupFromValidate');
        return $form;
    }

    public function prestupFromValidate(PrestupForm $form)
    {
        $values = $form->getValues();
        if (!$values->id_oddilu)
        {
            $form->addError('Nezvolili jste nový oddíl.');
        }
    }

    public function prestupFormSubmitted(PrestupForm $form)
    {
        $values = $form->getValues();
        if (preg_match('~(.*)_(.*)~', $values['registrace'], $tmp))
        {
            try
            {
                $this->registrace->prestup($this->id, $tmp[1], $values->id_oddilu, $tmp[2]);
                $this->logg("osoba $this->id přestup - oddil: $values->id_oddilu, datum: $tmp[2], registrace: $tmp[1]");
                $this->redirect('historie', array('id' => $this->id));
            }
            catch (GException $e)
            {
                $form->addError($e->getMessage());
            }
        }
        else
        {
            $form->addError('Přestup se neprovedl.');
        }
    }

    //======================== ZMĚNA HESLA ================================= ID=1, A=2 pouze u sebe
    public function actionZmenaHesla($id)
    {
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['zmena_hesla'] || !$this->osoba = $this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
        $this->id = $id;
    }

    protected function createComponentZmenaHeslaForm()
    {
        $form = new ZmenitHesloForm();
        $form->onSuccess[] = callback($this, 'zmenaHeslaFormSubmitted');
        return $form;
    }

    public function zmenaHeslaFormSubmitted(ZmenitHesloForm $form)
    {
        if (!$this->opravneni['zmena_hesla'])
        {
            $this->redirect('prehled', $this->id);
        }
        $values = $form->getValues();
        if ($this->osobyRepository->overitHeslo($this->getUser()->id, $values->old_password))
        {
            $this->osobyRepository->zmenitHeslo($this->getUser()->id, $values->password);
            $this->logg("osoba $this->id - změna hesla");
            $this->flashMessage('Heslo bylo změněno');
            $this->redirect('prehled', $this->id);
        }
        else
        {
            $form->addError('Neplatné staré heslo');
        }
    }

    //========================= ZMĚNA UŽIVATELSKÉHO JMÉNA ==================  A=1, A=2 pouze u sebe 
    public function actionZmenaJmena($id)
    {
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['zmena_hesla'] || !$this->osoba = $this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
        $this->id = $id;
    }

    protected function createComponentZmenaUzivatelskehoJmenaForm()
    {

        $form = new ZmenitUzivatelskeJmenoForm($this->osobyRepository->findById($this->id)->username);
        $form->onSuccess[] = callback($this, 'zmenaUzivatelskehoJmenaFormSubmitted');
        return $form;
    }

    public function zmenaUzivatelskehoJmenaFormSubmitted(ZmenitUzivatelskeJmenoForm $form)
    {
        if (!$this->opravneni['zmena_hesla'])
        {
            $this->redirect('prehled', $this->id);
        }
        $values = $form->getValues();
        if ($this->osobyRepository->overitHeslo($this->id, $values->password))
        {
            if (!$this->osobyRepository->findByUsername($values->username))
            {
                $this->osobyRepository->zmenitUzivatelskeJmeno($this->id, $values->username);
                $this->logg("osoba $this->id - změna uživatelského jména");
                $this->redirect('prehled', $this->id);
            }
            else
            {
                $form->addError('Toto uživatelské jméno již někdo používá. Zvolte jiné.');
            }
        }
        else
        {
            $form->addError('Neplatné heslo');
        }
    }

    //====================== ZMĚNA PŘÍSTUPOVÝCH ÚDAJŮ ====================== A=2 vygenerovat a poslat heslo, nemůže u sebe
    public function actionZmenaPristupovychUdaju($id)
    {
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['pristupove_udaje'] || !$this->osoba = $this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
        $this->id = $id;
        $this->template->osoba = $this->osoba;
    }

    protected function createComponentVygenerovatHesloForm()
    {
        $form = new JednotlacitkovyForm('Vygenerovat nové heslo');
        $form->onSuccess[] = callback($this, 'vygenerovatHesloFormSublitted');
        return $form;
    }

    public function vygenerovatHesloFormSublitted(JednotlacitkovyForm $form)
    {
        if (!$this->opravneni['pristupove_udaje'])
        {
            $this->redirect('prehled', $this->id);
        }
        $this->vygenerovatPristupoveUdaje($this->id);
        $this->redirect('prehled', $this->id);
    }

    //========================= SMAZAT OSOBU ======================= A=2
    public function actionDelete($id)
    {
        $this->opravneni = $this->opravneni($id);
        if (!$this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
        if (!$this->opravneni['delete'])
        {
            $this->redirect('prehled', $id);
        }
        $this->prava->smazatPravaOsoba($id);
        $this->osobyRepository->smazatOsobu($id);
        $this->logg("osoba $id smazána");
        $this->redirect('prehled', $id);
    }

    public function actionObnovit($id)
    {
        $this->opravneni = $this->opravneni($id);
        if (!$this->opravneni['delete'])
        {
            $this->redirect('prehled', $id);
        }
        if (!$this->osobyRepository->findById($id))
        {
            $this->redirect('default');
        }
        $this->osobyRepository->obnovitOsobu($id);
        $this->logg("osoba $id obnovena");
        $this->redirect('prehled', $id);
    }

    //============================ STATISTIKA ======================= A=1
    public function actionStatistika()
    {
        $this->opravneni = $this->opravneni();
        if (!$this->opravneni['statistika'])
        {
            $this->redirect('default');
        }
        $statistika = $this->getService('statistika');
        $this->template->kraje = $statistika->osobyKraje();

        $this->template->sporty = $statistika->osobySporty();
        ;
        $this->template->osoby_vek = $statistika->osobyVek();
        $this->template->pocet_osob = $statistika->pocetOsob();
    }

    //======================== PRÁVA ================================

    public function actionPrava($id = null, $text = null) //A=2 nahlížení, A=5 editace nižším
    {
        $this->id = null;
        $this->opravneni = $this->opravneni();
        if (!$this->admin)
        {
            $this->redirect('default');
        }
        $this->id = 0;


        if ($text)
        {
            $this->template->osoby = $this->osobyRepository->vyhledatOsoby($text);
        }
        if ($this->prava->prava($this->modul, $this->id, $this->getUser()->id) > 3)
        {
            $this->template->moznost_uprav = 1;
        }
        else
        {
            $this->template->moznost_uprav = 0;
        }
    }

    protected function createComponentNastaveniPravComponent()
    {
        return new NastaveniPravControl($this->osobyRepository->findById($this->id_osoby));
    }

    public function actionNastaveniPrav($id, $osoba)
    {
        $this->opravneni = $this->opravneni();
        if (!($this->prava->prava($this->modul, $this->id, $this->getUser()->id) > 3))
        {
            $this->redirect('prava');
        }
        $this->id = $id;
        $this->id_osoby = $osoba;
        if ($this->prava->prava($this->modul, $this->id, $this->getUser()->id) <= $this->prava->prava($this->modul, $this->id, $osoba))
        {
            $this->flashMessage('Práva lze upravit pouze osobám s nižšími právy', 'info');
            $this->redirect('prava', $id);
        }
    }

    public function actionNapoveda()
    {
        $this->opravneni = $this->opravneni();
        $this->id = null;
    }

//====================================================================
    protected function createComponentBocniMenu()
    {

        $menu = new MenuControl();
        $id = $this->getUser()->id;

        if ($this->admin)
        {
            if ($this->opravneni['hledat']) $menu->addItem('Hledat', 'default');
            if ($this->opravneni['add']) $menu->addItem('Nová osoba', 'add');
            if ($this->opravneni['statistika'])
                    $menu->addItem('Statistika', 'statistika');
            $menu->addItem('Práva', "prava");
        }
        else
        {
            $menu->addItem('Osobní údaje', 'prehled');
            $menu->addItem('Upravit', 'edit', $id);
            $menu->addItem('Změna jména', 'zmenaJmena', $id);
            $menu->addItem('Změna hesla', 'zmenaHesla', $id);
            $menu->addItem('Historie', 'historie', $id);
        }

        $menu->addItem('Nápověda', 'napoveda');
        return $menu;
    }

    //=====================================================================
    public function opravneni($id = null)
    {
        $opravneni = array(
            'view' => FALSE,
            'edit' => FALSE,
            'zmena_hesla' => FALSE,
            'pristupove_udaje' => FALSE,
            'prestup' => FALSE,
            'delete' => FALSE,
            'add' => FALSE,
            'hledat' => FALSE,
            'statistika' => FALSE,
            'historie_delete' => FALSE,
        );
        if ($id)
        {
            if ($this->admin >= 1 || $id == $this->getUser()->id)
            {
                $opravneni['view'] = TRUE;
            }
            if ($this->admin >= 3 || $id == $this->getUser()->id)
            {
                $opravneni['edit'] = TRUE;
            }
            if ($id == $this->getUser()->id)
            {
                $opravneni['zmena_hesla'] = TRUE;
            }
            if ($this->admin >= 3 && $id != $this->getUser()->id)
            {
                $opravneni['pristupove_udaje'] = TRUE;
            }
            if ($this->admin >= 5)
            {
                $opravneni['prestup'] = TRUE;
            }
            if ($this->admin >= 5)
            {
                $opravneni['historie_delete'] = TRUE;
            }
        }

        if (($this->admin) >= 1)
        {
            $opravneni['statistika'] = TRUE;
            $opravneni['hledat'] = TRUE;
        }

        if (($this->admin >= 3))
        {
            $opravneni['add'] = TRUE;
        }
        dd($opravneni, 'oprávnění');
        return $opravneni;
    }

}