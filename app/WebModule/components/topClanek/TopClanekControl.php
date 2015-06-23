<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TopClanekControl extends NControl
{

    private $clanek;

    public function __construct($clanek)
    {
        parent::__construct();
        $this->clanek = $clanek;
        dd($clanek, 'clanek');
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/topClanek.latte');
        $this->template->clanek = $this->clanek;
        $this->template->render();
    }

}

?>
