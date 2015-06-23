<?php

class PrilohyKAkciControl extends NControl
{

    public $prilohy = array();
    public $typy;
    public static $typy_sort;
    public $typ_zobrazeni;

    public function __construct($typy, $seznam_priloh, $seznam_priloh_z_db, $typ_zobrazeni = 'admin')
    {
        parent::__construct();
        $this->typy = $typy;
        $this->typ_zobrazeni = $typ_zobrazeni;
        $i = 0;
        foreach ($typy as $key => $value)
        {
            self::$typy_sort[$key] = $i;
            $i++;
        }
        foreach ($seznam_priloh as $adresa => $priloha)
        {
            if (isset($seznam_priloh_z_db[$priloha['nazev']])) $this->prilohy[$seznam_priloh_z_db[$priloha['nazev']]->typ][$adresa] = $priloha;
            else $this->prilohy['ostatni'][$adresa] = $priloha;
        }
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/'.$this->getNazevSablony($this->typ_zobrazeni).'.latte');
        uksort($this->prilohy, 'PrilohyKAkciControl::sortByTyp');
        $prilohy = $this->prilohy;
        if (isset($prilohy['fotografie'])) unset($prilohy['fotografie']);
        $this->template->zobrazit_galerii = isset($this->prilohy['fotografie']);
        $this->template->seznam_priloh = $prilohy;
        $this->template->typy_priloh = $this->typy;
        $this->template->render();
    }

    private function getNazevSablony($typ)
    {
        if ($typ == 'admin') return 'prilohyKAkci';
        elseif ($typ == 'web') return 'prilohyKAkciWeb';
        else return 'prilohyKAkci';
    }

    public static function sortByTyp($a, $b)
    {
        if (self::$typy_sort[$a] == self::$typy_sort[$b]) return 0;
        return (self::$typy_sort[$a] < self::$typy_sort[$b]) ? -1 : 1;
    }

    protected function createComponentGalerie()
    {
        return new GalerieControl($this->prilohy['fotografie']);
    }

}

?>
