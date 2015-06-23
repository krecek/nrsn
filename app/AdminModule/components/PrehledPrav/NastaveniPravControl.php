<?php

class NastaveniPravControl extends NControl
{

    private $osoba;
    private $admin;
    private $id;
   

    public function __construct($osoba, $admin=null)
    {
        parent::__construct();
        $this->osoba = $osoba;
        $this->admin = $admin;
     }

     public function setId($id)
     {
         $this->id = $id;
     }
    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/nastaveniPrav.latte');
        $this->template->osoba = $this->osoba;
        $this->template->render();
        
    }

    protected function createComponentNastaveniPravForm()
    {
        
        $prava = $this->presenter->prava->prava($this->presenter->modul, $this->presenter->id, $this->presenter->getUser()->id);
        if($this->admin>$prava) $prava = $this->admin;
          for ($i = $prava - 1; $i >= 0; $i--)
        {
            $items[$i] = $i;
        }
        $default_values = $this->presenter->prava->prava($this->presenter->modul, $this->presenter->id, $this->osoba['id']);
        $form = new NastaveniPravForm($items, $default_values);
        $form->onSuccess[] = callback($this, 'nastaveniPravFormSubmitted');
        return $form;
    }

    public function nastaveniPravFormSubmitted(NastaveniPravForm $form)
    {

        $values = $form->getValues();
        //zkrontrolovat, zda osoba smí přiřadit právo
        $pravo_uzivatele = $this->presenter->prava->prava($this->presenter->modul, $this->presenter->id, $this->presenter->getUser()->id);
        if ($pravo_uzivatele <= $values->prava && !$this->admin)
        {
            $form->addError('Můžete nastavit pouze nižší právo, než máte Vy');
        }
        else
        {
            $this->presenter->prava->setPrava($this->osoba['id'], $this->presenter->modul, $this->presenter->id, $values->prava);
            $this->presenter->logg('osobe '.$this->osoba['id']. ' prideleny prava - modul: '.$this->presenter->modul.", subint: ".$this->presenter->id.", hodnota: ".$values->prava);
            if(isset($this->id)) $this->presenter->redirect('prava', $this->id);
            $this->presenter->redirect("prava");
        }
    }

}

?>
