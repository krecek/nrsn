<?
// Import dat z predchoziho systemu
// Version 1.05
// Date 2013-08-29

define ('AUTH_DB_HOST', 'sql.satoya.cz'); // kde bezi MySQL server
define ('AUTH_DB_USER', 'gymfed_demo'); // uzivatelske jmeno
define ('AUTH_DB_PASS', 'HuuJNUw6GpjMjqfx'); // uzivatelske heslo
//define ('AUTH_DB_USER', 'gymfed'); // ostry uzivatel
//define ('AUTH_DB_PASS', 'PxPSXn2G7dB5bCwZ'); // ostre heslo
define ('AUTH_DB_NAME', AUTH_DB_USER); // jmeno databaze (casto jako uzivatel)
define ('AUTH_DB_CODEPAGE', 'UTF8'); // kodova stranka spojeni

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'."\n";
@MySQL_Connect (AUTH_DB_HOST,AUTH_DB_USER,AUTH_DB_PASS) or die ("Autorizacni modul se nemuze pripojit k databazi");
if (defined('AUTH_DB_NAME')) @MySQL_Select_DB(AUTH_DB_NAME) or die ("Autorizacni modul nenasel databazi");
if (defined('AUTH_DB_CODEPAGE')) @MySQL_Query("SET NAMES '".AUTH_DB_CODEPAGE."'") or die("Nelze nastavit znakovou sadu databaze");
echo date("H:i:s")." připojení k databázi<br>\n";

include "lib.php";

switch ($_GET[action]):

