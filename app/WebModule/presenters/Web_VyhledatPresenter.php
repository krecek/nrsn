<?php

class Web_VyhledatPresenter extends Web_AplikacePresenter
{

    /** @var OddilyRepository */
    public $oddilyRepository;

    /** @var OsobyRepository */
    public $osobyRepository;

    protected function startup()
    {
        parent::startup();
        $this->oddilyRepository = $this->getService('oddilyRepository');
        $this->osobyRepository = $this->getService('osobyRepository');
        $this->mininavigace[] = array('nazev' => 'Vyhledávání', 'url' => 'Vyhledat:', 'poradi' => '3');
    }

    public function actionDefault($text = null)
    {
        if (!$text) $this->setView('formular');
        else
        {
            $this->clanky = $this->redakce->findClankyFulltext($text);
            $this->template->oddily = $this->oddilyRepository->vyhledatOddily($text);
            $this->template->osoby = $this->osobyRepository->vyhledatOsoby($text);
            $this->template->akce = $this->spravceAkci->vyhledatAkce($text);
        }
    }

}

?>
