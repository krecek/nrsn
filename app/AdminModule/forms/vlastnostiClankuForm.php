<?php

class VlastnostiClankuForm extends NAppForm
{

    public function __construct($values = null)
    {
        parent::__construct();
        $this->addText('zobrazit_od', 'Zobrazovat od:')->setDefaultValue(date('j.n.Y'));
        $this->addText('zobrazit_do', 'Zobrazovat do:')->setDefaultValue(date('j.n.Y', strtotime('+1 years')));
        $this->addCheckbox('hlavni_strana', 'Zobrazit na hlavní straně');
        $this->addCheckbox('top', 'Top');
        $this->addSubmit('send', 'Uložit');
 
        if(isset($values))
        {
            if(isset($values['zobrazit_od']) && $values['zobrazit_od']->format('Y-m-d')!='-0001-11-30') $this['zobrazit_od']->setDefaultValue($values['zobrazit_od']->format('j.n.Y'));
            if(isset($values['zobrazit_do']) && $values['zobrazit_do']->format('Y-m-d')!='-0001-11-30') $this['zobrazit_do']->setDefaultValue($values['zobrazit_do']->format('j.n.Y'));
            if(isset($values['hlavni_strana'])) $values['hlavni_strana']=='N'? $this['hlavni_strana']->setDefaultValue(FALSE): $this['hlavni_strana']->setDefaultValue(TRUE);
            if(isset($values['top'])) $values['top']=='N'? $this['top']->setDefaultValue(FALSE):$this['top']->setDefaultValue(TRUE);
        }
    }

}

?>
