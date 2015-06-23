<?php

class TopClankyControl Extends BaseControl
{

    private $clanky;
    private $class;

    public function __construct($clanky,$class)
    {
        parent::__construct();
        $this->clanky = $clanky;
        $this->class = $class;
    }
    
       public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/topClanky.latte');
        $this->template->clanky = $this->clanky;
        $this->template->class = $this->class;
        $this->template->render();
    }
    
  

}

?>
