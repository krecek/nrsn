<?php

class Redakce extends NObject
{

    /** @var NConnection  */
    private $connection;

    /** @var RubrikyRepository */
    private $rubrikyRepository;

    /** @var ClankyRepository */
    private $clankyRepository;

    /** @var MenuRepository */
    private $menuRepository;

    /** @var Opravneni */
    private $opravneni;

    /** @var Prilohy */
    public $prilohy;
    public $id_hlavni_skupiny;
    public $max_rozmery_obrazku = array('sirka' => 250, 'vyska' => 250);
    public $zobrazit_od_datum_neschvaleneho_clanku = '2999-01-01';
    public $zobrazit_od_cas_neschvaleneho_clanku = '00:01';

    public function __construct(RubrikyRepository $rubrikyRepository, ClankyRepository $clankyRepository, Prilohy $prilohy, MenuRepository $menuRepository, Opravneni $opravneni, NConnection $db)
    {
        $this->rubrikyRepository = $rubrikyRepository;
        $this->clankyRepository = $clankyRepository;
        $this->prilohy = $prilohy;
        $this->menuRepository = $menuRepository;
        $this->opravneni = $opravneni;
        $this->connection = $db;
        $this->id_hlavni_skupiny = $this->rubrikyRepository->id_hlavni_skupiny;
        $this->max_rozmery_obrazku['sirka'] = $this->prilohy->max_sirka_obrazku;
        $this->max_rozmery_obrazku['vyska'] = $this->prilohy->max_vyska_obrazku;
    }

    //============================== RUBRIKY ===================================
    public function smazatRubriku($id)
    {
        if ($this->lzeSmazatRubriku($id))
        {
            return $this->rubrikyRepository->smazatRubriku($id);
        }
        return FALSE;
    }

    public function ulozitRubriku(Rubrika $rubrika)
    {
        return $this->rubrikyRepository->ulozitRubriku($rubrika);
    }

    public function findRubrikuById($id)
    {
        return $this->rubrikyRepository->findById($id);
    }

    public function findRubrikuByUrl($url)
    {
        return $this->rubrikyRepository->findByUrl($url);
    }

    /**
     * Seznam přímých podrubrik + url
     * @param int $id_rodice, výchozí je id hlavní rubriky
     * @return array
     */
    public function findRubrikyByRodic($id_rodice = null)
    {
        $rubriky = array();
        foreach ($this->rubrikyRepository->findByRodic($id_rodice) as $rubrika)
        {
            $rubrika['odkaz'] = $this->UrlRubriky($rubrika);
            $rubriky[] = $rubrika;
        }
        return $rubriky;
    }

    public function UrlRubriky($rubrika)
    {
        if ($rubrika->rodic == $this->id_hlavni_skupiny)
        {
            $url = $rubrika->url;
        }
        else
        {
            $url_casti[] = $this->findRubrikuById($rubrika->rodic)->url;
            $url_casti[] = $rubrika->url;
            $url = join('/', $url_casti);
        }
        return $url;
    }

//    public function hlavniRubriky()
//    {
//        return $this->rubrikyRepository->hlavniRubriky();
//    }

    /**
     * Seznam názvů hlavních rubrik
     * @return array $id=>$nazev
     */
    public function nazvyHlavnichRubrik()
    {
        return $this->rubrikyRepository->nazvyRubrik(array(-1, $this->id_hlavni_skupiny));
    }

    /**
     * Seznam názvů rubrik
     * @return array $id=>$nazev
     */
    public function nazvyRubrik($id_rodice = null)
    {
        return $this->rubrikyRepository->nazvyRubrik($id_rodice);
    }

    public function nazvyRubrikProClanky($id_rodice = null)
    {
        $return = array();
        $rubriky = $this->rubrikyRepository->seznamRubrik($id_rodice);
        foreach ($rubriky as $id_rodice => $podrubriky)
        {
            foreach ($podrubriky as $podrubrika)
            {
                if ($podrubrika['je_hlavni'])
                {
                    $return[$podrubrika->id] = $podrubrika->nazev;
                    if (isset($rubriky[$podrubrika->id]))
                    {
                        foreach ($rubriky[$podrubrika->id] as $podrubrika2)
                        {
                            $return[$podrubrika2->id] = "\xc2\xa0\xc2\xa0\xc2\xa0\xc2\xa0" . $podrubrika->nazev;
                        }
                    }
                }
                else
                {
                    $return[$podrubrika->id] = "\xc2\xa0\xc2\xa0\xc2\xa0\xc2\xa0" . $podrubrika->nazev;
                }
            }
        }
        unset($return[$this->id_hlavni_skupiny]);

        return $return;
    }

