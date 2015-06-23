<?php

class UpravitRubrikuForm extends NAppForm
{
    public function __construct($rubriky,$povolene_rubriky=null, $values=null)
    {
        
        $povolit_zmenu_url=TRUE;
        if(isset($values->zamek) && $values['zamek']=='A') $povolit_zmenu_url=FALSE;
        dd($povolit_zmenu_url, 'změna');
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
        
        $this->addSelect('rodic', 'Nadřazená rubrika', $polozky)->setPrompt('--- Zvolte rubriku ----')->setRequired('Zvolte nadřazenou rubriku.');
        $this->addText('nazev', 'Název',30)->setRequired('Zadejte název rubriky.');
        $this->addText('url', 'Url', 30)->addCondition(NForm::FILLED)->addRule(NForm::PATTERN, 'Url obsahuje nepovolené znaky.', '[0-9a-z][0-9a-z\-]*');
        if(!$povolit_zmenu_url) $this['url']->setDisabled()->setAttribute('title', 'Adresa je chráněna proti přepsání');
//        $this->addText('url', 'Url', 30)->addRule(NForm::PATTERN, 'Url obsahuje nepovolené znaky.', '[0-9]*');
        $this->addSubmit('send', 'Uložit');
       
        if($values)
        {
            $this->setDefaults($values);
        }
 
    }
    
}

?>
