<?php

class Osoba extends NObject
{

    private $rodne_cislo;
    private $id;
    private $jmeno;
    private $prijmeni;
    private $rodne_prijmeni;
    private $titul;
    private $narozeni;
    private $pohlavi;
    private $cizinec;
    private $ulice;
    private $obec;
    private $psc;
    private $mobil;
    private $telefon;
    private $email;
    private $web;
    private $poznamka;
    public $error;
    public $poradi;
    public $trener;

    public function __construct($id = null)
    {

        if ($id)
        {
            $this->id = $id;
        }
    }

    public function setRodne_cislo($rodne_cislo)
    {

        $this->rodne_cislo = NStrings::replace($rodne_cislo, '~[ /]~', '');
    }

    public function setJmeno($jmeno)
    {
        $jmeno = NStrings::lower($jmeno);
        if (preg_match('~(.*) (.*)~', $jmeno, $tmp))
        {
            $this->jmeno = NStrings::firstUpper($tmp[1]) . ' ' . NStrings::firstUpper($tmp[2]);
        }
        else
        {
            $this->jmeno = NStrings::firstUpper($jmeno);
        }
    }

    public function setPrijmeni($prijmeni)
    {
        $prijmeni = NStrings::lower($prijmeni);
        if (preg_match('~(.*) (.*)~', $prijmeni, $tmp))
        {
            $this->prijmeni = NStrings::firstUpper($tmp[1]) . ' ' . NStrings::firstUpper($tmp[2]);
            ;
        }
        else
        {
            $this->prijmeni = NStrings::firstUpper($prijmeni);
        }
    }

    public function setRodnePrijmeni($rodne_prijmeni)
    {
        $prijmeni = NStrings::lower($rodne_prijmeni);
        if (preg_match('~(.*) (.*)~', $prijmeni, $tmp))
        {
            $this->rodne_prijmeni = NStrings::firstUpper($tmp[1]) . ' ' . NStrings::firstUpper($tmp[2]);
        }
        else
        {
            $this->rodne_prijmeni = NStrings::firstUpper($prijmeni);
        }
    }

    public function setNarozeni($narozeni)
    {
        if (preg_match('~([0-9]{1,2}).([0-9]{1,2}).([0-9]{4})~', $narozeni, $matches))
        {
            $rok = $matches[3];
            $den = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
            $mesic = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
        }
        elseif (preg_match('~(.*)-(.*)-(.*)~', $narozeni, $matches))
        {
            $rok = $matches[1];
            $mesic = $matches[2];
            $den = $matches[3];
        }
        else
        {
            return;
        }
        if (!checkdate($mesic, $den, $rok))
        {
            $this->error = 'Chybné datum narození!';
        }
        else
        {
            $this->narozeni = $rok . '-' . $mesic . '-' . $den;
        }
    }

    public function setCizinec($cizinec)
    {
        if ($cizinec === TRUE || $cizinec == 'A')
        {
            $this->cizinec = 'A';
        }
        elseif ($cizinec === FALSE || $cizinec == 'N')
        {
            $this->cizinec = 'N';
        }
        elseif ($cizinec === '')
        {
            $this->error = 'Není vyplnen údaj cizinec!';
        }
        else
        {
            $this->error = 'Chybné nastavení cizince!';
        }
    }

    public function setEmail($email)
    {
        if (Validace::kontrola_email($email))
        {
            $this->email = $email;
        }
        else
        {
            $this->error = 'Neplatný email!';
        }
    }

    public function setPsc($psc)
    {
        if (Validace::kontrola_psc($psc))
        {
            $this->psc = $psc;
        }
        else
        {
            $this->error = 'Neplatné PSČ!';
        }
    }

    public function setMobil($mobil)
    {
        if (Validace::kontrola_telefon($mobil))
        {
            $this->mobil = $mobil;
        }
        else
        {
            $this->error = 'Neplatný mobil!';
        }
    }

    public function setTelefon($telefon)
    {
        if (Validace::kontrola_telefon($telefon))
        {
            $this->telefon = $telefon;
        }
        else
        {
            $this->error = 'Neplatný telefon!';
        }
    }

    public function setWeb($web)
    {
        if (Validace::kontrola_web($web))
        {
            $this->web = $web;
        }
        else
        {
            $this->error = 'Neplatný web!';
        }
    }

    public function unsetEmail()
    {
        $this->email = '';
    }

