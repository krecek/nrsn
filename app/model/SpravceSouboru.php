<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class SpravceSouboru
{
     public $hlavni_adresar_priloh = 'prilohy';
    
    /** povolené typy příloh */
    public $povolene_typy = array();
    /**
     * Vyhledá všechny přílohy k článku 
     * @param type $id_clanku
     * @return array, ve tvaru [adresa]=> array klíče:nazev, typ
     */
    public function seznamPriloh($id_clanku)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $prilohy = array();
        $prilohy_tmp = array();
        if (is_dir($adresare['target_adresar']))
        {
            $nazvy = array();
            foreach (NFinder::findFiles('*.*')->in($adresare['target_adresar']) as $key => $file)
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
            }
            ksort($nazvy);
            foreach ($nazvy as $nazev => $cesta)
            {
                $prilohy[$cesta] = $prilohy_tmp[$cesta];
            }
        }
        return $prilohy;
    }
    
    protected function je_adresar_prazdny($adresar)
    {
        if (is_dir($adresar))
        {
            return (($files = scandir($adresar)) && count($files) <= 2) ? TRUE : FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    protected function smazatAdresar($adresar)
    {
        if (file_exists($adresar))
        {
            foreach (NFinder::findFiles('*.*')->in($adresar) as $soubor)
            {
                unlink($adresar . '/' . $soubor->getFileName());
            }
            rmdir($adresar);
        }
    }

    /**
     * Určit a případně vytvořit adresáře pro ukládání příloh a náhledů
     * @param int $id_clanku
     * @param bool vytvořit adresáře, pokud neexistují?
     * @return array klíče:target_adresar, nahledy_adresar
     */
    public function najit_adresare($id_clanku, $vytvorit_adresare = FALSE)
    {
        $cele_id = sprintf('%06d', $id_clanku);
        $hlavni_adresar = $this->hlavni_adresar_priloh;
        $prvni_adresar = substr($cele_id, 0, 3);
        $druhy_adresar = substr($cele_id, 3, 3);
        $targetDir = $hlavni_adresar . '/' . $prvni_adresar . '/' . $druhy_adresar;
//        $nahledy_adresar = $targetDir . '/' . $this->adresar_nahledu;
        if ($vytvorit_adresare)
        {
            if (!file_exists($hlavni_adresar)) @mkdir($hlavni_adresar);
            if (!file_exists($hlavni_adresar . '/' . $prvni_adresar)) @mkdir($hlavni_adresar . '/' . $prvni_adresar);
            if (!file_exists($targetDir)) @mkdir($targetDir);
//            if (!file_exists($nahledy_adresar)) @mkdir($nahledy_adresar);
        }
        return array(
            'target_adresar' => $targetDir,
            'nahledy_adresar' => $targetDir,
            'prvni_adresar' => $hlavni_adresar . '/' . $prvni_adresar,
        );
    }
    
    public function smazatPrilohu($id_clanku, $priloha)
    {
        $adresare = $this->najit_adresare($id_clanku);
        $target_adresar = $adresare['target_adresar'];
        if (file_exists($target_adresar . '/' . $priloha)) unlink($target_adresar . '/' . $priloha);
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
     * Existuje soubor s náhledem?
     * @param type $soubor_nahledu
     * @return boolean
     */
    public function overitNahled($soubor_nahledu)
    {
        dd($soubor_nahledu, 'soubro nahledu');
        if (!file_exists($soubor_nahledu)) return FALSE;
        return TRUE;
    }
    
//  abstract  public function ulozitPrilohy($prilohy, $id_clanku);
//    {
//        $return = array('errors' => array(), 'nahled' => '');
//        $adresare = $this->najit_adresare($id_clanku, TRUE);
//        $errors = array();
//        foreach ($prilohy as $polozka)
//        {
//            if (!$polozka->size) continue;
//            if (!in_array($polozka->getContentType(), $this->povolene_typy))
//            {
//                $errors[$polozka->name] = 'Nepolovený typ souboru.';
//                continue;
//            }
//            $filename = $polozka->name;
//            $filePath = $adresare['target_adresar'] . '/' . $filename;
//            $polozka->move($filePath);
//        }
//        $return['errors'] = $errors;
//        return $return;
//    }

}

?>
