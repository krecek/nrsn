<?php

class SpravcePriloh extends SpravceSouboru
{

    public $hlavni_adresar_priloh = 'prilohy';
//    public $adresar_nahledu = '';
    public $prefix_nahledu = '_tn_';

    public $sirka_nahledu = 120;
    public $vyska_nahledu = 120;

    /** rozměry obrázkové přílohy */
    public $max_vyska_obrazku = 1024;
    public $max_sirka_obrazku = 1024;



    /** povolené typy příloh */
    public $povolene_typy = array(
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'avi' => 'video/avi',
        'mov' => 'video/quicktime',
        'txt' => 'text/plain', //i csv
        'doc' => 'application/msword',
        'pdf' => 'application/pdf',
        'xls' => 'application/vnd.ms-excel',
        'zip' => 'application/zip' //je to zároveň i docx a xlsx
    );

    /** seznam přípon a typů obrázků */
    public $obrazky = array(
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
    );

    /** přiřazení ikon k jednotlivým příponám */
    public $nahledy = array(
        'pdf' => 'css/ico-pdf.gif',
        'xls' => 'css/ico-xls.gif',
        'xlsx' => 'css/ico-xls.gif',
        'csv' => 'css/ico-xls.gif',
        'doc' => 'css/ico-doc.gif',
        'docx' => 'css/ico-doc.gif',
        'mov' => 'css/ico-mov.png',
        'avi' => 'css/ico-avi.gif',
         
   );
    public $neurceny_nahled = 'images/cgf-logo_small.jpg';
    public $neurceny_nahled_bez_obr = 'css/ico-txt.png';

    /**
     * Vyhledá všechny přílohy k článku a přidá k nim adresu náhledu
     * @param type $id_clanku
     * @return array, ve tvaru [adresa]=> array klíče:nazev, typ, nahled, je_obrazek, (hlavni_strana) - pouze pokud je obrázek
     */
    public function seznamPriloh($id_clanku, $vyhledat_nahledy_na_hlavni_stranku = FALSE)
    {
        return array_merge($this->seznamObrazku($id_clanku, $vyhledat_nahledy_na_hlavni_stranku), $this->seznamOstatnichPriloh($id_clanku));
    }

    public function ulozitPrilohy($prilohy, $id_clanku)
    {
        $return = array('errors' => array(), 'nahled' => '');
        $adresare = $this->najit_adresare($id_clanku, TRUE);
        $errors = array();
        $vytvoren_nahled = FALSE;
        foreach ($prilohy as $polozka)
        {
            if (!$polozka->size) continue;
            if (!in_array($polozka->getContentType(), $this->povolene_typy))
            {
                $errors[$polozka->name] = 'Nepolovený typ souboru.';
                continue;
            }
            $filename = $polozka->name;
            $filePath = $adresare['target_adresar'] . '/' . $filename;
            $polozka->move($filePath);
            if ($polozka->isImage())
            {
                if (preg_match('~' . $this->prefix_nahledu . '.*~', $filename)) //jedná se o náhled
                {
                    $this->vytvorit_nahled($filePath, $adresare['nahledy_adresar'] . '/' . $filename); //vytvoří náhled v adresáři 
                }
                else
                {
                    $this->vytvorit_nahled($filePath, null, $this->max_sirka_obrazku, $this->max_vyska_obrazku); //upraví rozměry obrázku
                    $this->vytvorit_nahled($filePath, $adresare['nahledy_adresar'] . '/' . $this->prefix_nahledu . $filename); //vytvoří náhled v adresáři}
                }
                if (!$vytvoren_nahled) $return['nahled'] = $filename;
                $vytvoren_nahled = TRUE;
            }
        }
        $return['errors'] = $errors;
        return $return;
    }

    public function smazatPrilohu($id_clanku, $priloha)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $target_adresar = $adresare['target_adresar'];
        $nahledy_adresar = $adresare['nahledy_adresar'];
//        $tt_adresar = $adresare['tt_adresar'];
//        if (file_exists($tt_adresar . '/' . $priloha)) unlink($tt_adresar . '/' . $priloha);
        if (file_exists($nahledy_adresar . '/' . $this->prefix_nahledu . $priloha)) unlink($nahledy_adresar . '/' . $this->prefix_nahledu . $priloha);
        if (file_exists($target_adresar . '/' . $priloha)) unlink($target_adresar . '/' . $priloha);
//        if ($this->je_adresar_prazdny($tt_adresar)) $this->smazatAdresar($tt_adresar);
        if ($this->je_adresar_prazdny($nahledy_adresar)) rmdir($nahledy_adresar);
        if ($this->je_adresar_prazdny($target_adresar)) $this->smazatAdresar($target_adresar);
        if ($this->je_adresar_prazdny($adresare['prvni_adresar'])) $this->smazatAdresar($adresare['prvni_adresar']);
    }

    /**
     * Smaže všechny přílohy článku
     * @param type $id_clanku
     */
    public function smazatPrilohy($id_clanku)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $this->smazatAdresar($adresare['tt_adresar']);
