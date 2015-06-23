<?php

class ZobrazeniPrilohVSeznamuAkciControl extends NControl
{
    private $typ;
    private $seznam_priloh;
    public function __construct($typ, $seznam_priloh)
    {
        $this->typ = $typ;
        $this->seznam_priloh = $seznam_priloh;
    }
    
    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/zobrazeniPrilohVSeznamuAkci.latte');
        $this->template->typ = $this->typ;
        $this->template->prilohy = $this->seznam_priloh;
    }
}

?>
