<?
/*
DEFINICE KONSTANT
odvetvi (SG,OS,...)
funkce (E,Z,T,R,...) evidence, zavodnik, trener
*/

function prava($modul,$subint='*',$osoba='*') {
// jako default subintu dat parametr subint z URL
// jako default osoby dat to definici funkce toho, kdo je prihlasenej
//echo "DEBUG: $subint<br>";
if ($subint!=='*') $subint_sql=" AND subint='$subint'";
if ($osoba==='*') $osoba=13740;
//echo "DEBUG: subint=$subint osoba=$osoba<br>";
$tmp=MySQL_Query("SELECT * FROM prava WHERE modul='$modul' AND (osoba=0 OR osoba='$osoba') $subint_sql ORDER BY uroven DESC LIMIT 1");
if ($zaznam=MySQL_Fetch_Assoc($tmp)) return $zaznam[uroven];
   else return 0;
}

function kontrola_rc($rc) {
if (!preg_match('#^(\d\d)(\d\d)(\d\d)[ /]?(\d\d\d)(\d?)$#', $rc, $matches)) return FALSE;
list(, $year, $month, $day, $ext, $c) = $matches;
// devítimístná RČ nelze ověřit
if ($c === '') {
    if ($year>=54) return FALSE;
    $year += 1900;
    if ($month>50) $month -= 50;
    return checkdate($month, $day, $year);
    }
// kontrolní číslice
$mod = ($year . $month . $day . $ext) % 11;
if ($mod === 10) $mod = 0;
if ($mod !== (int) $c) return FALSE;
// kontrola data
$year += $year < 54 ? 2000 : 1900;
// k měsíci může být připočteno 20, 50 nebo 70
if ($month > 70 && $year > 2003) $month -= 70;
  elseif ($month > 50) $month -= 50;
  elseif ($month > 20 && $year > 2003) $month -= 20;
// kontrola budoucnosti a platnosti datumu
if ("$year$month$day">Date('Ymd')) return FALSE;
return checkdate($month, $day, $year);
}

function rc2date($rc) {
if (!preg_match('#^(\d\d)(\d\d)(\d\d)[ /]?(\d\d\d)(\d?)$#', $rc, $matches)) return FALSE;
list(, $year, $month, $day, $ext, $c) = $matches;
if ($c === '') {
    if ($year>=54) return FALSE;
    $year += 1900;
    if ($month>50) $month -= 50;
    if (!checkdate($month, $day, $year)) return FALSE;
    if (strlen($month)<2) $month="0".$month;
    if (strlen($day)<2) $day="0".$day;
    return "$year-$month-$day";
    }
$year += $year < 54 ? 2000 : 1900;
if ($month > 70 && $year > 2003) $month -= 70;
  elseif ($month > 50) $month -= 50;
  elseif ($month > 20 && $year > 2003) $month -= 20;
// kontrola budoucnosti a platnosti datumu
if ("$year$month$day">Date('Ymd')) return FALSE;
if (!checkdate($month, $day, $year)) return FALSE;
if (strlen($month)<2) $month="0".$month;
if (strlen($day)<2) $day="0".$day;
return "$year-$month-$day";
}

function kontrola_osoby(&$osoba) {
unset($osoba[error]);
if ($osoba[jmeno]==''):
   $osoba[error]='Chybí jméno!';
   return false;
   endif;
if ($osoba[prijmeni]==''):
   $osoba[error]='Chybí příjmení!';
   return false;
   endif;
if ($osoba[narozeni]<>'' && $osoba[narozeni]<>'0000-00-00' && (!ereg('[0-9]{4}\-[0-9]{2}\-[0-9]{2}',$osoba[narozeni]) || !checkdate(substr($osoba[narozeni],5,2),substr($osoba[narozeni],8,2),substr($osoba[narozeni],0,4)))):
   $osoba[error]='Chybné datum narození!';
   return false;
   endif;
if (!in_array($osoba[pohlavi],array('','M','Z'))):
   $osoba[error]='Chybné nastavení pohlaví!';
   return false;
   endif;
if (!in_array($osoba[cizinec],array('','A','N'))):
   $osoba[error]='Chybné nastavení cizince!';
   return false;
   endif;
if ($osoba[rc]<>''): // rodne cislo je zadano
   if (!kontrola_rc($osoba[rc])):
      $osoba[error]='Neplatné rodné číslo!';
      return false;
      endif;
   $narozeni=rc2date($osoba[rc]);
   if ($osoba[narozeni]=='' || $osoba[narozeni]=='0000-00-00'):
      $osoba[narozeni]=$narozeni;
     elseif ($osoba[narozeni]<>$narozeni):
      $osoba[error]='Nesouhlasí datum narození s rodným číslem!';
      return false;
      endif;
   $pohlavi=substr($osoba[rc],2,1)>='5' ? 'Z':'M';
   if ($osoba[pohlavi]==''):
      $osoba[pohlavi]= $pohlavi;
     elseif ($osoba[pohlavi]<>$pohlavi):
      $osoba[error]='Nesouhlasí zadané pohlaví s rodným číslem!';
      return false;
      endif;
   $cizinec='N';
   if ($osoba[cizinec]==''):
      $osoba[cizinec]= $cizinec;
     elseif ($osoba[cizinec]<>$cizinec):
      $osoba[error]='Cizinec nemůže mít rodné číslo!';
      return false;
      endif;
   endif;
if ($osoba[narozeni]==''):
   $osoba[error]='Chybí datum narození!';
   return false;
   endif;
if ($osoba[pohlavi]==''):
   $osoba[error]='Není vyplněno pohlaví!';
   return false;
   endif;
if ($osoba[cizinec]==''):
   $osoba[error]='Není vyplněno údaj cizince!';
   return false;
   endif;
return true;
}