//        $this->smazatAdresar($adresare['nahledy_adresar']);
        $this->smazatAdresar($adresare['target_adresar']);
        if ($this->je_adresar_prazdny($adresare['prvni_adresar'])) $this->smazatAdresar($adresare['prvni_adresar']);
    }

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
            }
        }
        return $prilohy;
    }

    /**
     * Vyhledá všechny neobrázkové přílohy k článku a přidá k nim adresu náhledu (ikona nastavená v Prilohy::nahledy)
     * @param type $id_clanku
     * @return array, ve tvaru [adresa]=> array klíče:nazev, typ, nahled, je_obrazek
     */
    public function seznamOstatnichPriloh($id_clanku)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $prilohy = array();
        $prilohy_tmp = array();
        foreach ($this->obrazky as $pripona => $typ)
        {
            $masky[] = "*.$pripona";
        }

        if (is_dir($adresare['target_adresar']))
        {
            $nazvy = array();
            foreach (NFinder::findFiles('*.*')->exclude($masky)->in($adresare['target_adresar']) as $key => $file)
            {

                $cesta = $file->getPath();
                $nazev = rawurlencode($file->getBasename());
                $key = $cesta . '/' . $nazev;
                $nazvy[$file->getFileName()] = $key; //použije se pro řazení podle názvu
                $prilohy_tmp[$key]['nazev'] = $file->getFileName();
                $path = pathinfo($file->getFileName());
                $pripona = strtolower($path['extension']);
                $pripona = NStrings::lower($pripona);
                $prilohy_tmp[$key]['typ'] = $pripona;
                $prilohy_tmp[$key]['je_obrazek'] = FALSE;
                if (array_key_exists($pripona, $this->nahledy))
                {
                    $nahled = $this->nahledy[$pripona];
                    if (!$this->overitNahled($nahled)) $nahled = $this->neurceny_nahled_bez_obr;
                }
                else
                {
                    $nahled = $this->neurceny_nahled_bez_obr;
                }
                $prilohy_tmp[$key]['nahled'] = $nahled;
            }
            ksort($nazvy);
            dd($nazvy, 'nazvy');
            foreach ($nazvy as $nazev => $cesta)
            {
                $prilohy[$cesta] = $prilohy_tmp[$cesta];
            }
        }
        return $prilohy;
    }

    /**
     * Ověří, zda existuje obrázek uložený v databázi. Pokud ano, doplní celou adresu náhledu, pokud ne doplní výchozí obrázek
     * @param int $id_clanku
     * @param str $obr - název obrázku (z databáze, sloupec obr)
     */
    public function obrClanku($id_clanku, $obr)
    {
        if (!$obr) return $this->neurceny_nahled;
        $adresare = $this->najit_adresare($id_clanku);
        dd($adresare, '$adresare');
        if (!$this->overitNahled($adresare['nahledy_adresar'] . '/' . $this->prefix_nahledu . $obr)) return $this->neurceny_nahled;
        return $adresare['nahledy_adresar'] . '/' . $this->prefix_nahledu . $obr;
    }

    //====================================================================================

//    /**
//     * Určit a případně vytvořit adresáře pro ukládání příloh a náhledů
//     * @param int $id_clanku
//     * @param bool vytvořit adresáře, pokud neexistují?
//     * @return array klíče:target_adresar, nahledy_adresar
//     */
//    public function najit_adresare($id_clanku, $vytvorit_adresare = FALSE)
//    {
//        $cele_id = sprintf('%06d', $id_clanku);
//        $hlavni_adresar = $this->hlavni_adresar_priloh;
//        $prvni_adresar = substr($cele_id, 0, 3);
//        $druhy_adresar = substr($cele_id, 3, 3);
//        $targetDir = $hlavni_adresar . '/' . $prvni_adresar . '/' . $druhy_adresar;
////        $nahledy_adresar = $targetDir . '/' . $this->adresar_nahledu;
//        if ($vytvorit_adresare)
//        {
//            if (!file_exists($hlavni_adresar)) @mkdir($hlavni_adresar);
//            if (!file_exists($hlavni_adresar . '/' . $prvni_adresar)) @mkdir($hlavni_adresar . '/' . $prvni_adresar);
//            if (!file_exists($targetDir)) @mkdir($targetDir);
////            if (!file_exists($nahledy_adresar)) @mkdir($nahledy_adresar);
//        }
//        return array(
//            'target_adresar' => $targetDir,
//            'nahledy_adresar' => $targetDir,
//            'prvni_adresar' => $hlavni_adresar . '/' . $prvni_adresar,
//        );
//    }

    public function vytvorit_nahled($filePath, $novy_nazev = NULL, $x = null, $y = null, $oriznout = TRUE)
    {
        $x = $x ? $x : $this->sirka_nahledu;
        $y = $y ? $y : $this->vyska_nahledu;
        $image = NImage::fromFile($filePath);
        if ($oriznout) $parametry = array(NImage::EXACT, NImage::SHRINK_ONLY);
        else $parametry = array(NImage::SHRINK_ONLY);
        $image->resize($x, $y, join(' | ', $parametry));
        if (!$novy_nazev) $novy_nazev = $filePath;
        $image->save($novy_nazev);
    }
//
//    /**
//     * Existuje soubor s náhledem?
//     * @param type $soubor_nahledu
//     * @return boolean
//     */
//    public function overitNahled($soubor_nahledu)
//    {
//        if (!file_exists($soubor_nahledu)) return FALSE;
//        return TRUE;
//    }

    //==========================================================================================
//    protected function je_adresar_prazdny($adresar)
//    {
//        if (is_dir($adresar))
//        {
//            return (($files = scandir($adresar)) && count($files) <= 2) ? TRUE : FALSE;
//        }
//        else
//        {
//            return TRUE;
//        }
//    }
//
//    protected function smazatAdresar($adresar)
//    {
//        if (file_exists($adresar))
//        {
//            foreach (NFinder::findFiles('*.*')->in($adresar) as $soubor)
//            {
//                unlink($adresar . '/' . $soubor->getFileName());
//            }
//            rmdir($adresar);
//        }
//    }

}
