<?php

class RubrikyRepository extends Repository
{

    public $id_hlavni_skupiny = 0;
    public $vychozi_pozadi = 'top-img-home9.jpg';

    public function findById($id)
    {
        $by['id'] = $id;
        return $this->findBy($by)->fetch();
    }

    public function ulozitRubriku(Rubrika $rubrika)
    {
        if ($rubrika->id)
        {
            $zaznam = $this->getTable()->where('id', $rubrika->id)->update($rubrika->getUdaje());
        }
        else
        {
            $zaznam = $this->getTable()->insert($rubrika->getUdaje());
        }
        return $zaznam;
    }

    public function smazatRubriku($id)
    {
        if ($id != $this->id_hlavni_skupiny)
        {
            return $this->getTable()->where('id', $id)->delete();
        }
        return FALSE;
    }

    public function findByRodic($id = null)
    {
        if (is_null($id)) $id = $this->id_hlavni_skupiny;
        $rubriky = array();
        foreach ($this->getTable()->where('rodic', $id) as $rubrika)
        {
            if ($rubrika['rodic'] == $this->id_hlavni_skupiny) $rubrika['je_hlavni'] = TRUE;
            else $rubrika['je_hlavni'] = FALSE;
            $rubriky[] = $rubrika;
        }
        return $rubriky;
    }

    public function findByUrl($url)
    {
        $casti = explode('/', $url);
        $pocet_casti = count($casti);
        if ($pocet_casti) $return = $this->getTable();
        if ($pocet_casti == 1)
        {
            $return->where('url', $casti[0])->where('rodic', $this->id_hlavni_skupiny);
        }
        elseif ($pocet_casti == 2)
        {
            $return->where('rodic', $this->getTable()->where('url', $casti[0])->where('rodic', $this->id_hlavni_skupiny))->where('url', $casti[1]);
        }
        else return FALSE;
        if (!$rubrika = $return->fetch()) return FALSE;
        if ($rubrika['rodic'] == $this->id_hlavni_skupiny) $rubrika['je_hlavni'] = TRUE;
        else $rubrika['je_hlavni'] = FALSE;
        return $rubrika;
    }

    /**
     * Seznam všech rubrik
     * @return array $id=>$nazev
     */
    public function nazvyRubrik($id_rodice = null)
    {
        $zaznamy = $this->getTable();
        if ($id_rodice) $zaznamy->where('rodic', $id_rodice);
        return $zaznamy->fetchPairs('id', 'nazev');
    }

    /**
     * Seznam všech rubrik
     * @return array 
     */
    public function seznamRubrik($id_rodice = null)
    {
        if (is_null($id_rodice)) $id_rodice = $this->id_hlavni_skupiny;
        $rubriky = array();
        $zaznamy = $this->findByRodic($id_rodice);
        foreach ($zaznamy as $zaznam)
        {
            $zaznam['rodic_nazev'] = $this->findById($zaznam->rodic)->nazev;
            $rubriky[$this->id_hlavni_skupiny][] = $zaznam;
            $podrubriky = $this->findByRodic($zaznam->id);
            foreach ($podrubriky as $podrubrika)
            {
                $podrubrika['rodic_nazev'] = $this->findById($podrubrika->rodic)->nazev;
                $rubriky[$zaznam->id][] = $podrubrika;
            }
        }
        return $rubriky;
    }

    //========================== POZADÍ RUBRIKY =============================   
    public function findPozadiProRubrikuById($id)
    {
        $rubrika = $this->findById($id);
        if (!$rubrika['pozadi'])
        {
            if($rubrika['id']==$this->id_hlavni_skupiny) $pozadi=$this->vychozi_pozadi;
            else{$pozadi = $this->findPozadiProRubrikuById($rubrika['rodic']);}
        }
        else $pozadi = $rubrika['pozadi'];
        return $pozadi;
    }

}

?>
