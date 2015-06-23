<?php

class Validace extends NObject
{

    static function kontrola_rc($rc)
    {
        if (!preg_match('#^(\d\d)(\d\d)(\d\d)[ /]?(\d\d\d)(\d?)$#', $rc, $matches))
            return FALSE;
        list(, $year, $month, $day, $ext, $c) = $matches;
// dev�tim�stn� R� nelze ov��it
        if ($c === '')
        {
            if ($year >= 54)
                return FALSE;
            $year += 1900;
            if ($month > 50)
                $month -= 50;
            return checkdate($month, $day, $year);
        }
// kontroln� ��slice
        $mod = ($year . $month . $day . $ext) % 11;
        if ($mod === 10)
            $mod = 0;
        if ($mod !== (int) $c)
            return FALSE;
// kontrola data
        $year += $year < 54 ? 2000 : 1900;
// k m�s�ci m�e b�t p�ipo�teno 20, 50 nebo 70
        if ($month > 70 && $year > 2003)
            $month -= 70;
        elseif ($month > 50)
            $month -= 50;
        elseif ($month > 20 && $year > 2003)
            $month -= 20;
// kontrola budoucnosti a platnosti datumu
        if ("$year$month$day" > Date('Ymd'))
            return FALSE;
        return checkdate($month, $day, $year);
    }
    
    static function kontrola_psc($psc)
    {
        if(preg_match('~[0-9]{3}[ ]*[0-9]{2}~', $psc))
        {
            return TRUE;
        }
        return FALSE;
    }
  
    
    static function kontrola_telefon($telefon)
    {
        if(preg_match('~^((\+)|(0{2})[ 0-9]+|[2-9][0-9]{2} ?([0-9]{3} ?[0-9]{3}|[0-9]{2} ?[0-9]{2} ?[0-9]{2}))$~', $telefon))
        {
            return TRUE;
        }
        return FALSE;
    }
    
    static function kontrola_email($email)
    {
        return NValidators::isEmail($email);
    }
    
    static function kontrola_web($web)
    {
        return NValidators::isUrl($web);
    }
    
   
    
}

?>
