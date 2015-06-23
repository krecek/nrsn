<?php

class Admin_HesloPresenter extends BasePresenter
{

    /** @var Logger */
    public $logger;

    /** @var OsobyRepository */
    public $osobyRepository;

    /** @var OdeslaniMailu */
    public $odeslani_mailu;
    private $klic;
    private $id;

    protected function startup()
    {
        parent::startup();
        $this->logger = $this->getService('logger');
        $this->getUser()->logout(TRUE);
        $this->osobyRepository = $this->getService('osobyRepository');
        $this->odeslani_mailu = $this->getService('odeslaniMailu');
    }

    public function actionZapomenuteHeslo()
    {
        
    }

    protected function createComponentZapomenuteHesloForm()
    {
        $form = new ZapomenuteHesloForm();
        $form->onSuccess[] = callback($this, 'zapomenuteHesloFormSubmitted');
        return $form;
    }

    public function zapomenuteHesloFormSubmitted(ZapomenuteHesloForm $form)
    {
        $values = $form->getValues();
        $email = $values['email'];
        $osoby = $this->osobyRepository->findBy(array('email' => $email));
        if (!$osoby->count()) 
        {
            $this->flashMessage('Zadaný email nebyl nalezen.');
            $this->redirect('Login:default');
            
        }
        $httpRequest = $this->context->getService('httpRequest');
        $url = $httpRequest->getUrl();
        $body = "Chcete změnit heslo do GISu a údaje zaslat?\nPokud chcete výše uvedenou žádost potvrdit, klepněte na přiložený odkaz:\n\n";
        foreach ($osoby as $osoba)
        {
            if ($osoba['password'])
            {
                $odkaz = ($httpRequest->isSecured() ? 'https://' : 'http://') . $url->host . $this->link('Heslo:nove', $osoba['password']);
                $body.=$odkaz .' '. $osoba['id'] . ' ' . $osoba['jmeno'] . ' ' . $osoba['prijmeni'] ."\n\n";
            }
        }
        $body.='V opačné případě nedělejte nic.'."\n";
        $body.="Email je generován strojově, prosím, neodpovídejte.\n";
        $mail = $this->odeslani_mailu->createMail();
        $mail->addTo($email)
                ->setSubject('GIS - změna hesla')
                ->setBody($body);
        $mail->send();
        $this->flashMessage('Na Vaši adresu byl odeslán email s instrukcemi.');
        $this->redirect('Login:default');
    }

    public function actionNove($klic)
    {
        $osoby = $this->osobyRepository->findBy(array('password' => $klic));
        if ($osoby->count() != 1) $this->redirect('chyba');
        $osoba = $osoby->fetch();
        $this->id = $osoba['id'];
        $this->klic = $klic;
    }

    protected function createComponentPotvrditZmenuHeslaForm()
    {
        $values = array(
            'id_osoby' => $this->id,
            'klic' => $this->klic,
             );
        $form = new PotvrditZmenuHeslaForm($values);
        $form->onSuccess[] = callback($this, 'potvrditZmenuHeslaFormSubmitted');
        return $form;
    }

    public function potvrditZmenuHeslaFormSubmitted(PotvrditZmenuHeslaForm $form)
    {
        $values = $form->getValues();
        $osoby = $this->osobyRepository->findBy(array('password' => $values['klic']));
        if ($osoby->count() != 1) $this->redirect('chyba');
        $osoba = $osoby->fetch();
        $email = $osoba['email'];
        $username = $osoba['username'];
        dd($osoba, 'osoba');
        if($osoba['id']!=$values['id_osoby']) $this->redirect('chyba');
        $heslo = Authenticator::generovatHeslo();
        $this->osobyRepository->zmenitHeslo($osoba['id'], $heslo);
        $this->logg("osoba ".$osoba['id']." - vygenerovány nové přístupové údaje");
        $mail = $this->odeslani_mailu->createMail();
        $mail->addTo($email)
                ->setSubject('Přístupové údaje k systému GIS')
                ->setBody("Vaše nové přihlašovací údaje k systému GIS:\nuživatelské jméno: ".$username."\nuživatelské heslo: $heslo \n\nPřihlásit se můžete na adrese " . $this->context->parameters['prihlasovaci_stranka'] . "\n\nPo prvním přihlášení si změňte heslo.\nEmail je generován strojově, prosím, neodpovídejte.\n");
        $mail->send();
        $this->flashMessage('Nové heslo bylo odesláno na Váš email.');
        $this->redirect('Login:default');
    }

    public function actionChyba()
    {
        
    }

    protected function logg($text)
    {
        $this->logger->logg($text);
    }

}

?>
