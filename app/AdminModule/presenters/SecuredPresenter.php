<?php

class SecuredPresenter extends AdminBasePresenter
{

    /** @var Logger */
    public $logger;

    /** @var Opravneni */
    public $prava;
    public $admin;
    public $modul;
    protected $id_osoby;
    public $id;
    public $pristup;
    public $opravneni;




    /** @var OsobyRepository */
    public $osobyRepository;

    /** @var Registrace */
    public $registrace;
    
    /** @var OdeslaniMailu */
    public $odeslani_mailu;

    protected function startup()
    {
        parent::startup();
        if (!$this->user->isLoggedIn())
        {
            $backlink2 = $this->getSession('backlink2');
            $backlink2->backlink = $this->storeRequest();
            $this->redirect('Login:');
        }
	$this->odeslani_mailu = $this->getService('odeslaniMailu');
        $this->prava = $this->getService('prava');
        $this->prava->setId_osoby($this->getUser()->id);
        dd($this->modul, 'modul');
        if ($this->modul)
        {
            if (!$this->prava->prava($this->modul))
            {
//                $this->redirect('Homepage:');
             $this->setView('../NepovolenyPristup');
            $this->renderNepovolenyPristup();
                
//                $this->template->render();
            }
            else{
                $this->pristup = TRUE;
                
            }
            if (!$this->admin = $this->prava->prava($this->modul, 0))
            {
                $this->admin = 0;
            }
        }
        dd($this->pristup, 'pristup');
        $this->logger = $this->getService('logger');
        $this->logger->setId_uzivatele($this->getUser()->id);
    }
    
    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->admin = $this->admin;
        if (isset($this->opravneni))
        {
            $this->template->opravneni = $this->opravneni;
        }
    }
    
    public function renderNepovolenyPristup()
    {
        
    }

    public function handleOdhlasit()
    {
        $this->getUser()->logout(TRUE);
        $this->redirect('Login:');
    }

    //===================== PRÁVA =================================

    public function actionPrava($id = null, $text = null)
    {
        if ($id)
        {
            $this->id = $id;
        }
        else
        {
            $this->id = 0;
        }

        if ($text)
        {
            $this->template->osoby = $this->osobyRepository->vyhledatOsoby($text);
        }
        if ($this->prava->prava($this->modul, $this->id, $this->getUser()->id) > 3 || $this->admin > 3)
        {
            $this->template->moznost_uprav = 1;
        }
        else
        {
            $this->template->moznost_uprav = 0;
        }
        $this->opravneni = $this->opravneni($id);
    }

       protected function createComponentPrehledPrav()
    {

        $control= new PrehledPravControl($this->prava->getPrehledPrav($this->modul, $this->id));
        if(isset($this->id)) $control->setId($this->id);
        return $control;
    }

    protected function createComponentPriraditPravaForm()
    {
        $form = new VyhledatForm('Vyhledat osobu:', 'vyhledat_osobu');
        $form->onSuccess[] = callback($this, 'priraditPravaFormSubmitted');
        return $form;
    }

    public function priraditPravaFormSubmitted(VyhledatForm $form)
    {
        $values = $form->getValues();
         //je zadané id (pouze přes autocomplete)
        if ($values->id)
        {
            if ($osoba = $this->osobyRepository->findById($values->id))
            {
                $id_osoby = $values->id;
            }
            else
            {
                $form->addError('Nebyla nalezena osoba se zadaným id');
            }
        }
        else
        {
            if (intval($values->popis))
            //id nebo část jména?
            {
                if (NStrings::length($values->popis) == 6)
                {
                    if ($osoba = $this->osobyRepository->findById($values->popis))
                    {
                        $id_osoby = $values->popis;
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
                        $id_osoby = $osoba->id;
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
            else {
                $text = NStrings::firstUpper($values->popis);
                if ($vyhledane_osoby = $this->osobyRepository->vyhledatOsoby($text))
                {
                    if (($vyhledane_osoby->getRowCount()) == 0)
                    {
                        $form->addError('Nebyla nalezena osoba se zadaným jménem');
                    }
                    elseif (($vyhledane_osoby->getRowCount()) == 1)
                    {
                        $id_osoby = $vyhledane_osoby->fetch()->id;
                    }
                    else
                    {
                        $this->redirect('prava', array(
                            'id' => $this->id,
                            'text' => $values->popis,
                        ));
                    }
                }
            }
        }
                   if (isset($id_osoby))
            {
                $this->redirect('nastaveniPrav', array(
                    'id' => $this->id,
                    'osoba' => $id_osoby));
            }
    }

    public function actionNastaveniPrav($id, $osoba)
    {

        $this->id = $id;
        $this->id_osoby = $osoba;
        if (!($this->prava->prava($this->modul, $this->id, $this->getUser()->id) > 3) && !($this->admin > 3))
        {
            $this->redirect('prava', $this->id);
        }
        if ($this->prava->prava($this->modul, $this->id, $this->getUser()->id) <= $this->prava->prava($this->modul, $this->id, $osoba) && $this->admin <= $this->prava->prava($this->modul, $this->id, $osoba))
        {
            $this->flashMessage('Práva lze upravit pouze osobám s nižšími právy', 'info');
            $this->redirect('prava', $id);
        }
        $this->opravneni = $this->opravneni($id);
    }

      protected function createComponentNastaveniPravComponent()
    {
        $admin = $this->admin;
        $control =  new NastaveniPravControl($this->osobyRepository->findById($this->id_osoby), $admin);
        if (isset($this->id)) $control->setId($this->id);
        return $control;
     }

    public function logg($text)
    {
        $this->logger->logg($text);
    }


    //=========================== HLAVNÍ MENU ===================================
    protected function createComponentHlavniMenu()
    {
        $menu = new HlavniMenuControl();
        $presenter = $this->name;

        if (preg_match('~Gis:(.*)~', $this->name, $tmp))
        {
            $menu->aktivni = "$tmp[1]:";
        }
        $menu->addItem('Uživatelé', 'Osoby:');
        $menu->addItem('Rubriky', 'Rubriky:');
        $menu->addItem('Články', 'Zavody:');
        $menu->addItem('Banka', 'Banka:');
        $menu->addItem('Redakce', 'Redakce:');

        return $menu;
    }
    
    public function vygenerovatPristupoveUdaje($id)
    {
        $zaznam = $this->osobyRepository->findById($id);
        if ($zaznam->email)
        {
            if (!$zaznam->username)
            {
                $username = $this->osobyRepository->generovatUsername($id);
                $this->osobyRepository->zmenitUzivatelskeJmeno($id, $username);
            }
            else
            {
                $username = $zaznam->username;
            }
            $heslo = Authenticator::generovatHeslo();
            $this->osobyRepository->zmenitHeslo($id, $heslo);
            $this->logg("osoba $id - vygenerovány nové přístupové údaje");

	    $mail = $this->odeslani_mailu->createMail();
	    $mail->addTo($zaznam->email)
                    ->setSubject('Přístupové údaje k systému GIS')
                    ->setBody("Vaše nové přihlašovací údaje k systému GIS:\nuživatelské jméno: $username \nuživatelské heslo: $heslo \nPřihlásit se můžete na adrese " . $this->context->parameters['prihlasovaci_stranka'] . "\n Po prvním přihlášení si změňte heslo.\nEmail je generován strojově, prosím, neodpovídejte.\n");
 
            $mail->send();
            $this->flashMessage('Nové heslo bylo odesláno.');
            return TRUE;
        }
        else
        {
            $this->logg("osoba $id - nelze vygenerovat heslo, není zadaný email");
            $this->flashMessage('Nelze vygenerovat heslo, není vyplněný email', 'error');
            return FALSE;
        }
    }
    
        }
