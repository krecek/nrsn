<?php

class seznamOstatnichPrilohControl extends NControl
{

    private $prilohy;

    public function __construct($prilohy)
    {
        parent::__construct();
        $this->prilohy = $prilohy;
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/seznamOstatnichPriloh.latte');
        $this->template->prilohy = $this->prilohy;
        $this->template->render();
    }

}

?>
