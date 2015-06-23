<?php

class Clanek extends NObject
{

    private $id;
    private $rubrika;
    private $nadpis;
    private $perex;
    private $obsah;
    private $vytvoreno;
    private $autor;
    private $zobrazit_od;
    private $zobrazit_do;
    private $upraveno;
    private $upravil;
    private $obr;
    private $hlavni_strana;
    private $top;
    /** Zobrazit galerii? */
    private $galerie;
    /** Zobrazit seznam příloh (kromě obrázků)? */
    private $prilohy;
    /** Zobrazit hlavní obrázek článku pod perex */
    private $zobrazit_obr;

    public function __construct($id = null)
    {
        if ($id)
        {
            $this->id = $id;
        }
    }

    public function setUdaje($udaje)
    {
        if (isset($udaje['rubrika'])) $this->setRubrika($udaje['rubrika']);
        if (isset($udaje['nadpis'])) $this->setNadpis($udaje['nadpis']);
        if (isset($udaje['perex'])) $this->setPerex($udaje['perex']);
        if (isset($udaje['obsah'])) $this->setObsah($udaje['obsah']);
        if (!isset($this->id))
        {
            $this->setVytvoreno();
            $this->setZobrazit_od();
            $this->setZobrazit_do();
        }
        if (isset($this->id)) $this->setUpraveno();
        if (isset($udaje['upravil'])) $this->setUpravil($udaje['upravil']);
        if (isset($udaje['autor'])) $this->setAutor($udaje['autor']);
        if (isset($udaje['zobrazit_od_datum']) || isset($udaje['zobrazit_od_cas'])) $this->setZobrazit_od($udaje['zobrazit_od_datum'], $udaje['zobrazit_od_cas']);
        if (isset($udaje['zobrazit_do_datum']) || isset($udaje['zobrazit_do_cas'])) $this->setZobrazit_do($udaje['zobrazit_do_datum'], $udaje['zobrazit_do_cas']);
//        if(isset($udaje['nahled'])) $this->setNahled($udaje['nahled']);
        if (isset($udaje['hlavni_strana'])) $this->setHlavni_strana($udaje['hlavni_strana']);
        if (isset($udaje['top'])) $this->setTop($udaje['top']);
        if (isset($udaje['obr'])) $this->setObr($udaje['obr']);
        if (isset($udaje['galerie'])) $this->setGalerie($udaje['galerie']);
        if (isset($udaje['prilohy'])) $this->setPrilohy($udaje['prilohy']);
        if (isset($udaje['zobrazit_obr'])) $this->setZobrazitObr($udaje['zobrazit_obr']);
    }

    public function getUdaje()
    {
        $return = array();
        if (isset($this->rubrika)) $return['rubrika'] = $this->rubrika;
        if (isset($this->nadpis)) $return['nadpis'] = $this->nadpis;
        if (isset($this->perex)) $return['perex'] = $this->perex;
        if (isset($this->obsah)) $return['obsah'] = $this->obsah;
        if (isset($this->vytvoreno)) $return['vytvoreno'] = $this->vytvoreno;
        if (isset($this->autor)) $return['autor'] = $this->autor;
        if (isset($this->zobrazit_od)) $return['zobrazit_od'] = $this->zobrazit_od;
        if (isset($this->zobrazit_do)) $return['zobrazit_do'] = $this->zobrazit_do;
        if (isset($this->upravil)) $return['upravil'] = $this->upravil;
        if (isset($this->upraveno)) $return['upraveno'] = $this->upraveno;
        if (isset($this->obr)) $return['obr'] = $this->obr;
        if (isset($this->hlavni_strana)) $return['hlavni_strana'] = $this->hlavni_strana;
        if (isset($this->top)) $return['top'] = $this->top;
        if (isset($this->error)) $return['error'] = $this->error;
        if (isset($this->galerie)) $return['galerie'] = $this->galerie;
        if (isset($this->prilohy)) $return['prilohy'] = $this->prilohy;
        if (isset($this->zobrazit_obr)) $return['zobrazit_obr'] = $this->zobrazit_obr;
        return $return;
    }

    public function setRubrika($rubrika)
    {
        $this->rubrika = $rubrika;
    }

    public function setNadpis($nadpis)
    {
        $this->nadpis = $nadpis;
    }

    public function setPerex($perex)
    {
        $this->perex = $perex;
    }

