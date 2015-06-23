<?php

class WebMenuControl extends NControl
{

    /**
     * (non-phpDoc)
     *
     * @see Nette\Application\Control#render()
     */
    private $items = array();

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/webMenu.latte');
        $this->template->items = $this->items;
        $this->template->render();
    }

    public function addItem($text, $odkaz, $parametry = null, $aktivni = TRUE)
    {
        $this->items[$text]['odkaz'] = $odkaz;
        $this->items[$text]['parametry'] = $parametry;
        $this->items[$text]['aktivni'] = $aktivni;
        return $this;
    }

}

?>
