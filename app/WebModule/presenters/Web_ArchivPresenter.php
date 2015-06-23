<?php

class Web_ArchivPresenter extends Web_AplikacePresenter
{

    protected function startup()
    {
        parent::startup();
        $this->mininavigace[] = array('nazev' => 'Archiv', 'url' => 'Archiv:', 'poradi' => '3');
    }

    public function actionDefault($rok=null)
    {

        if (!$rok)
        {
            $roky = $this->redakce->rokyProArchiv();
            $this->template->roky = $roky;
            $this->setView('roky');
        }
        else
        {
            $clanky = $this->redakce->findClankyByRok($rok);
            $this->template->clanky = $clanky;
            $this->template->rok = $rok;
            $this->setView('archiv');
        }
    }

}

?>
