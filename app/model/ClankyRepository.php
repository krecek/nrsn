<?php

class ClankyRepository extends Repository
{

//========================== VYHLEDÁVÁNÍ ČLÁNKŮ ============================
    public function findById($id)
    {
        $by['id'] = $id;
        return $this->findBy($by)->fetch();
    }

    public function findByRubrika($id_rubriky, $pouze_aktivni = TRUE)
    {
        $return = $this->findBy(array('rubrika' => $id_rubriky));
        if ($pouze_aktivni)
        {
            $return->where('zobrazit_do>=?', date('Y-m-d'));
        }
        return $return->order('zobrazit_od DESC');
    }

    public function findByAutor($id, $pouze_aktivni = TRUE)
    {
        $return = $this->getTable()->where('autor', $id);
        if ($pouze_aktivni)
        {
            $return->where('zobrazit_do>=?', date('Y-m-d'));
        }
        return $return->order('zobrazit_od DESC');
    }

    public function topClanek()
    {
        return $this->getTable()->where('top', 'A')->fetch();
    }

    public function nejnovejsiClanky($rubriky, $hlavni_strana = FALSE, $pocet = NULL, $top = TRUE, $bez_clanku_id = null)
    {
        $return = $this->getTable();
        if ($hlavni_strana) $return->where('hlavni_strana', 'A');
        if (!$top) $return->where('top', 'N');
        else $return->where('rubrika', $rubriky);
        $return->where('zobrazit_od <=?', date('Y-m-d H:i'))->where('zobrazit_do >=?', date('Y-m-d H:i'))->where('NOT id', $bez_clanku_id)->order('zobrazit_od DESC')->order('id DESC')->limit($pocet);
        return $return->fetchPairs('id');
    }

    public function clankyNeprehlednete($pocet, $bez_clanku_id = null)
    {
        return $this->getTable()->where('hlavni_strana', 'N')->where('zobrazit_od <=?', date('Y-m-d H:i'))->where('zobrazit_do >=?', date('Y-m-d H:i'))->order('zobrazit_od DESC')->order('id DESC')->limit($pocet)->fetchPairs('id');
    }

    public function findClankyFulltext($text)
    {
        $query = "SELECT *, (5*MATCH(nadpis) AGAINST ('$text*' IN BOOLEAN MODE) + 3*MATCH(perex) AGAINST('$text*' IN BOOLEAN MODE) + MATCH(obsah) AGAINST('$text*' IN BOOLEAN MODE)) as vyznam 
                FROM clanky
                WHERE MATCH(nadpis, perex, obsah) AGAINST ('$text*' IN BOOLEAN MODE)
                ORDER BY vyznam DESC, zobrazit_od DESC";
        return $this->connection->query($query)->fetchAll();
    }

    public function findClankyByRok($rok)
    {
        $od = "$rok-01-01 00:00";
        $do = "$rok-12-31 23:59";
        return $this->getTable()->select('*, DATE(zobrazit_od) AS datum')->where('zobrazit_od>=?', $od)->where('zobrazit_od<=?', $do)->order('zobrazit_od DESC');
    }

    public function rokyProArchiv()
    {
        return $this->getTable()->select('YEAR(zobrazit_od) AS rok')->group('YEAR(zobrazit_od)')->fetchPairs('rok', 'rok');
    }

    // ==================== ZÁKLADNÍ ČINNOSTI =======================

    public function ulozitClanek(Clanek $clanek)
    {
        if ($clanek->id)
        {
            $this->getTable()->where('id', $clanek->id)->update($clanek->getUdaje());
            $zaznam = $this->findById($clanek->id);
        }
        else
        {
            $zaznam = $this->getTable()->insert($clanek->getUdaje());
        }
        return $zaznam;
    }

    public function smazatClanek($id)
    {
        return $this->getTable()->where('id', $id)->delete();
    }

    //===================================================================
    /**
     * Nastaví článek jako top (trvale se zobrazuje na hlavní straně, může být pouze jeden)
     * @param type $id_clanku
     */
    public function nastavitTopClanek($id_clanku)
    {
        $this->getTable()->where('top', 'A')->update(array('top' => 'N'));
        $this->getTable()->where('id', $id_clanku)->update(array('top' => 'A'));
        return TRUE;
    }

    //==================================================================

    public function nastavitHlavniObr($id, $priloha)
    {
        return $this->getTable()->where('id', $id)->update(array('obr' => $priloha));
    }
    
    public function zrusitHlavniObr($id)
    {
        return $this->getTable()->where('id', $id)->update(array('obr'=>''));
    }

    public function datumClanku(DateTime $datum)
    {
        $now = new NDateTime53();
        if ($datum->format('Y-m-d') == $now->format('Y-m-d')) return $datum->format('H:i'); //dnešní článek
        if ($datum->format('Y') == $now->format('Y')) return $datum->format('j.n.Y'); //článek je letošní
        if ($datum->format('Y-m-d') < $now->modify('-1 years')->format(('Y-m-d'))) return $datum->format('Y'); //článek je starší než 1 rok
        return $datum->format('j.n.Y');
    }

}

?>
