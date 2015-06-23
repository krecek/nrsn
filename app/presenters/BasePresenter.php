<?php

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends NPresenter
{

    public $sporty;
    public $funkce = array(
        'Z' => 'Registrovaný závodník',
        'T' => 'Trenér',
        'R' => 'Rozhodčí',
    );
    public $sdruzeni = array(
        'cus' => 'ČUS',
        'caspv' => 'ČASPV',
        'cos' => 'ČOS',
        'cos' => 'ČOS',
        'assk' => 'AŠSK',
        'atjsk' => 'ATJSK ',
        'orel' => 'OREL ',
        'jine' => 'jiné',
        '' => 'bez příslušnosti',
    );
    public $id_oddilu_individualni_clenove = 1000;

    protected function startup()
    {
        parent::startup();
    }

    protected function createTemplate($class = NULL)
    {
        $template = parent::createTemplate($class);
        $template->registerHelper('sport', callback($this, 'helperSport'));
        $template->registerHelper('funkce', callback($this, 'helperFunkce'));
        $template->registerHelper('ano', callback($this, 'hellperAno'));
        $template->registerHelper('poplatky', callback('Registrace', 'spocitatPoplatkyEvidence'));
        $template->registerHelper('registracniPoplatek', callback('Registrace', 'spocitatPoplatkyRegistrace'));
        $template->registerHelper('rodneCislo', callback($this, 'helperRodneCislo'));
        $template->registerHelper('kraj', callback($this, 'helperKraj'));
        $template->registerHelper('sdruzeni', callback($this, 'helperSdruzeni'));
        $template->registerHelper('datumClanku', callback($this, 'helperDatumClanku'));
        $template->registerHelper('pomlcka', callback($this, 'helperPomlcka'));
        $template->registerHelper('datumKonani', callback($this, 'helperDatumKonani'));
        $template->registerHelper('kategorieRocniky', callback($this, 'helperKategorieRocniky'));
        $template->registerHelper('sklonovaniOsoby', callback($this, 'helperSklonovaniOsoby'));
        $template->registerHelper('sklonovaniDruzstva', callback($this, 'helperSklonovaniDruzstva'));
        $template->registerHelper('casovaniMoci', callback($this, 'helperCasovaniMoci'));
        return $template;
    }

    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->debugMod = $this->context->parameters["debugMode"];
    }

    public function helperFunkce($zkratka)
    {
        return $this->funkce[$zkratka];
    }

    public function helperRodneCislo($rodne_cislo)
    {
        if (preg_match('~([0-9]{6})([0-9]{3,4})~', $rodne_cislo, $tmp))
        {
            return "$tmp[1]/$tmp[2]";
        }
        else
        {
            return '';
        }
    }

    public function helperKraj($id_kraje)
    {
        if ($kraj = $this->getService('krajeRepository')->findById($id_kraje))
        {
            return $kraj->nazev;
        }
        else return FALSE;
//        return $this->getService('krajeRepository')->findById($id_kraje)->nazev;
    }

    public function helperSdruzeni($id_sdruzeni)
    {
        return $this->sdruzeni[$id_sdruzeni];
    }

    public function helperDatumClanku(DateTime $datum)
    {
        $now = new NDateTime53();
        if ($datum->format('Y-m-d') == $now->format('Y-m-d')) return $datum->format('H:i'); //dnešní článek}
        if ($datum->format('Y') == $now->format('Y')) return $datum->format('j.n.'); //článek je letošní
        if ($datum->format('Y-m-d') < $now->modify('-1 years')->format(('Y-m-d'))) return $datum->format('Y'); //článek je starší než 1 rok
        return $datum->format('j.n.Y');
    }

    public function helperPomlcka($retezec)
    {
        return $retezec ? $retezec . ' - ' : '';
    }

    public function helperDatumKonani($datum1, $datum2)
    {
        if ($datum1 == $datum2) return date('j.n.Y', strtotime($datum1));
        else
        {
            $rok_od = date('Y', strtotime($datum1));
            $rok_do = date('Y', strtotime($datum2));
            if ($rok_od == $rok_do) return date('j.n.', strtotime($datum1)) . '-' . date('j.n.Y', strtotime($datum2));
            else return date('j.n.Y', strtotime($datum1)) . ' - ' . date('j.n.Y', strtotime($datum2));
        }
    }

    public function helperKategorieRocniky($rocnik_od, $rocnik_do)
    {
        if (!$rocnik_od && !$rocnik_do) return 'bez omezení';
        elseif ($rocnik_od == $rocnik_do) return $rocnik_od;
        elseif (!$rocnik_od) return "$rocnik_do a mladší";
        elseif (!$rocnik_do) return "$rocnik_od a starší";
        else return $rocnik_od . ' - ' . $rocnik_do;
    }

    public function helperSklonovaniOsoby($pocet)
    {
        if ($pocet == 1) return "osoba";
        if ($pocet > 1 && $pocet < 5) return "osoby";
        else return "osob";
    }

    public function helperSklonovaniDruzstva($pocet)
    {
        if ($pocet == 1) return "družstvo";
        if ($pocet > 1 && $pocet < 5) return "družstva";
        else return "družstev";
    }
    
    public function helperCasovaniMoci($pocet)
    {
        if($pocet>1 && $pocet <5) return 'mohou';
        else return 'může';
    }

}
