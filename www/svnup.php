<?
$handle=fopen('../svnup.tmp','w');
fwrite($handle,date("r"));
fclose($handle);

sleep(3);

$soubor = file('../svnup.log');
echo "<pre>\n";
for($i=count($soubor) - 50; $i<=count($soubor); $i++)
    echo $soubor[$i];
echo "</pre>";
?>