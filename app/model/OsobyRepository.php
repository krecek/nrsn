<?php

class OsobyRepository extends Repository
{

    public function findByUsername($username)
    {
        return $this->findAll()->where('username', $username)->fetch();
    }

    public function findById($id)
    {
        $by['id'] = $id;
        return $this->findBy($by)->fetch();
    }

    public function findByRc($rodne_cislo)
    {
        $by['rc'] = $rodne_cislo;
        return $this->findBy($by)->fetch();
    }
    
    public function findByJmenoPrijmeniRocnik($jmeno, $prijmeni, $rocnik)
    {
        return $this->getTable()->where('jmeno',$jmeno)->where('prijmeni',$prijmeni)->where('YEAR(narozeni)',$rocnik);
    }

    public function overitHeslo($id_osoby, $heslo)
    {
        if ($this->findById($id_osoby)->password == Authenticator::calculateHash($heslo))
        {
            return true;
        }
        return false;
    }

    public function generovatUsername($id)
    {
        $zaznam = $this->findById($id);
        $jmeno = NStrings::webalize($zaznam->jmeno);
        $prijmeni = NStrings::webalize($zaznam->prijmeni);
        $username = NStrings::webalize($prijmeni);
        if (!$this->findByUsername($username))
        {
            return $username;
        }
        $username = $prijmeni . NStrings::truncate($jmeno, 1, '');
        if (!$this->findByUsername($username))
        {
            return $username;
        }
        $username = $prijmeni . $jmeno;
        if (!$this->findByUsername($username))
        {
            return $username;
        }
        for ($i = 1; 1 == 1; $i++)
        {
            $username = $prijmeni . $jmeno . $i;
            if (!$this->findByUsername($username))
            {
                return $username;
            }
        }
    }

    public function zmenitUzivatelskeJmeno($id_uzivatele, $username)
    {
        $this->getTable()->where('id', $id_uzivatele)->update(array(
            'username' => $username,
        ));
    }

    public function zmenitHeslo($id_uzivatele, $password)
    {
        $this->getTable()->where('id', $id_uzivatele)->update(array(
            'password' => Authenticator::calculateHash($password),
        ));
    }

    /**
     * Seznam osob narozených v daný den
     * @param str ve tvaru Y-m-d
     * @return NTableSelection
     */
    public function findByNarozeni($datum_narozeni)
    {
        return $this->getTable()->where('narozeni', $datum_narozeni);
    }

    /**
     * Seznam osob, které mají stejné jméno i příjmení
     * @param str $jmeno
     * @param str $prijmeni
     * @return NTableSelection
     */
    public function findByJmenoPrijmeni($jmeno, $prijmeni)
    {
        return $this->getTable()->where('jmeno', $jmeno)->where('prijmeni', $prijmeni);
    }

    /**
     * Seznam osob, jejichž příjmení začíná danými písmeny
     * @param type $text
     * @return type
     */
    public function vyhledatOsoby($text)
    {
        $letters = "'^" . mysql_escape_string($text) . "'";
        $query = "SELECT id, prijmeni, jmeno, rc, narozeni FROM osoby WHERE prijmeni REGEXP $letters ORDER BY prijmeni, jmeno, narozeni";
        return $this->connection->query($query);
    }