    public function setUdaje($udaje, $kontrola = TRUE)
    {
        if (isset($udaje['jmeno'])) $this->setJmeno($udaje['jmeno']);
        if (isset($udaje['prijmeni'])) $this->setPrijmeni($udaje['prijmeni']);
        if (isset($udaje['rodne_prijmeni'])) $this->setRodnePrijmeni($udaje['rodne_prijmeni']);
        if (isset($udaje['titul'])) $this->titul = $udaje['titul'];
        if (isset($udaje['narozeni'])) $this->setNarozeni($udaje['narozeni']);
        if (isset($udaje['rc'])) $this->setRodne_cislo($udaje['rc']);
        if (isset($udaje['pohlavi'])) $this->pohlavi = $udaje['pohlavi'];
        if (isset($udaje['cizinec'])) $this->setCizinec($udaje['cizinec']);
        if (isset($udaje['ulice'])) $this->ulice = $udaje['ulice'];
        if (isset($udaje['obec'])) $this->obec = $udaje['obec'];
        if (isset($udaje['psc'])) $this->psc = $udaje['psc'];
        if (isset($udaje['mobil'])) $this->mobil = $udaje['mobil'];
        if (isset($udaje['telefon'])) $this->telefon = $udaje['telefon'];
        if (isset($udaje['email'])) $this->email = $udaje['email'];
        if (isset($udaje['web'])) $this->web = $udaje['web'];
        if (isset($udaje['poznamka'])) $this->poznamka = $udaje['poznamka'];
        if (isset($udaje['trener'])) $this->trener = $udaje['trener'];
        if (!$this->id || $kontrola)
        {
            $this->kontrola_osoby();
        }
    }

    public function getUdaje(array $udaje = null)
    {
        if ($udaje == null)
        {
            $return = array();
            if (isset($this->jmeno)) $return['jmeno'] = $this->jmeno;
            if (isset($this->prijmeni)) $return['prijmeni'] = $this->prijmeni;
            if (isset($this->rodne_prijmeni)) $return['rodne_prijmeni'] = $this->rodne_prijmeni;
            if (isset($this->titul)) $return['titul'] = $this->titul;
            if (isset($this->rodne_cislo)) $return['rc'] = $this->rodne_cislo;
            if (isset($this->titul)) $return['titul'] = $this->titul;
            if (isset($this->narozeni)) $return['narozeni'] = $this->narozeni;
            if (isset($this->ulice)) $return['ulice'] = $this->ulice;
            if (isset($this->obec)) $return['obec'] = $this->obec;
            if (isset($this->psc)) $return['psc'] = $this->psc;
            if (isset($this->mobil)) $return['mobil'] = $this->mobil;
            if (isset($this->telefon)) $return['telefon'] = $this->telefon;
            if (isset($this->email)) $return['email'] = $this->email;
            if (isset($this->web)) $return['web'] = $this->web;
            if (isset($this->pohlavi)) $return['pohlavi'] = $this->pohlavi;
            if (isset($this->cizinec)) $return['cizinec'] = $this->cizinec;
            if (isset($this->poznamka)) $return['poznamka'] = $this->poznamka;
            if (isset($this->trener)) $return['trener'] = $this->trener;
            if (isset($this->error)) $return['error'] = $this->error;

            return $return;
        }
    }