    /**
     * Seznam všech rubrik
     */
    public function seznamRubrik()
    {
        return $this->rubrikyRepository->seznamRubrik();
    }

    public function lzeSmazatRubriku($id)
    {

        if ($this->clankyRepository->findByRubrika($id)->count()) return FALSE;
        if (count($this->rubrikyRepository->findByRodic($id))) return FALSE;
        return TRUE;
    }

    public function findPozadiById($id_rubriky)
    {
        return $this->rubrikyRepository->findPozadiProRubrikuById($id_rubriky);
    }

    //================================ MENU RUBRIKY ==========================
    public function findMenuProRubriku($id)
    {
        $polozky = array();
        if (!$polozky = $this->menuRepository->findByRubrika($id))
        {
            if ($id != $this->id_hlavni_skupiny) $polozky = $this->findMenuProRubriku($this->findRubrikuById($id)->rodic);
        }
        return $polozky;
    }

    public function findMenuByRubrika($id)
    {
        return $this->menuRepository->findByRubrika($id);
    }

    public function ulozitMenu(Menu $menu)
    {
        return $this->menuRepository->ulozitMenu($menu);
    }

    //================================ ČLÁNKY =================================
    public function findClanekById($id)
    {
        if ($clanek = $this->clankyRepository->findById($id))
        {
            $clanek['url'] = $this->urlClanku($clanek);
            $clanek['url_obrazku'] = $this->urlPrilohy($clanek['obr'], $id);
        }
        return $clanek;
    }

    public function findClankyByAutor($id, $pouze_aktivni = TRUE)
    {
        $clanky = array();
        foreach ($this->clankyRepository->findByAutor($id, $pouze_aktivni) as $clanek)
        {
//            $clanek['rubrika_nazev'] = $this->rubrikyRepository->findById($clanek->rubrika)->nazev;
            $clanek['rubrika_nazev'] = $this->celyNazevRubrikyClanku($clanek);
            $clanek['hlavni_strana'] = $clanek->hlavni_strana == 'A' ? TRUE : FALSE;
            $clanek['top'] = $clanek->top == 'A' ? TRUE : FALSE;
            $clanky[] = $clanek;
        }
        return $clanky;
    }

    public function findClanekByUrl($url)
    {
        if (NValidators::isNumericInt($url))
        {
            return $this->findClanekById($url);
        }
        if (preg_match('~([0-9]*)-(.*)~', htmlspecialchars_decode($url), $tmp))
        {
            return $this->findClanekById($tmp[1]);
        }
        return FALSE;
    }

    public function findClankyByRubrika($id_rubriky, $pouze_aktivni = TRUE)
    {
        $clanky = array();
        foreach ($this->clankyRepository->findByRubrika($id_rubriky, $pouze_aktivni) as $clanek)
        {
//            $clanek['rubrika_nazev'] = $this->rubrikyRepository->findById($clanek->rubrika)->nazev;
            $clanek['rubrika_nazev'] = $this->celyNazevRubrikyClanku($clanek);
            $clanek['hlavni_strana'] = $clanek->hlavni_strana == 'A' ? TRUE : FALSE;
            $clanek['top'] = $clanek->top == 'A' ? TRUE : FALSE;
            $clanky[] = $clanek;
        }
        return $clanky;
    }

    public function ulozitClanek(Clanek $clanek)
    {
        if (!$clanek->getid()) //u nového článku nastavit, zda se zobrazuje na hlavní straně (automaticky se zobrazují z hlavních kategorií (teamgym, aerobik atd.)
        {
            if (array_key_exists($clanek->getRubrika(), $this->nazvyHlavnichRubrik())) $clanek->setHlavni_strana(TRUE);
        }
        return $this->clankyRepository->ulozitClanek($clanek);
    }

    public function smazatClanek($id)
    {
        $clanek = $this->clankyRepository->findById($id);
        if ($clanek->top == 'A') return 'Nelze smazat top článek';
        $this->prilohy->smazatPrilohy($id);
        $this->clankyRepository->smazatClanek($id);
        return '';
    }

    /**
     * Nastaví hlavní obrázek (ikonu) článku. Každý článek má přesně jeden.
     * @param int $id_clanku
     * @param str $priloha (název souboru)
     * @return array
     */
    public function nastavitHlavniObr($id_clanku, $priloha)
    {
        return $this->clankyRepository->nastavitHlavniObr($id_clanku, $priloha);
    }