    /**
     * Uloží osobu 
     * volá se při vytvoření nové osoby (admin, evidence oddílu) a editaci osoby (admin, user)
     * @param Osoba $osoba
     * @param bool - v režimu admin? (režim admin = před uložením při shodě dotaz zda update nebo insert)
     * @param str - U=update, I = insert (funguje pouze když $admin = true)
     */
    public function ulozitOsobu(Osoba $osoba, $admin = FALSE, $rezim = NULL, $csv=FALSE)
    {
        $udaje = $osoba->getUdaje();
        $akce = '';
        $novy_mail = FALSE;

        dd($udaje, 'udaje');
        if ($osoba->id) //pouze editace
        {
            if (isset($udaje['email']) && $udaje['email'] != '' && $this->findById($osoba->id)->email == '')
            {
                $novy_mail = TRUE;
            }
            $stavajici_zaznam = $this->findById($osoba->id);
            if(isset($udaje['rc']) && $udaje['rc'] && $stavajici_zaznam->rc!=$udaje['rc'])
            {
                if($zaznam = $this->findByRc($udaje['rc']))
                {
                    throw new GException('Osoba se shodným rodným číslem je již v systému.');
                }
            }
            $this->getTable()->where('id', $osoba->id)->update($udaje);
            $zaznam['novy_mail'] = $novy_mail;
            $zaznam['akce'] = 'update';
            $zaznam['id'] = $osoba->id;
            return $zaznam;
        }
        else
        {
            if (!$csv && $osoba->rodne_cislo && $zaznam = $this->findByRc($osoba->rodne_cislo))
            {
                throw new GException('Osoba se shodným rodným číslem je již v systému.');
            }
            //je shodná trojice (jméno, příjmení, narození)?
            elseif ($zaznam = $this->findBy(array('jmeno' => $osoba->jmeno, 'prijmeni' => $osoba->prijmeni, 'narozeni' => $osoba->narozeni))->fetch())
            {
                //je admin?
                if ($admin)
                {
                    if (!$rezim)
                    {
                        $zaznam['dotaz'] = TRUE;
                    }
                    elseif ($rezim == 'I')
                    {
                        $zaznam = $this->novaOsoba($osoba);
                        if (isset($udaje['email']) && $udaje['email'] != '')
                        {
                            $novy_mail = TRUE;
                        }
                        $akce = 'insert';
                    }
                    else
                    {
                        if (isset($udaje['email']) && $udaje['email'] != '' && $this->getTable()->where('jmeno', $udaje['jmeno'])->where('prijmeni', $udaje['prijmeni'])
                                        ->where('narozeni', $udaje['narozeni'])->fetch()->email == '')
                        {
                            $novy_mail = TRUE;
                        }
                        $this->getTable()->where('jmeno', $udaje['jmeno'])->where('prijmeni', $udaje['prijmeni'])->where('narozeni', $udaje['narozeni'])->update($this->updateOsoby($osoba, $zaznam));
                        $zaznam = $this->getTable()->where('jmeno', $udaje['jmeno'])->where('prijmeni', $udaje['prijmeni'])->where('narozeni', $udaje['narozeni'])->fetch();
                        $akce = 'update';
                    }
                }
                else
                {
                    if (isset($udaje['email']) && $udaje['email'] != '' && $this->getTable()->where('jmeno', $udaje['jmeno'])->where('prijmeni', $udaje['prijmeni'])->where('narozeni', $udaje['narozeni'])->fetch()->email == '')
                    {
                        $novy_mail = TRUE;
                    }
                    if ($csv && $udaje['rc'])
                    {
                       $stavajici_zaznam=$this->getTable()->where('jmeno', $udaje['jmeno'])->where('prijmeni', $udaje['prijmeni'])->where('narozeni', $udaje['narozeni'])->fetch();
                       if($stavajici_zaznam['rc']!=$udaje['rc'])
                       {
                           if($this->findByRc($udaje['rc']))
                           {
                               throw new GException('Osoba se shodným rodným číslem je již v systému.');
                           }
                       }
                    }
                    $this->getTable()->where('jmeno', $udaje['jmeno'])->where('prijmeni', $udaje['prijmeni'])->where('narozeni', $udaje['narozeni'])->update($this->updateOsoby($osoba, $zaznam));
                    $zaznam = $this->getTable()->where('jmeno', $udaje['jmeno'])->where('prijmeni', $udaje['prijmeni'])->where('narozeni', $udaje['narozeni'])->fetch();
                    $akce = 'update';
                }
            }
            else
            {
                if($csv && $udaje['rc'])
                {
                    if($this->findByRc($udaje['rc']))
                    {
                        throw new GException('Osoba se shodným rodným číslem je již v systému');
                    }
                }
                $zaznam = $this->novaOsoba($osoba);
                if (isset($udaje['email']) && $udaje['email'] != '')
                {
                    $novy_mail = TRUE;
                }
                $akce = 'insert';
            }
        }


        $return = $zaznam;
        $return['akce'] = $akce;
        $return['novy_mail'] = $novy_mail;
        return $return;
    }

    /**
     * vrací údaje k aktualizaci osoby (pouze to, co je databázi zatím nevyplněné)
     * Volá se z ulozitOsobu()
     * @param type $osoba
     * @param type $zaznam
     * @return type
     */
    private function updateOsoby($osoba, $zaznam)
    {
        $udaje = $osoba->getUdajeUpdate();
        foreach ($zaznam as $nazev => $hodnota)
        {
            if ((!$hodnota instanceof NDateTime53) && ($hodnota == '' || $hodnota == 0))
            {
                if (isset($udaje[$nazev])) $update[$nazev] = $udaje[$nazev];
            }
        }
        return $update;
    }

    /**
     * Volá se z ulozitOsobu()
     * @param type $osoba
     * @return type
     */
    private function novaOsoba($osoba)
    {
        $zaznam = '';
        do
        {
            $udaje = $osoba->getUdaje();
            $udaje['id'] = $this->generovatIdOsoby();
            try
            {
                $zaznam = $this->getTable()->insert($udaje);
            }
            catch (PDOException $e)
            {
                
            }
        }
        while (!$zaznam);
        return $zaznam;
    }

    /**
     * Zkonrtoluje zda daný mail nemá více než 4 další osoby (TRUE = nemá, mail je volný, FALSE = má, mail je obsazený)
     * @param str $email
     * @return boolean 
     */
    public function zkontrolovatDostupnostMailu($email)
    {
        if ($this->getTable()->where('email', $email)->count() > 4)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    private function generovatIdOsoby()
    {
        return parent::generovatId(6);
    }

    public function smazatOsobu($id_osoby)
    {
        return $this->getTable()->where('id', $id_osoby)->update(array('platne' => 'N'));
    }

    public function obnovitOsobu($id_osoby)
    {
        return $this->getTable()->where('id', $id_osoby)->update(array('platne' => 'A'));
    }

    public function pocetOsob()
    {
        return $this->getTable()->select('COUNT(*) AS pocet')->fetch()->pocet;
    }

    /**
     * Najde osoby, které mají shodné jméno, příjmení a datum narození
     * @param Osoba $osoba
     */
    public function shodneOsoby(Osoba $osoba)
    {
        $return = array();
        $udaje = $osoba->getUdaje();
        foreach ($this->findBy(array('jmeno' => $udaje['jmeno'], 'prijmeni' => $udaje['prijmeni'], 'narozeni' => $udaje['narozeni'])) as $osoba)
        {
            $return[] = $osoba->id;
        }
        return $return;
    }

    /**
     * Seznam všech mailových adres v systému
     */
    public function mailoveAdresy()
    {
        return $this->getTable()->select('id, email')->where('email <>?', '')->order('id');
    }
    
    public function maxId()
    {
        return $this->getTable()->select('MAX(id) AS id')->fetch()->id;
    }
    
    public function setTrener($osoba, $trener)
    {
       return $this->getTable()->where('id', $osoba)->update(array('trener'=>$trener));
    }
    
    public function setPoznamka_prihlasky($osoba, $poznamka)
    {
        return $this->getTable()->where('id', $osoba)->update(array('poznamka_prihlasky'=>$poznamka));
    }
}

?>
