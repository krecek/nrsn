<?php

class Prilohy extends SpravcePriloh
{

    public $hlavni_adresar_priloh = 'prilohy';
    public $adresar_nahledu_hlavni_strana = 'tt';
    
    /** výška náhledu na hlavní stránku */
    public $tt_vyska = 270;

    /** šířka náhledu na hlavní stránku */
    public $tt_sirka = 365;

    public $neurceny_tt_nahled = 'images/cgf-logo.jpg';

    /**
     * Vyhledá všechny obrázkové přílohy k článku a přidá k nim adresu náhledu
     * @param type $id_clanku
     * @param bool $vyhledat_nahledy_na_hlavni_stranku
     * @return array, ve tvaru [adresa]=> array klíče:nazev, typ, nahled, je_obrazek, (hlavni_strana)
     */
    public function seznamObrazku($id_clanku, $vyhledat_nahledy_na_hlavni_stranku = FALSE)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $prilohy = array();
        foreach ($this->obrazky as $pripona => $typ)
        {
            $masky[] = "*.$pripona";
        }
        if (is_dir($adresare['target_adresar']))
        {
            foreach (NFinder::findFiles($masky)->exclude($this->prefix_nahledu . '*')->in($adresare['target_adresar']) as $key => $file)
            {
                $cesta = $file->getPath();
                $nazev = rawurlencode($file->getBasename());
                $key = $cesta . '/' . $nazev;
                $prilohy[$key]['nazev'] = $file->getFileName();

                list($nazev, $pripona) = explode('.', $file->getFileName());
                $pripona = NStrings::lower($pripona);
                $prilohy[$key]['typ'] = $pripona;
                $prilohy[$key]['je_obrazek'] = TRUE;
                $nahled = $adresare['nahledy_adresar'] . '/' . $this->prefix_nahledu . $file->getFileName();
                if (!$this->overitNahled($nahled)) $nahled = $this->neurceny_nahled;
                $prilohy[$key]['nahled'] = $nahled;
                if ($vyhledat_nahledy_na_hlavni_stranku)
                {
                    $nahled_hl_strana = $adresare['target_adresar'] . '/' . $this->adresar_nahledu_hlavni_strana . '/' . $file->getFileName();
                    if ($this->overitNahled($nahled_hl_strana)) $prilohy[$key]['hlavni_strana'] = TRUE;
                    else $prilohy[$key]['hlavni_strana'] = FALSE;
                }
            }
        }
        return $prilohy;
    }

    /**
     * Vrátí název nového hlavního obrázku
     * @param type $id_clanku
     * @return string
     */
    public function automatickyVybratObrClanku($id_clanku)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $target_adresar = $adresare['target_adresar'];
        $nahledy_adresar = $adresare['nahledy_adresar'];
        $obrazky = $this->seznamObrazku($id_clanku);
        foreach ($obrazky as $filePath => $obrazek)
        {
            if ($obrazek['nahled'] == $this->neurceny_nahled) $this->vytvorit_nahled($filePath, $nahledy_adresar . '/' . $this->prefix_nahledu . $obrazek['nazev']);
            if ($this->overitNahled($nahledy_adresar . '/' . $this->prefix_nahledu . $obrazek['nazev']))
            {
                return $obrazek['nazev'];
            }
        }
        return '';
    }

//============================== OBRÁZKY NA HLAVNÍ STRÁNKU (TOP ČLÁNKY) ====================================
    /**
     * Seznam obrázků určených k zobrazení na hlavní stránce
     * @param type $id_clanku
     * @return FALSE/array
     */
    public function obrTopClanek($id_clanku)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $tt_adresar = $adresare['tt_adresar'];
        if ($this->je_adresar_prazdny($tt_adresar)) return array($this->neurceny_tt_nahled => 'neurčeno');
        foreach ($this->obrazky as $pripona => $typ)
        {
            $masky[] = "*.$pripona";
        }
        foreach (NFinder::findFiles($masky)->in($tt_adresar) as $key => $file)
        {
            $nahledy[$key] = $file;
        }

        return $nahledy;
    }

    public function nastavitObrTopClanek($id_clanku, $priloha)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $tt_adresar = $adresare['tt_adresar'];
        if (!file_exists($tt_adresar)) @mkdir($tt_adresar);
//        $this->vytvorit_nahled($adresare['target_adresar'] . '/' . $priloha, $tt_adresar . '/' . $priloha, $this->tt_sirka, $this->tt_vyska, FALSE);
        $this->vytvorit_nahled($adresare['target_adresar'] . '/' . $priloha, $tt_adresar . '/' . $priloha, $this->tt_sirka, $this->tt_vyska, TRUE);
    }

    public function zrusitObrTopClanek($id_clanku, $priloha)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $tt_adresar = $adresare['tt_adresar'];
        if (file_exists($tt_adresar . '/' . $priloha)) unlink($tt_adresar . '/' . $priloha);
        if ($this->je_adresar_prazdny($tt_adresar)) rmdir($tt_adresar);
    }

    /**
     * Je nastaven nějaký obrázek k top článku?
     * @param int $id_clanku
     * @return boolean
     */
    public function jeObrTopClanek($id_clanku)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $tt_adresar = $adresare['tt_adresar'];
        if ($this->je_adresar_prazdny($tt_adresar)) return FALSE;
        return TRUE;
    }


    //====================================================================================

    /**
     * Určit a případně vytvořit adresáře pro ukládání příloh a náhledů
     * @param int $id_clanku
     * @param bool vytvořit adresáře, pokud neexistují?
     * @return array klíče:target_adresar, nahledy_adresar
     */
    public function najit_adresare($id_clanku, $vytvorit_adresare = FALSE)
    {
        $return = parent::najit_adresare($id_clanku, $vytvorit_adresare);
        $return['tt_adresar']= $return['target_adresar']. '/' . $this->adresar_nahledu_hlavni_strana;
        return $return;
    }
    
    public function smazatPrilohu($id_clanku, $priloha)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $tt_adresar = $adresare['tt_adresar'];
        if (file_exists($tt_adresar . '/' . $priloha)) unlink($tt_adresar . '/' . $priloha);
        if ($this->je_adresar_prazdny($tt_adresar)) $this->smazatAdresar($tt_adresar);
        parent::smazatPrilohu($id_clanku, $priloha);
    }

 }

?>
