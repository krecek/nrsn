<?php

class SeznamClanku extends NControl
{

    private $seznam_clanku;

    public function __construct($seznam_clanku)
    {
        parent::__construct();
        $this->seznam_clanku = $seznam_clanku;
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/seznamClanku.latte');
        $this->template->clanky = $this->seznam_clanku;
        $this->template->render();
    }

    public function handleNastavitHlavniStranu($id, $hodnota)
    {
        $values['hlavni_strana'] = $hodnota ? 'A' : 'N';
        $clanek = new Clanek($id);
        $clanek->setUdaje($values);
        $this->presenter->redakce->ulozitClanek($clanek);
        if ($this->isAjax())
        {
            $this->invalidateControl();
            $this->render();
        }
        else
        {
            $this->flashMessage(';');
            $this->redirect('default');
        }
    }

}

?>
