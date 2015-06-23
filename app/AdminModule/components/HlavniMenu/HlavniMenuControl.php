<?php

class HlavniMenuControl extends NControl
{

    private $items = array();
    public $aktivni;

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/hlavniMenu.latte');
        $this->template->items = $this->items;
        $this->template->aktivni = $this->aktivni;
        $this->template->render();
    }

    public function addItem($text, $odkaz)
    {
        $this->items[$text]['odkaz'] = $odkaz;

        return $this;
    }

    public function setAktivni($odkaz)
    {
        $this->aktivni = $odkaz;
    }

}