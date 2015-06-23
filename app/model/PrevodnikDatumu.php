<?php

class PrevodnikDatumu
{
    static function prevestDatumNaAnglicke($ceske_datum)
    {
        if (preg_match('~([0-9]{1,2}).([0-9]{1,2}).([0-9]{4})~', $ceske_datum, $matches))
        {
            $rok = $matches[3];
            $den = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
            $mesic = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
        }
        elseif (preg_match('~(.*)-(.*)-(.*)~', $ceske_datum, $matches))
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
            return FALSE;
        }
        else
        {
            return $rok . '-' . $mesic . '-' . $den;
        }
    }
    
    static function zkontrolovatCas($cas)
    {
        if(preg_match('~(([0-1][0-9])|(2[0-3])|([0-9])):([0-5][0-9])~', $cas)) return TRUE;
        return FALSE;                
    }
    
}

?>
