<?php


class PodmenuControl extends NControl
{
    private $items=array();
    
    public function addItem($nazev, $url)
    {
        $item['nazev']=$nazev;
        $item['url']=$url;
        $this->items[]=$item;
    }
    
   public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/podmenu.latte');
        $this->template->items = $this->items;
        $this->template->render();
    }
}

?>