function kontrola_jmena($jmeno) {
// pozor na mala a velka pismena !!!
global $jmena;
if (!is_array($jmena)):
   $jmena=@file('../libs/jmena.txt'); // cache
   foreach ($jmena as $key=>$val) $jmena[$key]=trim($val);
   endif;
//if (in_array($jmeno,$jmena)) return true;
foreach ($jmena as $val) if (ereg($val,$jmeno)) return true;
return false;
}

function import_csv($radky) {
if (is_array($radky))
   foreach ($radky as $radek=>$line) {
      $items=explode(';',$line);
      if (is_array($items))
         foreach ($items as $sloupec=>$val) {
            if (ereg('^".*"$',$val)) $val=substr($val,1,-1);
            $val=trim($val);
            if (ereg('^[aAnN]$',$val)): // test 1 cizinec
               $rr[$radek][1]++;
               $tt[1][$sloupec]++;
               continue;
               endif;
            if (ereg('^[mMzZžŽ]$',$val)): // test 2 pohlavi 
               $rr[$radek][2]++;
               $tt[2][$sloupec]++;
               continue;
               endif;
            if (ereg('^[ 0123]?[0-9]\.[ 01]?[0-9]\.[12][0-9]{3}$',$val)): // test 3 datum
               $rr[$radek][3]++;
               $tt[3][$sloupec]++;
               continue;
               endif;
            if (kontrola_rc($val)): // test 4 rodne cislo
               $rr[$radek][4]++;
               $tt[4][$sloupec]++;
               continue;
               endif;
            if (ereg('^[67][0-9]{2} ?[0-9]{3} ?[0-9]{3}$',$val)): // test 5 mobil
               $rr[$radek][5]++;
               $tt[5][$sloupec]++;
               continue;
               endif;
            if (ereg('^[23459][0-9]{2} ?[0-9]{3} ?[0-9]{3}$',$val)): // test 6 telefon
               $rr[$radek][6]++;
               $tt[6][$sloupec]++;
               continue;
               endif;
            if (ereg('^[0-9]+$',$val)): // test 7 cislo
               $rr[$radek][7]++;
               $tt[7][$sloupec]++;
               continue;
               endif;
            if (ereg('@',$val)): // test 8 email
               $rr[$radek][8]++;
               $tt[8][$sloupec]++;
               continue;
               endif;
            if (kontrola_jmena($val)): // test 9 jmeno, pozor na mala/velka pismena
               $rr[$radek][9]++;
               $tt[9][$sloupec]++;
               continue;
               endif;
            if (ereg('^[^0-9_\.,()@]+$',$val)): // test 10 prijmeni
               $rr[$radek][10]++;
               $tt[10][$sloupec]++;
               continue;
               endif;
            }
     }
     
if (is_array($tt)) // vyhledani vyznamu sloupcu do $testy
   foreach ($tt as $test=>$results) {
      $max=0; $sloupec=999;
      if (is_array($results))
         foreach ($results as $key=>$val)
            if ($val>$max):
               $max=$val;
               $sloupec=$key;
               endif;
      if ($max>=3 && $sloupec<>999) $testy[$test]=$sloupec;
      }
if (!isset($testy[9])) unset($testy[10]);
if (!isset($testy[10])) unset($testy[9]);
if (abs($testy[9]-$testy[10])<>1): // jmeno a prijmeni musi byt u sebe
   unset($testy[9]);
   unset($testy[10]);
   endif;
$radek=0;
while  (isset($radky[$radek]) && count($rr[$radek])<3) $radek++; // preskoc uvodni radky
while  (isset($radky[$radek]) && count($rr[$radek])>1): // zpracuj radky s obsahem
   $items=explode(';',$radky[$radek]);
   if (is_array($items))
      foreach ($items as $sloupec=>$val) {
          if (ereg('^".*"$',$val)) $val=substr($val,1,-1);
          $items[$sloupec]=trim($val);
          }
   unset($osoba);
   if (!isset($testy[1])) $osoba[cizinec]='N';
   $osoba[cizinec]=$items[$testy[1]];
   $osoba[pohlavi]=$items[$testy[2]];
   if (ereg('^[ 0123]?[0-9]\.[ 01]?[0-9]\.[12][0-9]{3}$',$items[$testy[3]])):
      $d=explode('.',$items[$testy[3]]);
      $osoba[narozeni]=sprintf("%04d-%02d-%02d", $d[2], $d[1], $d[0]);
      endif;
   $osoba[rc]=$items[$testy[4]];
   if (ereg('^[67][0-9]{2} ?[0-9]{3} ?[0-9]{3}$',$items[$testy[5]])) $osoba[mobil]=$items[$testy[5]];
   if (ereg('^[23459][0-9]{2} ?[0-9]{3} ?[0-9]{3}$',$items[$testy[6]])) $osoba[telefon]=$items[$testy[6]];
   $osoba[id]=$items[$testy[7]]; // neni ID ale poradove cislo
   if (ereg('@',$items[$testy[8]])) $osoba[email]=$items[$testy[8]];
   if (ereg('^[^0-9_\.,()@]+$',$items[$testy[9]])) $osoba[jmeno]=$items[$testy[9]];
   if (ereg('^[^0-9_\.,()@]+$',$items[$testy[10]])) $osoba[prijmeni]=$items[$testy[10]];
   kontrola_osoby($osoba);
   $osoby[]=$osoba;
   $radek++;
   endwhile;
return $osoby;
}


?>
