<?php
class DrobeckovaNavigaceControl extends NControl
{
    private $items=array();
    
    public function addItem($nazev, $url, $poradi, $parametry=null)
    {
        $item['nazev']=$nazev;
        $item['url']=$url;
        $item['poradi']=$poradi;
        $item['parametry'] = $parametry;
        $this->items[$poradi]=$item;
     }
    
   public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/drobeckovaNavigace.latte');
        ksort($this->items);
        $this->template->items = $this->items;
        $this->template->render();
    }
}
?>