    public function zrusitHlavniObr($id_clanku)
    {
        return $this->clankyRepository->zrusitHlavniObr($id_clanku);
    }

    /**
     * Nastaví článek jako top (trvale se zobrazuje na hlavní straně, může být pouze jeden), nastavit lze pouze u publikovaných článků
     * @param type $id_clanku
     */
    public function nastavitTopClanek($id_clanku)
    {
        if ($this->clankyRepository->findById($id_clanku)->zobrazit_od->getTimestamp() > time()) return FALSE;
        return $this->clankyRepository->nastavitTopClanek($id_clanku);
    }

    public function clankyKeSchvaleni($seznam_prav, $vyse_prav_pro_schvalovani)
    {
        foreach ($seznam_prav as $rubrika => $uroven)
        {
            if ($uroven >= $vyse_prav_pro_schvalovani) $rubriky[] = $rubrika;
        }
        $clanky = array();
        foreach ($this->clankyRepository->findByRubrika($rubriky)->where('zobrazit_od', $this->zobrazit_od_datum_neschvaleneho_clanku . ' ' . $this->zobrazit_od_cas_neschvaleneho_clanku)->order('zobrazit_od DESC') as $clanek)
        {
//            $clanek['rubrika_nazev'] = $this->rubrikyRepository->findById($clanek->rubrika)->nazev;
            $clanek['rubrika_nazev'] = $this->celyNazevRubrikyClanku($clanek);
            $clanek['hlavni_strana'] = $clanek->hlavni_strana == 'A' ? TRUE : FALSE;
            $clanek['top'] = $clanek->top == 'A' ? TRUE : FALSE;
            $clanky[] = $clanek;
        }
        return $clanky;
    }

    /**
     * Zjistí název rubriky a podrubriky, do které článek patří
     * @param $clanek
     * @return array ([0]=nadřazená rubrika, [1]=podrubrika
     */
    public function celyNazevRubrikyClanku($clanek)
    {
        $nazev = array();
        $rubrika = $this->findRubrikuById($clanek['rubrika']);
        if ($rubrika['rodic'] == $this->id_hlavni_skupiny) $nazev[0] = $rubrika['nazev'];
        else
        {
            $nazev[0] = $this->findRubrikuById($rubrika['rodic'])->nazev;
            $nazev[1] = $rubrika['nazev'];
        }
        return $nazev;
    }

    //========================== ZOBRAZOVÁNÍ ČLÁNKŮ NA WWW =====================
    /**
     * Vyhledá daný počet aktuálních článků (používá se pro zobrazení na webu)
     * @param int $pocet
     * @return type
     */
    public function aktualniClanky($pocet)
    {
        $clanky = array();
        foreach ($this->clankyRepository->aktualniClanky($pocet) as $clanek)
        {
            $clanek['url'] = $this->urlClanku($clanek);
            $clanky[] = $clanek;
        }
        return $clanky;
    }

    /**
     * Seznam top článků (1 označený jako top + daný počet nejnovějších, ketré se mají objevit na hlavní straně, nebo jsou v přímých podrubrikách
     * @param int $pocet
     * @return array
     */
    public function topClanky($pocet = 2)
    {
        $clanky = array();
        $pocet_novych_clanku = $pocet - 1;
        if ($top_clanek = $this->clankyRepository->topClanek()) $clanky[$top_clanek->id] = $top_clanek;
        else $pocet_novych_clanku = $pocet;
        $clanky = array_merge($clanky, $this->nejnovejsiClanky($this->rubrikyRepository->findByRodic($this->id_hlavni_skupiny), TRUE, $pocet_novych_clanku, FALSE, $top_clanek->id));
        $i = 1;
        foreach ($clanky as $key => $clanek)
        {
            $clanek['url'] = $this->urlClanku($clanek);
            $clanek['nahledy'] = $this->prilohy->obrTopClanek($clanek['id']);
            if ($i == 1) $clanky['top_clanek'][$key] = $clanek;
            else $clanky['nejnovejsi_clanky'][$key] = $clanek;
            $i++;
        }
        return $clanky;
    }

    /**
     * Vybere top článek, pokud není nastaven, zvolí se nejnovější článek
     * @return array
     */
    public function topClanek()
    {
        $clanky = array();
        if ($top_clanek = $this->clankyRepository->topClanek()) $clanky[$top_clanek->id] = $top_clanek;
        else $clanky = array_merge($clanky, $this->nejnovejsiClanky($this->rubrikyRepository->findByRodic($this->id_hlavni_skupiny), TRUE, 1, FALSE));
        return $clanky;
    }

