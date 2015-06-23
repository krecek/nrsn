<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UpravitMenuForm extends NAppForm
{
    public $pocet_polozek = 12;
    public function __construct($values=null)
    {
        parent::__construct();
        for($i=1;$i<=$this->pocet_polozek;$i++)
        {
           $this->addText("nazev_$i", "Název:",40);
           $this->addText("url_$i", "Url:", 40);
           $this->addHidden("poradi_$i");
           $this->addHidden("id_$i");
        }
        $this->addSubmit('send', 'Uložit');
        if($values)
        {
            foreach($values as $key=>$polozka)
            {
                if(isset($this["nazev_$key"]))$this["nazev_$key"]->setDefaultValue($polozka['nazev']);
                if(isset($this["url_$key"]))$this["url_$key"]->setDefaultValue($polozka['url']);
                if(isset($this["poradi_$key"])) $this["poradi_$key"]->setDefaultValue($polozka['poradi']);
                if(isset($this["id_$key"])) $this["id_$key"]->setDefaultValue($polozka['id']);
            }
        }
    }
    
}

?>
