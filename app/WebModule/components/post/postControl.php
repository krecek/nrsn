<?php

class PostControl extends NControl
{
    private $clanek;
    public function __construct($clanek)
    {
        parent::__construct();
        $this->clanek = $clanek;
    }
    
     public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/post.latte');
        $this->template->clanek = $this->clanek;
        $this->template->render();
    }
}

?>
