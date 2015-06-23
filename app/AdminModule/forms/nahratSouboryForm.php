<?php

class NahratSouboryForm extends NAppForm
{
    public function __construct($pocet_poli=5)
    {
        parent::__construct();
        for($i=0;$i<$pocet_poli;$i++)
        {
            $this->addUpload('soubor_'.$i, 'Soubor:');//->addRule(NForm::MIME_TYPE, 'Nepovolený typ souboru.', 'image/png');
        }
        $this->addSubmit('send', 'Uložit soubory');
    }
}

?>
