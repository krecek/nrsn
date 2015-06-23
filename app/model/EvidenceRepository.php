<?php

class EvidenceRepository extends Repository
{

    public function oddilyOsoba($id_osoby)
    {
        $query = "SELECT e.id as id_evidence, e.od, e.do, od.nazev, od.id as oddil FROM evidence e LEFT JOIN osoby os ON os.id = e.osoba LEFT JOIN oddily od ON od.id = e.oddil WHERE os.id = $id_osoby ORDER BY od ";
        return $this->connection->query($query);
    }

    public function pocetOsobVOddilu($id_oddilu, $rok)
    {
        $query = "SELECT COUNT(*) as count FROM evidence e LEFT JOIN osoby o ON o.id = e.osoba WHERE oddil=$id_oddilu AND od >= '$rok-01-01' AND `do` <= '$rok-12-31'";
        return $this->connection->query($query)->fetch()->count;
    }

    public function osobyOddil($id_oddilu, $rok, $order = null, $kontrolovat_registrace)
    {

        if ($order != '')
        {
            if (preg_match('~(.*)_DESC~', $order, $tmp))
            {
                $query_order = " ORDER BY $tmp[1] DESC";
            }
            else
            {
                $query_order = " ORDER BY $order";
            }
        }
        else
        {
            $query_order = " ORDER BY prijmeni, jmeno";
        }
        if ($kontrolovat_registrace)
        {
            $query = "SELECT os.id, os.jmeno, os.prijmeni, os.narozeni, os.rc, os.email, os.cizinec, os.pohlavi, os.mobil, os.telefon, os.ulice, os.obec, os.psc,  e.od, if(r.id, 1, 0) as registrace 
                    FROM evidence e
                    LEFT JOIN osoby os ON os.id = e.osoba 
                    LEFT JOIN (SELECT id, sport, oddil, osoba FROM registrace WHERE 
                    oddil = $id_oddilu AND od >= '$rok-01-01' AND `do` <= '$rok-12-31')r ON r.osoba=e.osoba
                    WHERE e.oddil = $id_oddilu AND e.od >= '$rok-01-01' AND e.do <= '$rok-12-31' 
                    GROUP BY os.id
                    $query_order";
        }
        else
        {
            $query = "SELECT os.id, os.jmeno, os.prijmeni, os.narozeni, os.rc, os.email, os.mobil, os.telefon, os.ulice, os.obec, os.psc, e.od
                    FROM evidence e
                    LEFT JOIN osoby os ON os.id = e.osoba 
                    WHERE e.oddil = $id_oddilu AND e.od >= '$rok-01-01' AND e.do <= '$rok-12-31' 
                    GROUP BY os.id
                    $query_order";
        }
        return $this->connection->query($query);
    }
    
    public function osobyOddilKeDni($id_oddilu, $datum, $rocnik_od=null, $rocnik_do=null, $pohlavi=null)
    {
        $query_filtr='';
        if ($rocnik_od) $query_filtr.="AND YEAR(narozeni)<='$rocnik_od' ";
        if ($rocnik_do) $query_filtr.="AND YEAR(narozeni)>='$rocnik_do'";
        if ($pohlavi) $query_filtr.="AND pohlavi='$pohlavi'";
        $query = "SELECT os.id, os.jmeno, os.prijmeni, os.narozeni, os.rc, os.email,  e.od
                    FROM evidence e
                    LEFT JOIN osoby os ON os.id = e.osoba 
                    WHERE e.oddil = $id_oddilu AND e.od <= '$datum' AND e.do >= '$datum' $query_filtr 
                    GROUP BY os.id
                    ORDER BY prijmeni, jmeno";
        return $this->connection->query($query);
    }

