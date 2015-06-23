<?php

class VyhledatOddilControl extends NControl
{
    protected function createComponentVyhledatOddilForm() {
        $form = new NForm;
        $form->addText('id', 'Vyhledat oddil');
        $form->addSubmit('send', 'Vyhledat');
        $form->onSuccess[]= callback($this,'vyhledatOddilFormSubmitted');
        return $form;
    }
    
    public function VyhledatOddilFormSubmitted($form)
    {
         $this->redirect('Homepage:');
    }



    public function render() {
        $this->template->setFile(dirname(__FILE__) . '/vyhledatOddil.latte');
        $this->template->render();
    }

}

?>
