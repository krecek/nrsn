<?php
$soubory = array('config' => '../', 'auth' => '../', 'logger' => '../', 'supermail' => '../', 'database'=>'../', 'cs'=>'../', 'update'=>'../');



//========== AKTUALIZACE SOUBORU ===================

if (isset($_GET['akce']) && $_GET['akce'] == 'aktualizovat')
{
    $soubor = $_GET['soubor'];
    $verze = $_GET['verze'];
    $adresa = "http://www.satoya.cz/~sritter/$soubor/$soubor." . str_replace('.', '', trim($verze));
    $nova_verze = file_get_contents($adresa);
    if ($nova_verze)
    {
        $f2 = fopen($soubory[$soubor] . $soubor . '.php', 'w+');
        fwrite($f2, $nova_verze);
        fclose($f2);
    }

    echo "Soubor $soubor.php byl aktualizovan na verzi $verze.";
    die();
}

//============== POROVNÁNÍ VERZÍ ===================

$nejnovejsi_verze[] = array();
foreach ($soubory as $soubor => $umisteni)
{
    $pouzity_soubor = file($umisteni . $soubor . '.php');
    foreach ($pouzity_soubor as $radek)
    {
        if (preg_match('/@version +(.*)/', $radek, $tmp))
        {
            if (preg_match('~(.*)\(.*~', trim($tmp[1]), $tmp_1))
            {
                $pouzite_verze[$soubor] = trim($tmp_1[1]);
                break;
            }
        }
    }
    $file = file("http://www.satoya.cz/~sritter/$soubor/");
    foreach ($file as $radek)
    {
        if (preg_match('~.*' . strtoupper($soubor) . ' ?([0-9]*\.[0-9]*) \(~', $radek, $tmp))
        {
            $nejnovejsi_verze[$soubor] = trim($tmp[1]);
            break;
        }
    }
}

echo '<table>' . "\n";
echo '<tr><th>Soubor</th><th>Pouzita verze</th><th>Nejnovejsi verze</th><th>&nbsp;</th></tr>' . "\n";
foreach ($soubory as $soubor => $umisteni)
{
    echo '<tr>';
    echo "<td>$soubor</td><td>$pouzite_verze[$soubor]</td><td>$nejnovejsi_verze[$soubor]</td><td>";
    if (trim($nejnovejsi_verze[$soubor] != $pouzite_verze[$soubor])) echo "<a href=?akce=aktualizovat&soubor=$soubor&verze=$nejnovejsi_verze[$soubor]>aktualizovat</a>";
    else echo "&nbsp;";
    echo "<td></tr>\n";
}
echo '</table>';
?>

