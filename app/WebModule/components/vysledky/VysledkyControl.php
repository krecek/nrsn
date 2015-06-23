<?php

class VysledkyControl extends BaseControl
{

    public $vysledky;
    private $sport;
    private $typ;
    private $vypisovane_naradi = array();

    public function __construct($vysledky, $sport, $typ, $vypisovane_naradi = null)
    {
        parent::__construct();
        dd($vysledky, 'vysledky');
        $this->vysledky = $vysledky;
        $this->sport = $sport;
        $this->typ = $typ;
        dd($vypisovane_naradi, 'naradi');
        if ($vypisovane_naradi) $this->vypisovane_naradi = $vypisovane_naradi;
    }

//    public function setTerminovaListina($prilohy)
//    {
//        $this->terminova_listina = $prilohy;
//    }

    public function render()
    {
        if ($this->sport == 'SGZ' || $this->sport == 'SGM') $this->sport = 'SG';
        $sablona = 'vysledky_' . $this->sport . '_' . $this->typ . '.latte'; //napr. vysledky_SGM_druzstva
        if (!file_exists(dirname(__FILE__) . '/' . $sablona)) $this->template->setFile(dirname(__FILE__) . '/vysledky_nenalezeno.latte');
        else $this->template->setFile(dirname(__FILE__) . '/' . $sablona);
        $this->template->registerHelper('xml', callback($this, 'helperXml'));
        $this->template->vysledky = $this->vysledky;
        $this->template->naradi = $this->vypisovane_naradi;
        $this->template->render();
    }

    public function helperXml($str)
    {
        if(is_array($str)) $str='';
        return $str;
    }
//    public function createTemplate($class = NULL)
//    {
//        $template = parent::createTemplate($class);
//        $template->registerHelper('datumKonani', callback($this, 'helperDatumKonani'));
//        return $template;
//    }
//
//    public function helperDatumKonani($datum1, $datum2)
//    {
//        if ($datum1 == $datum2) return date('j.n.Y', strtotime($datum1));
//        else return date('j.n.Y', strtotime($datum1)) . ' - ' . date('j.n.Y', strtotime($datum2));
//    }
}

?>