case "osoby_create":
$query="DROP TABLE IF EXISTS osoby";
MySQL_Query($query) or die("nepovedlo se smazat osoby");
$query="CREATE TABLE osoby (
  `id` int(6) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `titul` varchar(20) NOT NULL,
  `jmeno` varchar(20) NOT NULL,
  `prijmeni` varchar(30) NOT NULL,
  `rc` varchar(10) NOT NULL,
  `narozeni` date NOT NULL,
  `pohlavi` enum('M','Z') NOT NULL,
  `cizinec` enum('A','N') NOT NULL default 'N',
  `ulice` varchar(30) NOT NULL,
  `obec` varchar(30) NOT NULL,
  `psc` varchar(6) NOT NULL,
  `mobil` varchar(20) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `email` TINYTEXT NOT NULL,
  `web` TINYTEXT NOT NULL,
  `platne` enum('A','N') NOT NULL default 'A',
  PRIMARY KEY (`id`),
  KEY `platne` (`platne`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Seznam osob'
  ";
MySQL_Query($query) or die("nepovedlo se založit tabulku osoby");
echo date("H:i:s")." tabulka osoby úspěšně založena<br>\n";
break;

case "osoby_import":
$count=0;
/*
$res=MySQL_Query("SELECT * FROM fox2_regosoba");
while ($osoba=MySQL_Fetch_Assoc($res)):
   $osoba[i_jmeno]=AddSlashes($osoba[i_jmeno]);
   $osoba[i_prijmeni]=AddSlashes($osoba[i_prijm]);
   $osoba[i_obec]=AddSlashes($osoba[i_obec]);
   if (!kontrola_rc($osoba[i_rc])) echo "chybné RČ $osoba[i_rc] $osoba[i_prijmeni] ($osoba[reg_na])<br>\n";
   $count++;
   $osoba[narozeni]=rc2date($osoba[i_rc]);
   if (substr($osoba[i_rc],2,1)>='5') $osoba[pohlavi]='Z';
                                 else $osoba[pohlavi]='M';
   if ($osoba[i_rc]=='440609074') $osoba[pohlavi]='Z'; // Vejrkova ma RC muze!
   do {
      $unique=mt_rand(100001,999999);
      $query="INSERT INTO osoby SET id='$unique', jmeno='$osoba[i_jmeno]', prijmeni='$osoba[i_prijmeni]', rc='$osoba[i_rc]', pohlavi='$osoba[pohlavi]', ulice='$osoba[i_ulice]', obec='$osoba[i_obec]', psc='$osoba[i_psc]', mobil='$osoba[i_telm]', telefon='$osoba[i_telz]', email='$osoba[i_email]'";
      $result=MySQL_Query($query);
      if (!$result) echo "záznam #$oddil[id] se nevložil $query SQL: ".MySQL_Error()."<br>\n";
      } while (!$result);   
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." tabulka naplněna individuálními registracemi ($count záznamů)<br>\n";
$count=0;
$res=MySQL_Query("SELECT * FROM fox2_regzavod");
while ($osoba=MySQL_Fetch_Assoc($res)):
   $count++;
   $osoba[jmeno]=AddSlashes($osoba[jmeno]);
   $osoba[prijmeni]=AddSlashes($osoba[prijmeni]);
   if ($osoba[cizinec]=='1') $osoba[cizinec]='A';
                        else $osoba[cizinec]='N'; 
   if ($osoba[zena]=='1') $osoba[pohlavi]='Z';
                      else $osoba[pohlavi]='M'; 
   do {
      $unique=mt_rand(100001,999999);
      $query="INSERT INTO osoby SET id='$unique', jmeno='$osoba[jmeno]', prijmeni='$osoba[prijmeni]', rc='$osoba[rc]', pohlavi='$osoba[pohlavi]', cizinec='$osoba[cizinec]'";
      $result=MySQL_Query($query);
      if (!$result) echo "záznam #$oddil[id] se nevložil $query SQL: ".MySQL_Error()."<br>\n";
      } while (!$result);   
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." tabulka naplněna registrovanými závodnicemi ($count záznamů)<br>\n";
$query="UPDATE osoby SET id=111111, username='jana', password='f854d301c6cce8f6ff2dea0a62d0781a', pohlavi='Z' WHERE rc='8456290029'";
MySQL_Query($query) or die("nepovedlo se Janě přidat logovací údaje");
$query="INSERT INTO osoby SET id=222222, username='sritter', password='63a1b487561bb0cfbd5df4d17889d5cc', prijmeni='Šritter', jmeno='Jan', rc='6711191553', pohlavi='M'";
MySQL_Query($query) or die("nepovedlo se přidat Honzu");
$query="INSERT INTO osoby SET id=333333, username='churavy', password='63a1b487561bb0cfbd5df4d17889d5cc', prijmeni='Churavý', jmeno='Vratislav', rc='490609334', pohlavi='M'";
MySQL_Query($query) or die("nepovedlo se přidat Honzu");
*/
$query="INSERT INTO osoby SET id=658251, username='kousal', password='313cf4f089b96d7ab4ffd7c33030afc1', prijmeni='Kousal', jmeno='Peter', narozeni='1965-01-27', pohlavi='M', cizinec='N'";
MySQL_Query($query) or die("nepovedlo se přidat Petera");
echo date("H:i:s")." tabulka naplněna VIP osobami<br>\n";
break;

case "osoby_check":
$count=0;
$res=MySQL_Query("SELECT * FROM osoby");
while ($osoba=MySQL_Fetch_Assoc($res)):
   if (!kontrola_osoby($osoba)):
      $count++;
      echo "#$osoba[id] $osoba[jmeno] $osoba[prijmeni] $osoba[error]<br>\n";
      // MySQL_Query("UPDATE osoby SET rc='', poznamka='$osoba[error]' WHERE id=$osoba[id]");
      endif;
   endwhile;
echo date("H:i:s")." nalezeno $count osob s chybnými údaji<br>\n";
/*
$count=0;
$res=MySQL_Query("SELECT *,count(*) as count FROM osoby GROUP BY rc HAVING count>1");
while ($osoba=MySQL_Fetch_Assoc($res)):
   $count++;
   echo "záznam $osoba[rc] $osoba[prijmeni] je duplicitní ($osoba[count])<br>\n";
   MySQL_Query("DELETE FROM osoby WHERE rc='$osoba[rc]' AND ulice='' LIMIT 1");
   endwhile;
echo date("H:i:s")." odstraněno $count duplicitních osob<br>\n";

$res=MySQL_Query("SELECT * FROM osoby");
while ($osoba=MySQL_Fetch_Assoc($res)):
   $datum=rc2date($osoba[rc]);
   if ($datum) MySQL_Query("UPDATE osoby SET narozeni='$datum' WHERE id='$osoba[id]'");
          else echo "záznam $osoba[rc] $osoba[prijmeni] nelze určit datum z RČ<br>\n";
   endwhile;
*/
echo date("H:i:s")." vypočteny datumy<br>\n";

/*
$res=MySQL_Query("SELECT * FROM osoby");
while ($osoba=MySQL_Fetch_Assoc($res)):
   if ($osoba[jmeno]<>trim($osoba[jmeno])) echo "záznam #$osoba[rc] obsahuje bílé znaky ve jméně<br>\n";
   if ($osoba[prijmeni]<>trim($osoba[prijmeni])) echo "záznam #$osoba[rc] obsahuje bílé znaky v příjmení<br>\n";
   if (!kontrola_rc($osoba[rc])):
      $count++;
      echo "záznam $osoba[jmeno] $osoba[prijmeni] obsahuje chybné RC $osoba[rc] <br>\n";
      endif;
   $year=substr($osoba[rc],0,2);
   $year += $year < 54 ? 2000 : 1900;
   if (strlen($osoba[rc])==9) $year= 1900 + substr($osoba[rc],0,2);
   $month=substr($osoba[rc],2,2);
   $day=substr($osoba[rc],4,2);
   if ($month > 70 && $year > 2003) $month -= 70;
     elseif ($month > 50) $month -= 50;
     elseif ($month > 20 && $year > 2003) $month -= 20;
   $query="UPDATE osoby SET narozeni='$year-$month-$day' WHERE id='$osoba[id]'";
   MySQL_Query($query) or die("nepovedlo se zapsat datum");
   endwhile;
*/
echo date("H:i:s")." tabulka prošla kontrolou<br>\n";
break;

case "osoby_view":
$count=0;
$res=MySQL_Query("SELECT * FROM osoby ORDER BY id");
while ($record=MySQL_Fetch_Assoc($res)):
   $count++;
   echo "$record[id] $record[jmeno] $record[prijmeni] ($record[rc])<br>\n";
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." nalezeno $count zaznamu<br>\n";
break;

case "oddily_create":
$query="DROP TABLE IF EXISTS oddily";
MySQL_Query($query) or die("nepovedlo se smazat oddily");
$query="CREATE TABLE oddily (
  `id` smallint(4) unsigned NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `doplnek` varchar(30) NOT NULL,
  `ulice` varchar(30) NOT NULL,
  `obec` varchar(30) NOT NULL,
  `psc` varchar(6) NOT NULL,
  `mobil` varchar(20) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `web` varchar(80) NOT NULL,
  `ic` int(8) unsigned zerofill NOT NULL,
  `banka` varchar(30) NOT NULL,
  `vs` int(10) unsigned NOT NULL,
  `regmv` varchar(20) NOT NULL,
  `fox_id` varchar(3) NOT NULL,
  `fox_kod` varchar(8) NOT NULL,
  `platne` enum('A','N') NOT NULL default 'A',
  PRIMARY KEY (`id`),
  KEY `platne` (`platne`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Seznam oddilu'
  ";
MySQL_Query($query) or die("nepovedlo se založit tabulku oddily");
echo date("H:i:s")." tabulka oddíly úspěšně založena<br>\n";
break;

case "oddily_import":
MySQL_Query("INSERT INTO oddily SET id='1000', nazev='individuální členové'"); // individualni clenove
$count=1;
$res=MySQL_Query("SELECT * FROM fox2_regoddil");
while ($oddil=MySQL_Fetch_Assoc($res)):
   $count++;
   if ($oddil[oddil]<>AddSlashes($oddil[oddil])) echo "záznam #$oddil[id] obsahuje neplatné znaky v názvu oddílu<br>";
   do {
      $unique=mt_rand(1001,9999);
      $query="INSERT INTO oddily SET id='$unique', nazev='$oddil[oddil]', doplnek='$oddil[o_dopadr]', ulice='$oddil[o_ulice]', obec='$oddil[o_obec]', psc='$oddil[o_psc]', mobil='$oddil[o_tel1]', telefon='$oddil[o_tel2]', email='$oddil[o_email1]', web='$oddil[o_www]', ic='$oddil[ic]', banka='$oddil[banka]', vs='$oddil[var_sym]', regmv='$oddil[regmv]', fox_id='$oddil[id]', fox_kod='$oddil[kod]'";
      $result=MySQL_Query($query);
      if (!$result) echo "záznam #$oddil[id] se nevložil SQL: ".MySQL_Error()."<br>\n";
      } while (!$result);   
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." tabulka oddíly úspěšně naplněna ($count záznamů)<br>\n";
break;

case "oddily_check":
$res=MySQL_Query("SELECT nazev,count(*) as count FROM oddily WHERE platne='A' GROUP BY nazev HAVING count>1");
while ($record=MySQL_Fetch_Assoc($res)) echo "DUPLICITY nazev=$record[nazev] $record[count]<br>\n";
MySQL_Free_Result($res);
$res=MySQL_Query("SELECT fox_id,count(*) as count FROM oddily WHERE fox_id<>'' GROUP BY fox_id HAVING count>1");
while ($record=MySQL_Fetch_Assoc($res)) echo "DUPLICITY fox_id=$record[fox_id] $record[count]<br>\n";
MySQL_Free_Result($res);
$res=MySQL_Query("SELECT ic,count(*) as count FROM oddily WHERE ic<>00000000 GROUP BY ic HAVING count>1");
while ($record=MySQL_Fetch_Assoc($res)) echo "DUPLICITY ic=$record[ic] $record[count]<br>\n";
MySQL_Free_Result($res);
$res=MySQL_Query("SELECT banka,count(*) as count FROM oddily WHERE banka<>'' GROUP BY banka HAVING count>1");
while ($record=MySQL_Fetch_Assoc($res)) echo "DUPLICITY banka=$record[banka] $record[count]<br>\n";
MySQL_Free_Result($res);
echo date("H:i:s")." tabulka oddíly prošla kontrolou<br>\n";
break;

case "oddily_view":
$count=0;
$res=MySQL_Query("SELECT * FROM oddily ORDER BY id");
while ($record=MySQL_Fetch_Assoc($res)):
   $count++;
   echo "$record[id] $record[nazev] $record[sporty]<br>\n";
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." nalezeno $count zaznamu<br>\n";
break;

case "prava_create":
$query="DROP TABLE IF EXISTS prava";
MySQL_Query($query) or die("nepovedlo se smazat prava");
$query="CREATE TABLE prava (
  `id` int(11) unsigned NOT NULL auto_increment,
  `modul` varchar(30) NOT NULL,
  `subint` mediumint(8) unsigned NOT NULL default '0',
  `osoba` mediumint(8) unsigned NOT NULL,
  `uroven` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `modul` (`modul`),
  KEY `subint` (`subint`),
  KEY `osoba` (`osoba`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Prava uzivatelu' AUTO_INCREMENT=1 ;
  ";
MySQL_Query($query) or die("nepovedlo se založit tabulku oddily");
echo date("H:i:s")." tabulka práva úspěšně založena<br>\n";
break;

case "prava_import":
$query="INSERT INTO prava SET modul='OSOBY', subint=0, osoba=111111, uroven=8";
MySQL_Query($query) or die("nepovedlo se vložit práva");
$query="INSERT INTO prava SET modul='ODDILY', subint=0, osoba=111111, uroven=8";
MySQL_Query($query) or die("nepovedlo se vložit práva");
$query="INSERT INTO prava SET modul='OSOBY', subint=0, osoba=0, uroven=1";
MySQL_Query($query) or die("nepovedlo se vložit práva");
echo date("H:i:s")." tabulka práva naplněna základními právy<br>\n";
break;

case "prava_test":
echo date("H:i:s")." přístup do modulu ODDILY: ".prava('ODDILY')." <br>\n"; // smim do modulu?
echo date("H:i:s")." globální úroveň ODDILY: ".prava('ODDILY',0)." <br>\n"; // jsem admin?
echo date("H:i:s")." subint 1 úroveň ODDILY: ".prava('ODDILY',1111)." <br>\n"; // uzivatel oddilu 111 ?
echo date("H:i:s")." ODDILY pro Janu: ".prava('ODDILY',111111,1111)." <br>\n";
echo date("H:i:s")." tabulka práva úspěšně prošla kontrolou<br>\n";
break;

case "evidence_create":
$query="DROP TABLE IF EXISTS evidence";
MySQL_Query($query) or die("nepovedlo se smazat evidence");
$query="CREATE TABLE evidence (
  `id` int(11) unsigned NOT NULL auto_increment,
  `osoba` int(6) NOT NULL,
  `oddil` smallint(4) NOT NULL,
  `od` date NOT NULL,
  `do` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `osoba` (`osoba`),
  KEY `oddil` (`oddil`),
  KEY `od` (`od`),
  KEY `do` (`do`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Evidence osob' AUTO_INCREMENT=1 ;
  ";
MySQL_Query($query) or die("nepovedlo se založit tabulku evidence");
echo date("H:i:s")." tabulka evidence úspěšně založena<br>\n";
break;

case "evidence_import":
$count=0;
$res=MySQL_Query("SELECT * FROM fox2_regosoba WHERE i_rc<>''");
while ($reg=MySQL_Fetch_Assoc($res)):
   $count++;
//   echo "$reg[i_rc] $reg[i_prijmeni] $reg[reg_na]<br>\n";
   $x=MySQL_Query("SELECT * FROM osoby WHERE rc='$reg[i_rc]'");
   if (MySQL_Num_Rows($x)<>1):
      MySQL_Free_Result($x);
      echo "rodne cislo $reg[rc] nenalezeno<br>\n";
      continue;
     else:
      $osoba=MySQL_Fetch_Assoc($x);
      MySQL_Free_Result($x);
      endif;
   $query="INSERT INTO evidence SET osoba='$osoba[id]', oddil=1000, od='$reg[reg_na]-01-01', do='$reg[reg_na]-12-31'";
   $tmp=MySQL_Query($query);
   if (!$tmp) echo "záznam se nevložil do SQL<br>\n";
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." tabulka evidence úspěšně naplněna ($count záznamů)<br>\n";
$count=0;
$res=MySQL_Query("SELECT * FROM fox2_registrace");
while ($reg=MySQL_Fetch_Assoc($res)):
//    echo "$reg[rc] $reg[rok]<br>\n";
   $x=MySQL_Query("SELECT * FROM osoby WHERE rc='$reg[rc]'");
   if (MySQL_Num_Rows($x)<>1):
      MySQL_Free_Result($x);
      echo "rodne cislo $reg[rc] nenalezeno<br>\n";
      continue;
     else:
      $osoba=MySQL_Fetch_Assoc($x);
      MySQL_Free_Result($x);
      endif;
   $x=MySQL_Query("SELECT * FROM oddily WHERE fox_id='$reg[id_oddilu]'");
   if (MySQL_Num_Rows($x)<>1):
      MySQL_Free_Result($x);
      echo "oddil $reg[id_oddilu] nenalezen ($reg[rc] $jmenozav])<br>\n";
      continue;
     else:
      $oddil=MySQL_Fetch_Assoc($x);
      MySQL_Free_Result($x);
      endif;
   if (empty($reg[rok])):
      echo "rok nenalezen<br>\n";
      continue;
      endif;
   $count++;
   if ($reg[pulrok]=='2') $od="$reg[rok]-07-01";
                     else $od="$reg[rok]-01-01";
   $query="INSERT INTO evidence SET osoba='$osoba[id]', oddil='$oddil[id]', od='$od', do='$reg[rok]-12-31'";
   $tmp=MySQL_Query($query);
   if (!$tmp) echo "záznam se nevložil do SQL<br>\n";
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." tabulka evidence úspěšně naplněna ($count záznamů)<br>\n";
break;

case "evidence_check":
$count=0;
$res=MySQL_Query("SELECT * FROM evidence GROUP BY osoba,oddil,do,do HAVING count(*)>1");
while ($reg=MySQL_Fetch_Assoc($res)):
   $count++;
   echo "$reg[id] $reg[osoba] $reg[oddil]<br>\n";
   $x=MySQL_Query("SELECT * FROM osoby WHERE id='$reg[osoba]'");
   if (MySQL_Num_Rows($x)<>1):
      MySQL_Free_Result($x);
      echo "osoba $reg[osoba] nenalezena<br>\n";
      continue;
     else:
      $osoba=MySQL_Fetch_Assoc($x);
      MySQL_Free_Result($x);
      endif;
   $x=MySQL_Query("SELECT * FROM oddily WHERE id='$reg[oddil]'");
   if (MySQL_Num_Rows($x)<>1):
      MySQL_Free_Result($x);
      echo "oddil $reg[oddil] nenalezen<br>\n";
      continue;
     else:
      $oddil=MySQL_Fetch_Assoc($x);
      MySQL_Free_Result($x);
      endif;
   $rok=substr($reg[od],0,4);
   MySQL_Query("DELETE FROM evidence WHERE id='$reg[id]'");
/*
   $x=MySQL_Query("SELECT * FROM fox2_registrace WHERE rc='$osoba[rc]' AND id_oddilu='$oddil[fox_id]' AND rok='$rok'");
   while ($r=MySQL_Fetch_Assoc($x))
      echo " * $r[rc] $r[jmenozav] $r[sport] $r[rok]<br>\n";
   MySQL_Free_Result($x);
*/
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." odstraněno $count duplicit<br>\n";
break;

case "registrace_create":
$query="DROP TABLE IF EXISTS registrace";
MySQL_Query($query) or die("nepovedlo se smazat registrace");
$query="CREATE TABLE registrace (
  `id` int(11) unsigned NOT NULL auto_increment,
  `osoba` int(6) NOT NULL,
  `oddil` smallint(4) NOT NULL,
  `sport` enum('SG','TG','OS','AE','AG','TR','VG','XX') NOT NULL,
  `funkce` enum('Z','T','R') NOT NULL,
  `od` date NOT NULL,
  `do` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `osoba` (`osoba`),
  KEY `oddil` (`oddil`),
  KEY `sport` (`sport`),
  KEY `funkce` (`funkce`),
  KEY `od` (`od`),
  KEY `do` (`do`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Registrace osob' AUTO_INCREMENT=1 ;
  ";
MySQL_Query($query) or die("nepovedlo se založit tabulku oddily");
echo date("H:i:s")." tabulka práva úspěšně založena<br>\n";
break;

case "registrace_import":
$count=0;
$res=MySQL_Query("SELECT * FROM fox2_registrace");
while ($reg=MySQL_Fetch_Assoc($res)):
//   echo "$reg[rc] $reg[id_oddilu] $reg[sport] $reg[rok]<br>\n";
   $x=MySQL_Query("SELECT * FROM osoby WHERE rc='$reg[rc]'");
   if (MySQL_Num_Rows($x)<>1):
      MySQL_Free_Result($x);
      echo "rodne cislo $reg[rc] nenalezeno<br>\n";
      continue;
     else:
      $osoba=MySQL_Fetch_Assoc($x);
      MySQL_Free_Result($x);
      endif;
   $x=MySQL_Query("SELECT * FROM oddily WHERE fox_id='$reg[id_oddilu]'");
   if (MySQL_Num_Rows($x)<>1):
      MySQL_Free_Result($x);
      echo "oddil $reg[id_oddilu] nenalezen<br>\n";
      continue;
     else:
      $oddil=MySQL_Fetch_Assoc($x);
      MySQL_Free_Result($x);
      endif;
   $od="$reg[rok]-01-01";
   $do="$reg[rok]-12-31";
   if ($reg[pulrok]=='1') $do="$reg[rok]-06-30";
   if ($reg[pulrok]=='2') $od="$reg[rok]-07-01";
   if ($reg[sport]=='SM') $reg[sport]='SG';
   if ($reg[sport]=='SZ') $reg[sport]='SG';
   $count++;
   $query="INSERT INTO registrace SET osoba='$osoba[id]', oddil='$oddil[id]', sport='$reg[sport]', funkce='Z', od='$od', do='$do'";
   $tmp=MySQL_Query($query);
   if (!$tmp) echo "záznam se nevložil do SQL<br>\n";
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." tabulka registrace úspěšně naplněna ($count záznamů)<br>\n";
break;

case "registrace_check":
$count=0;
$res=MySQL_Query("SELECT * FROM registrace");
while ($reg=MySQL_Fetch_Assoc($res))
   if (substr($reg['od'],5,5)<>'01-01' || substr($reg['do'],5,5)<>'12-31')
      echo "$reg[id] $reg[osoba] $reg[oddil] $reg[od] $reg[do]<br>\n";
MySQL_Free_Result($res);
echo date("H:i:s")." kontrola provedena<br>\n";
break;

case "registrace_zizkov":
$count=0;
$res=MySQL_Query("SELECT * FROM registrace, osoby WHERE registrace.osoba=osoby.id AND registrace.oddil=4 GROUP BY osoby.id");
while ($osoba=MySQL_Fetch_Assoc($res)):
   $count++;
   echo "$osoba[rc] $osoba[jmeno] $osoba[prijmeni]<br>\n";
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." nalezeno $count osob<br>\n";
break;

case "registrace_veronika":
$count=0;
$res=MySQL_Query("SELECT * FROM registrace, oddily WHERE registrace.oddil=oddily.id AND registrace.osoba=9568");
while ($oddil=MySQL_Fetch_Assoc($res)):
   $count++;
   echo substr($oddil[od],0,4)." $oddil[nazev]<br>\n";
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." nalezeno $count osob<br>\n";
break;

case "prihlaseni_create":
$query="DROP TABLE IF EXISTS prihlaseni";
MySQL_Query($query) or die("nepovedlo se smazat prihlaseni");
$query="CREATE TABLE prihlaseni (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `uspech` enum('A','N') NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`),
  KEY `ip` (`ip`),
  KEY `datum` (`datum`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Prehled prihlaseni' AUTO_INCREMENT=1 ;
  ";
MySQL_Query($query) or die("nepovedlo se založit tabulku přihlášení");
echo date("H:i:s")." tabulka přihlášení úspěšně založena<br>\n";
break;

case "prihlaseni_view":
$count=0;
$res=MySQL_Query("SELECT * FROM prihlaseni");
while ($record=MySQL_Fetch_Assoc($res)):
   $count++;
   echo "$record[datum] $record[username] $record[password] $record[ip] $record[uspech]<br>\n";
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." nalezeno $count zaznamu<br>\n";
break;

case "kraje":
$res=MySQL_Query("SELECT * FROM kraje");
while ($record=MySQL_Fetch_Assoc($res))
   $kraj[$record[oznaceni]]=$record[id];
MySQL_Free_Result($res);
echo date("H:i:s")." načteny kraje<br>\n";
$count=0;
$res=MySQL_Query("SELECT * FROM oddily");
while ($record=MySQL_Fetch_Assoc($res)):
   $count++;
   $up=$kraj[substr($record[fox_id],0,1)];
   MySQL_Query("UPDATE oddily SET kraj=$up WHERE id='$record[id]'");
   endwhile;
MySQL_Free_Result($res);
echo date("H:i:s")." nastaveno $count krajů<br>\n";
break;

case "rc":
$osoba[jmeno]='jm';
$osoba[prijmeni]='pr';
$osoba[narozeni]='1967-11-19';
$osoba[pohlavi]='Z';
$osoba[cizinec]='N';
$osoba[rc]='6711191553';
kontrola_osoby($osoba);
echo '<pre>';
var_dump($osoba);
echo '</pre>';
echo date("H:i:s")." kontrola<br>\n";
break;

case "jmena":
$res=kontrola_jmena('Řehoř');
echo '<pre>';
var_dump($res);
echo '</pre>';
echo date("H:i:s")." kontrola<br>\n";
break;

case "csv":
$osoby=import_csv(file('gym.csv'));
echo "Nalezeno ".count($osoby)." osob<br>";
if (is_array($osoby))
   foreach ($osoby as $osoba)
      echo "$osoba[id] $osoba[jmeno] $osoba[prijmeni] $osoba[narozeni] $osoba[pohlavi] $osoba[cizinec] $osoba[email] $osoba[mobil] $osoba[error]<br>\n";
//echo "<pre>\n";
//var_dump($osoby);
//echo "</pre>\n";
echo date("H:i:s")." import CSV<br>\n";
break;

case "cookies":
$x=getallheaders();
echo "<pre>\n";
var_dump($x);
echo "</pre>\n";
echo date("H:i:s")." import CSV<br>\n";
break;

default:
echo 'ODDILY: <a href="?action=oddily_create">create</a>, <a href="?action=oddily_import">import</a>, <a href="?action=oddily_check">check</a>, <a href="?action=oddily_view">view</a><br>';
echo 'OSOBY: <a href="?action=osoby_create">create</a>, <a href="?action=osoby_import">import</a>, <a href="?action=osoby_check">check</a>, <a href="?action=osoby_view">view</a><br>';
echo 'PRAVA: <a href="?action=prava_create">create</a>, <a href="?action=prava_import">import</a>, <a href="?action=prava_demo">demo</a><br>';
echo 'EVIDENCE: <a href="?action=evidence_create">create</a>, <a href="?action=evidence_import">import</a>, <a href="?action=evidence_check">check</a><br>';
echo 'REGISTRACE: <a href="?action=registrace_create">create</a>, <a href="?action=registrace_import">import</a>, <a href="?action=registrace_check">check</a><br>';
echo 'PRIHLASENI: <a href="?action=prihlaseni_create">create</a>, <a href="?action=prihlaseni_view">výpis</a><br>';
echo 'KRAJE: <a href="?action=kraje">import</a><br>';
echo 'KONTROLA RC: <a href="?action=rc">test</a><br>';
echo 'PDF: <a href="/admin/pdf">pdf generator</a><br>';
echo 'JMENA: <a href="?action=jmena">kontrola jmena</a><br>';
echo 'CSV: <a href="?action=csv">import</a><br>';
echo 'COOKIES: <a href="?action=cookies">test</a><br>';
break;

endswitch;
if (isset($_GET[action])) echo date("H:i:s").' <a href="?">zpět</a><br>';

?>
