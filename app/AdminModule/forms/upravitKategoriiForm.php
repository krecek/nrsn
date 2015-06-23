<?php

class UpravitKategoriiForm extends NAppForm
{

    public function __construct($sporty, $values = null, $seznam_sportu = null)
    {
        parent::__construct();
        $this->addText('nazev', 'Název')->setRequired('Vyplňte název kategorie')->setAttribute('class', 'focus');
        $this->addSelect('sport', 'Sport', $seznam_sportu)->setRequired('Zvolte sport')->setHtmlId('sport');
        $this->addCheckbox('elektronicke_prihlasky', 'Elektronické přihlášky pomocí GISu')->setDefaultValue(TRUE);
        $this->addCheckbox('pohlavi_m', 'muži')->setDefaultValue(TRUE);
        $this->addCheckbox('pohlavi_z', 'ženy')->setDefaultValue(TRUE);
        $this->addSelect('typ', 'Určení', array(0 => 'bez omezení', 'E' => 'evidovaní', 'R' => 'registrovaní'))->setDefaultValue('E');
        $this->addText('rocnik_od', 'Ročník od (nejmladší)')->setEmptyValue('neomezeno')->setAttribute('class', 'vynulovat')->setHtmlId('rocnik_od');
        $this->addText('rocnik_do', 'Ročník do (nejstarší)')->setEmptyValue('neomezeno')->setAttribute('class', 'vynulovat')->setHtmlId('rocnik_do');
        $this->addRadioList('soutez_druzstev', '', array('0' => 'jednotlivci', '1' => 'družstva'))
                ->addCondition(NForm::EQUAL, 1)
                ->toggle('druzstvo')
                ->toggle('detail_druzstva')
                ->toggle('hostovani');

        //pouze pro družstva
        $this->addText('druzstvo', 'Maximální počet členů družstva')->setOption('id', 'druzstvo');
        $this->addTextArea('detail_druzstva', 'Požadavky na družstvo')->setEmptyValue('např. 2 žákyně + 1 juniorka')->setAttribute('class', 'vynulovat')->setOption('id', 'detail_druzstva')->setHtmlId('detail_druzstva');
        $this->addCheckbox('hostovani', 'Povolit hostování')->setDefaultValue(FALSE)->setOption('id', 'hostovani');

        $this->addText('omezeni_na_oddil', 'Maximální počet na oddíl')->setEmptyValue('neomezeno');
        $this->addSubmit('send', 'Uložit');
        if (isset($values['sport'])) $sporty = $values['sport'];
        if ($sporty == 'TG')
        {
            $this['soutez_druzstev']->setDefaultValue(1);
            $this['soutez_druzstev']->disabled = true;
        }
        $this->getElementPrototype()->id = 'upravitKategoriiForm';

        if (isset($values)) //jsou nastavené výchoozí hodnoty
        {
            dd($values, 'values');
            $this->setDefaults($values);
            if ($values['pohlavi'] == 'M') $this['pohlavi_z']->setDefaultValue(FALSE);
            if ($values['pohlavi'] == 'Z') $this['pohlavi_m']->setDefaultValue(FALSE);
            if ($values['druzstvo'] == 1) $this['soutez_druzstev']->setDefaultValue(0);
            elseif ($values['druzstvo'] > 1) $this['soutez_druzstev']->setDefaultValue(1);
            if ($values['elektronicke_prihlasky'] == 'N') $this['elektronicke_prihlasky']->setDefaultValue(FALSE);
            if ($values['hostovani'] == 'A') $this['hostovani']->setDefaultValue(TRUE);
            if ($values['hostovani'] == 'N') $this['hostovani']->setDefaultValue(FALSE);
        }
        else  //bez výchozích hodnot (použije se pouze pro 1. kategorii v dané akci)
        {
            $values['soutez_druzstev'] = 0;
            $values['druzstvo'] = 1;
            if ($sporty == 'TG')
            {
                $this['soutez_druzstev']->setDefaultValue(1);
                $values['druzstvo'] = 12;
            }
            if ($sporty == 'SGM')
            {
                $this['pohlavi_z']->setDefaultValue(FALSE);
                $values['druzstvo'] = 8;
            }
            if ($sporty == 'SGZ')
            {
                $this['pohlavi_m']->setDefaultValue(FALSE);
                $values['druzstvo'] = 6;
            }
            $this->setDefaults($values);
        }
//        $this->setDefaults($values);
    }

}

?>
