<?php

/**
 * Homepage presenter.
 */
class Admin_HomepagePresenter extends SecuredPresenter
{
    private $menu = array();
     
    public function actionDefault()
    {
        var_dump('RRR');
        dd('I','I');
//        $this->redirect('Osoby:');
    }
    
    protected function createComponentMenu()
    {
        foreach($this->moduly as $modul)
        {
            $prava[$modul]=$this->prava->prava($modul);
        }
        dd($prava, 'práva');
        $menu = new MenuControl();
        $menu->addItem('Osoby', 'Osoby:', '', $prava['OSOBY'])
             ->addItem('Oddíly', 'Oddily:', '', $prava['ODDILY']);
        return $menu;
    }

	public function renderDefault()
	{
		
	}

}
