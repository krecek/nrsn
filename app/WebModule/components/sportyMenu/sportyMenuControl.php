<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SportyMenuControl extends NControl
{
    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/sportyMenu.latte');
        $this->template->render();
    }
}

?>