    public function getUdajeUpdate()
    {
        $return = array();
        if ($this->jmeno) $return['jmeno'] = $this->jmeno;
        if ($this->prijmeni) $return['prijmeni'] = $this->prijmeni;
        if (isset($this->rodne_prijmeni)) $return['rodne_prijmeni'] = $this->rodne_prijmeni;
        if ($this->titul) $return['titul'] = $this->titul;
        if ($this->rodne_cislo) $return['rc'] = $this->rodne_cislo;
        if ($this->titul) $return['titul'] = $this->titul;
        if ($this->narozeni) $return['narozeni'] = $this->narozeni;
        if ($this->ulice) $return['ulice'] = $this->ulice;
        if ($this->obec) $return['obec'] = $this->obec;
        if ($this->psc) $return['psc'] = $this->psc;
        if ($this->mobil) $return['mobil'] = $this->mobil;
        if ($this->telefon) $return['telefon'] = $this->telefon;
        if ($this->email) $return['email'] = $this->email;
        if ($this->web) $return['web'] = $this->web;
        if ($this->pohlavi) $return['pohlavi'] = $this->pohlavi;
        if ($this->cizinec) $return['cizinec'] = $this->cizinec;
        if ($this->poznamka) $return['poznamka'] = $this->poznamka;
        if (isset($this->error)) $return['error'] = $this->error;
        return $return;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRodne_cislo()
    {
        return $this->rodne_cislo;
    }

    public function getJmeno()
    {
        return $this->jmeno;
    }

    public function getPrijmeni()
    {
        return $this->prijmeni;
    }
    
    public function getRodnePrijmeni()
    {
        return $this->rodne_prijmeni;
    }

    public function getNarozeni()
    {
        return $this->narozeni;
    }

    public function getEmail()
    {
        return $this->email;
    }

    private function kontrola_osoby()
    {
        unset($this->error);
        if ($this->jmeno == ''):
            $this->error = 'Chybí jméno!';
            return false;
        endif;
        if ($this->prijmeni == ''):
            $this->error = 'Chybí příjmení!';
            return false;
        endif;
        if ($this->narozeni <> '' && $this->narozeni <> '0000-00-00' && (!ereg('[0-9]{4}\-[0-9]{2}\-[0-9]{2}', $this->narozeni) || !checkdate(substr($this->narozeni, 5, 2), substr($this->narozeni, 8, 2), substr($this->narozeni, 0, 4)))):
            $this->error = 'Chybné datum narození!';
            return false;
        endif;
        if (!in_array($this->pohlavi, array('', 'M', 'Z'))):
            $this->error = 'Chybné nastavení pohlaví!';
            return false;
        endif;
        if (!in_array($this->cizinec, array('', 'A', 'N'))):
            $this->error = 'Chybné nastavení cizince!';
            return false;
        endif;
        if ($this->rodne_cislo <> ''): // rodne cislo je zadano
            if (!Validace::kontrola_rc($this->rodne_cislo)):
                $this->error = 'Neplatné rodné číslo!';
                return false;
            endif;
            $narozeni = $this->rc2date($this->rodne_cislo);
            if ($this->narozeni == '' || $this->narozeni == '0000-00-00'):
                $this->narozeni = $narozeni;
            elseif ($this->narozeni <> $narozeni):
                $this->error = 'Nesouhlasí datum narození s rodným číslem!';
                return false;
            endif;
            $pohlavi = substr($this->rodne_cislo, 2, 1) >= '5' ? 'Z' : 'M';
            if ($this->pohlavi == ''):
                $this->pohlavi = $pohlavi;
            elseif ($this->pohlavi <> $pohlavi):
                $this->error = 'Nesouhlasí zadané pohlaví s rodným číslem!';
                return false;
            endif;
            $cizinec = 'N';
            if ($this->cizinec == ''):
                $this->cizinec = $cizinec;
            elseif ($this->cizinec <> $cizinec):
                $this->error = 'Cizinec nemůže mít rodné číslo!';
                return false;
            endif;
        endif;
        if ($this->narozeni == ''):
            $this->error = 'Chybí datum narození!';
            return false;
        endif;
        if ($this->pohlavi == ''):
            $this->error = 'Není vyplněno pohlaví!';
            return false;
        endif;
        if ($this->cizinec === ''):
            $this->error = 'Není vyplněn údaj cizince!';
            return false;
        endif;
        return true;
    }

    private function rc2date($rc)
    {
        if (!preg_match('#^(\d\d)(\d\d)(\d\d)[ /]?(\d\d\d)(\d?)$#', $rc, $matches)) return FALSE;
        list(, $year, $month, $day, $ext, $c) = $matches;
        if ($c === '')
        {
            if ($year >= 54) return FALSE;
            $year += 1900;
            if ($month > 50) $month -= 50;
            if (!checkdate($month, $day, $year)) return FALSE;
            if (strlen($month) < 2) $month = "0" . $month;
            if (strlen($day) < 2) $day = "0" . $day;
            return "$year-$month-$day";
        }
        $year += $year < 54 ? 2000 : 1900;
        if ($month > 70 && $year > 2003) $month -= 70;
        elseif ($month > 50) $month -= 50;
        elseif ($month > 20 && $year > 2003) $month -= 20;
// kontrola budoucnosti a platnosti datumu
        if ("$year$month$day" > Date('Ymd')) return FALSE;
        if (!checkdate($month, $day, $year)) return FALSE;
        if (strlen($month) < 2) $month = "0" . $month;
        if (strlen($day) < 2) $day = "0" . $day;
        return "$year-$month-$day";
    }

}

?>