    /** NEPOUŽITO
     * Vybere nejnovější článek na hlavní stranu (zobrazí se vedle top článku)
     * @return array
     */
    public function nejnovejsiClanek()
    {
        $clanky = array();
        $clanky = array_merge($clanky, $this->nejnovejsiClanky($this->rubrikyRepository->findByRodic($this->id_hlavni_skupiny), TRUE, 1, FALSE));
        foreach ($clanky as $clanek)
        {
            $clanek['url'] = $this->urlClanku($clanek);
            $clanek['nahledy'] = $this->prilohy->obrTopClanek($clanek['id']);
        }
        return $clanky;
    }

    /**
     * Seznam článků určených na hlavní stranu (top i běžných) + náhledy
     * @param int $pocet_top - počet top článků
     * @param int $pocet_ostatni - počet běžných článků na stránku
     * @return array, klíče: clanky, top_clanky 
     */
    public function clankyNaHlavniStranu($pocet_top, $pocet_ostatni)
    {
        $top_clanky = $this->topClanky($pocet_top);
        $top_clanek = $top_clanky['top_clanek'];
//        $nejnovejsi_clanky = $top_clanky['nejnovejsi_clanky'];
//        $top_clanky = $this->topClanek();
//        $nejnovejsi_clanky = $this->nejnovejsiClanek(); //vybere pouze jeden nejnovější
        $clanky = $this->nejnovejsiClanky($this->rubrikyRepository->findByRodic($this->id_hlavni_skupiny), TRUE, $pocet_ostatni, FALSE);
        foreach ($top_clanek as $top_cl)
        {
            if (isset($clanky[$top_cl->id])) unset($clanky[$top_cl->id]);
        }
//        foreach($nejnovejsi_clanky as $nejnovejsi_cl)
//        {
//             if (isset($clanky[$nejnovejsi_cl->id])) unset($clanky[$nejnovejsi_cl->id]);
//        }

        $return['clanky'] = $clanky;
        $return['top_clanky'] = $top_clanky;
//        $return['nejnovejsi_clanky'] = $nejnovejsi_clanky;
        return $return;
    }

    public function clankyNeprehlednete($pocet)
    {

        $clanky = $this->clankyRepository->clankyNeprehlednete($pocet);
        foreach ($clanky as $key => $clanek)
        {
            $clanek['url'] = $this->urlClanku($clanek);
            $clanek['nahled'] = $this->prilohy->obrClanku($clanek['id'], $clanek['obr']);
            $clanky[$key] = $clanek;
        }
        return $clanky;
    }

    public function clankyProRubriku($id_rubriky, $hlavni_strana = FALSE, $pocet = null)
    {
        $rubriky = $this->rubrikyRepository->findByRodic($id_rubriky);
        $rubriky[] = $id_rubriky;
        $clanky = $this->nejnovejsiClanky($rubriky, $hlavni_strana, $pocet);
        return $clanky;
    }

    public function podobneClanky($id_clanku, $pocet = null, $id_rubriky = null)
    {
        if (is_null($id_rubriky)) $id_rubriky = $this->clankyRepository->findById($id_clanku)->rubrika;
        $clanky = $this->clankyProRubriku($id_rubriky, FALSE, $pocet);
        if (isset($clanky[$id_clanku])) unset($clanky[$id_clanku]);
        return $clanky;
    }

    /**
     * Vybere daný počet nejnovějších článků ze zvolených rubrik
     * @param array $rubriky - id rubrik
     * @param bool $hlavni_strana - pouze články určené na hlavní stranu?
     * @param int $pocet
     * @param bool $top - zahrnout i top článek?
     * @return array
     */
    public function nejnovejsiClanky($rubriky, $hlavni_strana = FALSE, $pocet = NULL, $top = TRUE, $bez_clanku_id = null)
    {
        $clanky = array();
        $clanky = $this->clankyRepository->nejnovejsiClanky($rubriky, $hlavni_strana, $pocet, $top, $bez_clanku_id);
        foreach ($clanky as $clanek)
        {
            $clanek['url'] = $this->urlClanku($clanek);
            $clanek['nahled'] = $this->prilohy->obrClanku($clanek['id'], $clanek['obr']);
        }
        return $clanky;
    }

