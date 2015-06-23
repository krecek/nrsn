<?php

class NastavitDatumCasForm extends NAppForm
{
    public $prefix;

    public function __construct($values, $prefix='')
    {
        parent::__construct();
        $this->prefix = $prefix;
        $this->addText($prefix.'datum', 'Datum')->setAttribute('class', 'datepicker');
        $this->addText($prefix.'cas', 'Čas')->addRule(NForm::PATTERN, 'Zadejte ve tvaru 04:56', '(([0-1][0-9])|(2[0-3])|([0-9])):([0-5][0-9])');
        $this->addSubmit('send', 'Uložit');
        $this->onValidate[] = callback($this, 'kontrolaDatumu');
        if ($values) 
        {
            foreach($values as $key=>$value)
            {
                if(isset($this[$prefix.$key])) $this[$prefix.$key]->setDefaultValue($value);
            }
        }
    }

    public function kontrolaDatumu(NastavitDatumCasForm $form)
    {
       $values =$form->getValues();
       $datum = $values[$this->prefix.'datum'];
        if (preg_match('~([0-9]{1,2}).([0-9]{1,2}).([0-9]{4})~', $datum, $matches))
        {
            $rok = $matches[3];
            $den = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
            $mesic = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
        }
        elseif (preg_match('~(.*)-(.*)-(.*)~', $datum, $matches))
        {
            $rok = $matches[1];
            $mesic = $matches[2];
            $den = $matches[3];
        }
        else
        {
            $form->addError('Chybný tvar datumu. Zadávejte datum ve tvaru 1.1.2000');
            return FALSE;
        }
        if (!checkdate($mesic, $den, $rok))
        {
            $form->addError('Neplatné datum');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}

?>
