<?php

class UpravitClanekForm extends NAppForm
{

    public function __construct($rubriky, $povolene_rubriky = null, $values = null)
    {
        dd($povolene_rubriky, 'povolene_rubriky');
        parent::__construct();

        if (!$povolene_rubriky) $polozky = $rubriky;
        else
        {
            
            foreach ($rubriky as $key => $rubrika)
            {
                $zakazano = in_array($key, $povolene_rubriky)?FALSE:TRUE;
                $polozky[$key] = NHtml::el('option')->value($key)->setHtml($rubrika)->disabled($zakazano);
            }
        }
        $this->addSelect('rubrika', 'Rubrika', $polozky)->setPrompt('--- Zvolte rubriku ---')->setRequired('Zvolte rubriku.');
        $this->addText('nadpis', 'Nadpis:',95)->setDefaultValue('nadpis')->setRequired('Zadejte název článku')->addRule(NForm::MAX_LENGTH, 'Maximálně %d znaků', 250)->addRule(~NForm::EQUAL, 'Zadejte název článku', 'nadpis')->setHtmlId('clanek_form_nadpis');
        $this->addTextArea('perex', 'Perex:',85, 5)->setDefaultValue('perex')->addRule(NForm::MAX_LENGTH, 'Maximálně %d znaků', 250)->setHtmlId('clanek_form_perex');
        $this->addTextArea('obsah', 'Obsah', 85, 25)->setAttribute('class', 'mceEditor');
        $this->addSubmit('send', 'Uložit');

        if (isset($values))
        {
            $this->setDefaults($values);
        }
    }

}

?>
