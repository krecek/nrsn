<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseControl extends NControl
{

    protected function createTemplate($class = NULL)
    {

        $template = parent::createTemplate($class);
        $template->registerHelper('datumClanku', callback($this, 'helperDatumClanku'));
        return $template;
    }

    public function helperDatumClanku(DateTime $datum)
    {
        $now = new NDateTime53();
        if ($datum->format('Y-m-d') == $now->format('Y-m-d'))  return $datum->format('H:i'); //dnešní článek}
        if ($datum->format('Y') == $now->format('Y'))  return $datum->format('j.n.'); //článek je letošní
        if ($datum->format('Y-m-d') < $now->modify('-1 years')->format(('Y-m-d'))) return $datum->format('Y');//článek je starší než 1 rok
        return $datum->format('j.n.Y');
    }

}

?>
