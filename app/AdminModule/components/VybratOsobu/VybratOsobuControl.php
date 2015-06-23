<?php

/**
 * Description of VybratOsobuControl
 *
 * @author jana
 */
class VybratOsobuControl extends NControl
{

      private $osoby;
      private $action;

    public function __construct($osoby, $action)
    {
        parent::__construct();
        $this->osoby = $osoby;
        $this->action = $action;
        $this->action = '';
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/vybratOsobu.latte');
        $this->template->osoby = $this->osoby;
        $this->template->action = $this->action;
        $this->template->render();
        
       
    }

}