    public function findClankyFulltext($text, $udaje_pro_admin = FALSE)
    {
        $clanky = $this->clankyRepository->findClankyFulltext($text);
        foreach ($clanky as $key => $clanek)
        {
            $clanek['url'] = $this->urlClanku($clanek);
            $clanek['nahled'] = $this->prilohy->obrClanku($clanek['id'], $clanek['obr']);
            if ($udaje_pro_admin)
            {
                $clanek['rubrika_nazev'] = $this->celyNazevRubrikyClanku($clanek);
                $clanek['hlavni_strana'] = $clanek->hlavni_strana == 'A' ? TRUE : FALSE;
                $clanek['top'] = $clanek->top == 'A' ? TRUE : FALSE;
            }
            $clanky[$key] = $clanek;
        }
        return $clanky;
    }

    public function rokyProArchiv()
    {
        return $this->clankyRepository->rokyProArchiv();
    }

    public function findClankyByRok($rok)
    {
        $clanky = $this->clankyRepository->findClankyByRok($rok);
        foreach ($clanky as $key => $clanek)
        {
            $clanek['url'] = $this->urlClanku($clanek);
        }
        return $clanky;
    }

    public function urlClanku($clanek)
    {
        return NStrings::webalize($clanek->id . '-' . $clanek->nadpis);
    }

    //========================== PŘÍLOHY =======================================
    /**
     * Vyhledá všechny přílohy k článku a přidá k nim adresu náhledu
     * @param type $id_clanku
     * @return array, ve tvaru [adresa]=> array klíče:nazev, typ, nahled, je_obrazek
     */
    public function seznamPriloh($id_clanku, $vyhledat_nahledy_na_hlavni_stranku = FALSE)
    {
        return $this->prilohy->seznamPriloh($id_clanku, $vyhledat_nahledy_na_hlavni_stranku);
    }

    public function seznamObrazku($id_clanku)
    {
        return $this->prilohy->seznamObrazku($id_clanku);
    }

    public function seznamOstatnichPriloh($id_clanku)
    {
        return $this->prilohy->seznamOstatnichPriloh($id_clanku);
    }

    public function ulozitPrilohy($prilohy, $id_clanku)
    {
        $vysledek = $this->prilohy->ulozitPrilohy($prilohy, $id_clanku);
        if (isset($vysledek['nahled']) && $vysledek['nahled'] != '')
        { //pokud není nastaven u článku žádný obrázek, nastavit
            if (!$this->clankyRepository->findById($id_clanku)->obr)
            {
                $this->clankyRepository->nastavitHlavniObr($id_clanku, $vysledek['nahled']);
            }
            if (!$this->jeObrTopClanek($id_clanku)) $this->nastavitObrTopClanek($id_clanku, $vysledek['nahled']);
        }
        return $vysledek['errors'];
    }

    public function smazatPrilohu($id_clanku, $priloha)
    {

        $this->prilohy->smazatPrilohu($id_clanku, $priloha);
        if ($this->clankyRepository->findById($id_clanku)->obr == $priloha)
        {
            $novy_obr = $this->prilohy->automatickyVybratObrClanku($id_clanku);
            $this->nastavitHlavniObr($id_clanku, $novy_obr);
        }
        if (!$this->jeObrTopClanek($id_clanku))
        {
            if ($seznam_obrazku = $this->seznamObrazku($id_clanku))
            {
                $priloha = reset($seznam_obrazku);
                $this->nastavitObrTopClanek($id_clanku, $priloha['nazev']);
            }
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
        return $this->prilohy->najit_adresare($id_clanku, $vytvorit_adresare);
    }

    public function vytvorit_nahled($filePath, $novy_nazev = null, $x = null, $y = null)
    {
        return $this->prilohy->vytvorit_nahled($filePath, $novy_nazev, $x, $y);
    }

    /**
     * Seznam obrázků určených k zobrazení na hlavní stránce
     * @param type $id_clanku
     * @return FALSE/array
     */
    public function obrTopClanek($id_clanku)
    {
        return $this->prilohy->obrTopClanek($id_clanku);
    }

    public function nastavitObrTopClanek($id_clanku, $priloha)
    {
        return $this->prilohy->nastavitObrTopClanek($id_clanku, $priloha);
    }

    public function zrusitObrTopClanek($id_clanku, $priloha)
    {
        return $this->prilohy->zrusitObrTopClanek($id_clanku, $priloha);
    }

    /**
     * Je nastaven nějaký obrázek k top článku?
     * @param int $id_clanku
     * @return boolean
     */
    public function jeObrTopClanek($id_clanku)
    {
        return $this->prilohy->jeObrTopClanek($id_clanku);
    }

    public function urlPrilohy($nazev_prilohy, $id_clanku)
    {
        $adresare = $this->najit_adresare($id_clanku);
        return $adresare['target_adresar'] . '/' . $nazev_prilohy;
    }

}

?>
