<?php
class VyhledavanihControl extends NControl
{
    public function __construct()
    {
        parent::__construct();
       
    }
    
    protected function createComponentVyhledatForm()
    {
        $form = new NAppForm;
        $form->addText('vyhledat');
        $form->addSubmit('send', '');
        $form->onSuccess[]=callback($this, 'vyhledatFormSubmitted');
        return $form;
    }
    
    public function vyhledatFormSubmitted(NAppForm $form)
    {
        $values = $form->getValues();
        $this->presenter->redirect('Vyhledat:default', array('text'=>$values['vyhledat']));
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/vyhledavani.latte');
         $this->template->render();
    }

}
?>
