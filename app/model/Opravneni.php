<?php

class Opravneni extends Repository
{

    private $id_osoby;

    public function setId_osoby($id_osoby)
    {
        $this->id_osoby = $id_osoby;
    }

    public function getTable()
    {

        return $this->connection->table('prava');
    }

    /**
     * Seznam uživatelů a úroveň jejich práv k modulu a subintu
     * @param str $modul
     * @param int $subint
     * @return NStatement
     */
    public function getPrehledPrav($modul, $subint)
    {
        $query = "SELECT p.modul, p.subint, p.osoba, p.uroven, o.username, o.jmeno, o.prijmeni FROM prava p JOIN osoby o ON p.osoba = o.id WHERE p.modul='$modul' AND subint=$subint ORDER BY p.uroven DESC";
        return $this->connection->query($query);
    }

    /**
     * Vrátí subinty, ke kterým má osoba přístup. Lze nastavit, od jaké úrovně se kontroluje.
     * @param type $modul
     * @param int minimální úroveň
     * @param int null=aktuálně  přihlášený uživatel
     * @param bool kontrolovat i subint 0?
     * @return array
     */
    public function getPristupy($modul, $uroven = null, $id_osoby = null, $zahrnout_0 = FALSE)
    {
        if ($id_osoby == NULL)
        {
            $id_osoby = $this->id_osoby;
        }
        if ($uroven == NULL)
        {
            $uroven = 1;
        }
        $query = $this->getTable()->select('subint')->where('modul', $modul)->where('osoba', $id_osoby)->where('uroven >=?', $uroven);
        dd($zahrnout_0, 'zahrnou 0');
        if (!$zahrnout_0){ $query->where('subint !?', '0'); dd('i', 'i');}
        return array_values($query->fetchPairs('subint', 'subint'));
    }

    public function setPrava($id_osoby, $modul, $subint, $uroven)
    {
        if ($subint === NULL)
        {
            $subint = 0;
        }
        //má již osoba práva?
        $prava = $this->prava($modul, $subint, $id_osoby);
//        if (($prava&& $modul!='OSOBY')||($prava>1))
        if (($prava))
        {
            if ($uroven > 0)
            {
                $zaznam = $this->getTable()->where('modul', $modul)->where('subint', $subint)->where('osoba', $id_osoby)->update(array(
                    'uroven' => $uroven,
                ));
            }
            else
            {
                $zaznam = $this->getTable()->where('modul', $modul)->where('subint', $subint)->where('osoba', $id_osoby)->delete();
            }
        }
        else
        {

            if ($uroven > 0)
            {
                $zaznam = $this->getTable()->insert(array(
                    'modul' => $modul,
                    'subint' => $subint,
                    'osoba' => $id_osoby,
                    'uroven' => $uroven,
                ));
            }
            else
            {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function seznamPrav($modul, $osoba = '*')
    {
        if ($osoba === '*') $osoba = $this->id_osoby;
        return $this->getTable()->where('modul', $modul)->where('osoba', $osoba)->fetchPairs('subint', 'uroven');
    }

    public function prava($modul, $subint = '*', $osoba = '*')
    {
// jako default subintu dat parametr subint z URL
// jako default osoby dat to definici funkce toho, kdo je prihlasenej
        $subint_sql = '';
        if ($subint !== '*')
        {
            $subint_sql = " AND subint='$subint'";
        }
        if ($osoba === '*') $osoba = $this->id_osoby;
        $query = "SELECT id, modul, subint, osoba, uroven FROM prava WHERE modul='$modul' AND (osoba=0 OR osoba='$osoba') $subint_sql ORDER BY uroven DESC LIMIT 1";
        if ($zaznam = $this->connection->query($query)->fetch())
        {
            return $zaznam['uroven'];
        }
        else
        {
            return 0;
        }


//        $tmp = MySQL_Query("SELECT * FROM prava WHERE modul='$modul' AND (osoba=0 OR osoba='$osoba') $subint_sql ORDER BY uroven DESC LIMIT 1");
//        if ($zaznam = MySQL_Fetch_Assoc($tmp))
//            return $zaznam[uroven];
//        else
//            return 0;
    }

    public function kopirovatPrava($subint, $modul_from, $modul_to)
    {
        $prava_from = $this->getPrehledPrav($modul_from, $subint);
        $this->getTable()->where('modul', $modul_to)->where('subint', $subint)->delete();
        foreach ($prava_from as $pravo)
        {
            $this->getTable()->insert(array(
                'modul' => $modul_to,
                'subint' => $subint,
                'osoba' => $pravo['osoba'],
                'uroven' => $pravo['uroven'],
            ));
        }
    }

    /**
     * Porovná práva pro stejný subint ve dvou různých modulech (porovnává osoby a jejich úroveň)
     * @param int $subint
     * @param string $modul_from
     * @param string $modul_to
     * @return boolean
     */
    public function porovnatPrava($subint, $modul_from, $modul_to)
    {
        $osoby_from = array();
        $osoby_to = array();
        $prava_from = $this->getPrehledPrav($modul_from, $subint);
        foreach ($prava_from as $pravo_from)
        {
            $osoby_from[$pravo_from['osoba']] = $pravo_from['uroven'];
        }
        dd($osoby_from, 'osoby_from');
        $prava_to = $this->getPrehledPrav($modul_to, $subint);

        foreach ($prava_to as $pravo_to)
        {
            $osoby_to[$pravo_to['osoba']] = $pravo_to['uroven'];
        }
        dd($osoby_to, 'osoby_to');
        if($osoby_from != $osoby_to) return FALSE;
        return TRUE;
    }
    
    

    public function smazatPravaOddil($id_oddilu)
    {
        return $this->getTable()->where('subint', $id_oddilu)->where('modul', 'ODDILY')->delete();
    }

    public function smazatPravaOsoba($id_osoby)
    {
        return $this->getTable()->where('osoba', $id_osoby)->delete();
    }

    public function smazatPravaRedakce($id_rubriky)
    {
        return $this->getTable()->where('subint', $id_rubriky)->where('modul', 'REDAKCE')->delete();
    }
    /**
     * Seznam osoba s oprávněním min. $level
     * @param type $modul
     * @param type $subint
     * @param type $level
     * @return type
     */
    public function opravneneOsoby($modul, $subint, $level=1)
    {
        return $this->getTable()->where('modul', $modul)->where('subint', $subint)->where('uroven >=?', $level);
    }

}

?>
