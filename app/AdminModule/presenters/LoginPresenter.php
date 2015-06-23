<?php 
class Admin_LoginPresenter extends AdminBasePresenter
{
     /** @var Logger */
    public $logger;
    
    protected function startup()
    {
        parent::startup();
        $this->logger = $this->getService('logger');
        $this->getUser()->logout(TRUE);
    }
    public function actionDefault()
    {
//        $rev=`svnversion -n ./`; // sposti shell prikaz
//////        dd($rev, 'rev');
//        preg_match('/^(\d+:)?(\d+)/',$rev,$match);
//        $this->template->verze = $match[2];
        $this->template->verze = 1;
        
    }


    protected function createComponentLoginForm() {
               
        $backlink2 = $this->getSession('backlink2');
        $form = new LoginForm;
        $form->onSuccess[] = $this->loginFormSubmitted;
        return $form;
    }

    public function loginFormSubmitted($form) {
         $backlink2 = $this->getSession('backlink2');
         $httpRequest = $this->getService('httpRequest');
         $values = $form->getValues();
        try {
            $user = $this->getUser();
            
            $user->login($values->username, $values->password);
            $this->logger->setId_uzivatele($this->getUser()->id);
            
            $this->logg("úspěšné přihlášení - username: ".$values->username.", ip: ".$httpRequest->getRemoteAddress());
//            $this->flashMessage('Přihlášení bylo úspěšné.', 'success');
            $this->restoreRequest($backlink2->backlink);
            $this->redirect('Homepage:');
        } catch (NAuthenticationException $e) {
            $this->logg("neúspěšné přihlášení - jméno: $values->username, heslo: $values->password, ip: ".$httpRequest->getRemoteAddress());
            $form->addError($e->getMessage());
        }
    }

    public function handleOdhlasit() {
        $this->getUser()->logout(TRUE);
        $this->flashMessage('Byl jste odhlášen.');
        $this->redirect('Login:');
    }
    
    public function logg($text)
    {
        $this->logger->logg($text);
    }
    
     

}