    /**
     * Seznam osob, které nejsou evidované v roce $rok1 a jsou evidované v roce $rok2 (osoby. které nejsou evidované v roce 2013, ale jsou v roce 2012: $rok1=2013, $rok2=2012
     * @param int rok, ve kterém osoby nemají být evidované
     * @param int rok, ve kterém osoby mají být evidované
     * @return NStatement
     */
    public function porovnatOsobyVOddilu($id_oddilu, $rok1, $rok2)
    {
        $query = "SELECT DISTINCT osoba as id, jmeno, prijmeni, narozeni FROM evidence r LEFT JOIN osoby o ON r.osoba = o.id WHERE osoba NOT IN(
                     SELECT osoba FROM evidence WHERE oddil= $id_oddilu AND `od` >= '$rok1-01-01' AND `do` = '$rok1-12-31')
                  AND oddil=$id_oddilu AND `od` >= '$rok2-01-01' AND `do` = '$rok2-12-31' ORDER BY prijmeni, jmeno";
        return $this->connection->query($query);
    }

    public function evidovatOsobu($id_osoby, $id_oddilu, $rok, $datum = null)
    {
        //ověřit, zda existuje oddíl a osoba
        $query_osoba = "SELECT id FROM osoby WHERE id=$id_osoby";
        if (intval($id_oddilu))
                $query_oddil = "SELECT id FROM oddily WHERE id=$id_oddilu";
        else
        {
            $query_oddil = "SELECT id FROM oddily WHERE nazev LIKE '$id_oddilu'";
        }

        if (!$this->connection->query($query_osoba)->getColumnCount() && $b = $this->connection->query($query_oddil)->fetch())
        {
            throw new GException('Nelze evidovat osobu - osoba nebyla nalezena');
        }
        elseif (!$oddil = $this->connection->query($query_oddil)->fetch())
        {
            throw new GException('Osobu nelze evidovat - oddíl nebyl nalezen');
        }
        else
        {
            $od = ($rok == date('Y')) ? date("Y-m-d") : "$rok-01-01";
            $od = $datum ? $datum : $od;
            $rok = $rok ? $rok : date('Y');
            $do = "$rok-12-31";
            //oveřit, zda osoba není již pro daný rok v tomto oddíle evidovaná
            $stavajici_zaznam = $this->getTable()->where('osoba', $id_osoby)->where('oddil', $id_oddilu)->where('od >=?', $rok . '-01-01')->where('do<=?', $rok . '-12-31')->fetch();
            if (!$stavajici_zaznam)
            {
                $zaznam = $this->getTable()->insert(array(
                    'osoba' => $id_osoby,
                    'oddil' => $oddil->id,
                    'od' => $od,
                    'do' => $do,
                ));
                return $zaznam;
            }
            else
            {
                throw new GException('Osoba již je v tomto oddíle pro tento rok evidována');
            }
        }
    }

    public function odstranitZEvidence($id_oddilu, $id_osoby, $rok)
    {
        return $this->getTable()->where('oddil', $id_oddilu)->where('osoba', $id_osoby)->where('od>=?', $rok . '-01-01')->where('do<=?', $rok . '-12-31')->delete();
    }

    /**
     * Je osoba evidovaná pro daný rok (případně i v daném oddlílu)?
     * @param int $id_osoby
     * @param int $rok
     * @param int $id_oddilu
     */
    public function jeOsobaEvidovana($id_osoby, $datum, $id_oddilu = null)
    {
        $oddil_query = ($id_oddilu) ? " AND oddil='$id_oddilu' " : '';
        $query = "SELECT * from osoby o JOIN evidence e ON o.id=e.osoba WHERE e.od<='$datum' AND e.do >='$datum' $oddil_query AND e.osoba=$id_osoby";

        if ($this->connection->query($query)->rowCount())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function rokyOddil($id_oddilu)
    {
        $roky = array();
        foreach ($this->getTable()->select('DISTINCT YEAR(do)AS rok')->where('oddil', $id_oddilu)->order('rok DESC') as $rok)
        {
            $roky[$rok['rok']] = $rok->rok;
        }
        return $roky;
    }

    public function odstranitEvidenceOddilu($id_oddilu, $rok)
    {
        return $this->getTable()->where('oddil', $id_oddilu)->where('od >=?', "$rok-01-01")->where('do<=?', "$rok-12-31")->delete();
    }

    /**
     * Celkový počet všech evidencí v roce (bez ohledu na oddíl)
     * @param int $rok
     * @return int
     */
    public function pocetOsob($rok)
    {
        return $this->getTable()->where('od >=?', "$rok-01-01")->where('do <=?', "$rok-12-31")->group('osoba')->count();
    }

    /**
     * Vymaže záznam z tabulky
     * @param int $id_zaznamu
     * @return type
     */
    public function smazatZaznam($id_zaznamu)
    {
        $zaznam = $this->connection->query("SELECT * FROM evidence WHERE id=$id_zaznamu")->fetch();
        if ($this->getTable()->where('id', $id_zaznamu)->delete())
        {
            return $zaznam;
        }
        else
        {
            return false;
        }
    }

    public function posledniZaznamy($id_osoby)
    {
        $return = array();
//        $query = "SELECT id, oddil, osoba, od, do FROM evidence WHERE osoba = $id_osoby AND od>= '" . date('Y-01-01') . "' HAVING MAX(od)";
        $query = "SELECT id, oddil, osoba, od, do FROM evidence WHERE osoba = $id_osoby AND od>= '" . date('Y-01-01') . "'";

        foreach ($this->connection->query($query) as $row)
        {
            $return[] = $row;
        }
        return $return;
    }
    
}

?>