    public function setObsah($obsah)
    {
        $this->obsah = $obsah;
        if (!($this->perex))
        {
            $perex = str_replace("\n", ' ', (str_replace('&nbsp;', ' ', strip_tags($obsah))));
            $this->setPerex(NStrings::truncate(html_entity_decode(preg_replace('~&(lt|gt|amp);~', '&amp;\\1;', $perex), ENT_NOQUOTES, "utf-8"), 250, ''));
        }
    }

    public function setVytvoreno()
    {
        $this->vytvoreno = date('Y-m-d H:i:s');
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setUpraveno()
    {
        $this->upraveno = date('Y-m-d H:i:s');
    }

    public function setUpravil($autor)
    {
        $this->upravil = $autor;
    }

    public function setZobrazit_od($datum = null, $cas = null)
    {
        if (!$datum = PrevodnikDatumu::prevestDatumNaAnglicke($datum)) $datum = date('Y-m-d', strtotime('+1 days'));
        if (!PrevodnikDatumu::zkontrolovatCas($cas)) $cas = date('00:01');
        $this->zobrazit_od = "$datum $cas";
    }

    public function setZobrazit_do($datum = null, $cas = null)
    {
        if (!$datum = PrevodnikDatumu::prevestDatumNaAnglicke($datum)) $datum = date('Y-m-d', strtotime($this->zobrazit_od." +1 years"));
        if (!PrevodnikDatumu::zkontrolovatCas($cas)) $cas = '00:00';
        $this->zobrazit_do = "$datum $cas";
    }

    public function setObr($obr)
    {
        $this->obr = $obr;
    }

    public function setHlavni_strana($hlavni_strana)
    {
        if ($hlavni_strana === TRUE || $hlavni_strana == 'A')
        {
            $this->hlavni_strana = 'A';
        }
        elseif ($hlavni_strana === FALSE || $hlavni_strana == 'N')
        {
            $this->hlavni_strana = 'N';
        }
    }

    public function setTop($top)
    {
        if ($top === TRUE || $top == 'A')
        {
            $this->top = 'A';
        }
        elseif ($top === FALSE || $top == 'N')
        {
            $this->top = 'N';
        }
    }
    
    public function setGalerie($galerie)
    {
        if ($galerie === TRUE || $galerie == 'A')
        {
            $this->galerie = 'A';
        }
        elseif ($galerie === FALSE || $galerie == 'N')
        {
            $this->galerie = 'N';
        }
    }
    
    public function setPrilohy($prilohy)
    {
        if ($prilohy === TRUE || $prilohy == 'A')
        {
            $this->prilohy = 'A';
        }
        elseif ($prilohy === FALSE || $prilohy == 'N')
        {
            $this->prilohy = 'N';
        }
    }
    public function setZobrazitObr($zobrazit_obr)
    {
        if ($zobrazit_obr === TRUE || $zobrazit_obr == 'A')
        {
            $this->zobrazit_obr = 'A';
        }
        elseif ($zobrazit_obr === FALSE || $zobrazit_obr == 'N')
        {
            $this->zobrazit_obr = 'N';
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getRubrika()
    {
        return $this->rubrika;
    }

    public function getNadpis()
    {
        return $this->nadpis;
    }

    public function getPerex()
    {
        return $this->perex;
    }

    public function getObsah()
    {
        return $this->obsah;
    }

    public function getVytvoreno()
    {
        return $this->vytvoreno;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getZobrazit_od()
    {
        return $this->zobrazit_od;
    }

    public function getZobrazit_do()
    {
        return $this->zobrazit_do;
    }

    public function getObr()
    {
        return $this->$obr;
    }

    public function getHlavni_strana()
    {
        return $this->hlavni_strana;
    }

    public function getTop()
    {
        return $this->top;
    }

    private function prevestDatum($datum)
    {
        if (preg_match('~([0-9]{1,2}).([0-9]{1,2}).([0-9]{4})~', $datum, $matches))
        {
            $rok = $matches[3];
            $den = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
            $mesic = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
        }
        elseif (preg_match('~(.*)-(.*)-(.*)~', $datum, $matches))
        {
            $rok = $matches[1];
            $mesic = $matches[2];
            $den = $matches[3];
        }
        else
        {
            return FALSE;
        }

        if (!checkdate($mesic, $den, $rok))
        {
            return FALSE;
        }
        else
        {
            return $rok . '-' . $mesic . '-' . $den;
        }
    }

}

?>
