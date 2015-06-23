<?php

class NastavitGaleriiForm extends NAppForm
{

    public function __construct($values)
    {
        parent::__construct();
        $this->addCheckbox('galerie', 'Zobazit galerii');
        $this->addCheckbox('prilohy', 'Zobrazit seznam příloh');
        $this->addCheckbox('zobrazit_obr', 'Zobrazit hlavní obrázek článku (pod perexem)');
        $this->addSubmit('send', 'Uložit');

        if (isset($values))
        {
            foreach($values as $key=>$value)
            {
                if ($value=='A') $values[$key]=TRUE;
                elseif ($value=='N') $values[$key]=FALSE;
            }
            $this->setDefaults($values);
        }
    }

}

?>
