<?php //netteCache[01]000362a:2:{s:4:"time";s:21:"0.99296100 1430391355";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:73:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Osoby/napoveda.latte";i:2;i:1380903869;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Osoby/napoveda.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'xanh3q187b')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lba1505b1166_sekce')) { function _lba1505b1166_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Nápověda<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb897ca8406c_obsah')) { function _lb897ca8406c_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h2>Role uživatele <?php if (!$admin): ?>(vaše role)<?php endif ?></h2>
<p>Běžný uživatel může přistupovat pouze ke svým vlastním údajům.
V levém menu jsou uvedeny všechny dostupné možnosti.</p>
<ul>
<li><h3>Osobní údaje</h3>
<p>Zobrazí přehled aktuálních údajů uživatele.
Již z tohoto přehledu je patrné zda máte správně vyplněny svoje údaje.</p></li>
<li><h3>Upravit</h3>
<p>Upraví osobní údaje užívatele, například adresu, mobil, email, web, atd.
Údaje si můžete kdykoliv změnit a je vhodné je udržovat aktuální.
Naopak identifikační údaje jako jméno, příjmení, datum narozeni, rodné číslo měnit nelze nikdy, to přísluší pouze administrátorovi.
Pokud chcete kontaktovat administrátora pište na adresu <a href="mailto:gis@gymfed.cz">gis@gymfed.cz</a></p></li>
<li><h3>Změna jména</h3>
<p>Uživatel si může kdykoliv změnit přihlašovací jméno.
Na počátku ho systém sám vybere, ale pro lepší zapamatování ho změňte, jak jste zvyklí.
Nelze zvolit přihlašovací jméno, které již někdo používá (bez ohledu na velikost písmen).
Doporučujeme volit uživatelská jména bez háčků a čárek.</p></li> 
<li><h3>Změna hesla</h3>
<p>Uživatel si může kdykoliv změnit přihlašovací heslo.
Prvotní heslo vygenerované systémem je důrazně doporučeno z bezpečnostních důvodů ihned změnit na vlastní.
Svoje heslo za žádných okolností neposílejte mailem, ani nevyzrazujte žádné jiné osobě.</p></li>
<li><h3>Historie</h3>
<p>Historie vypisuje evidence v oddílech a registrace v konkrétních sportech.</p></li>
</ul>

<h2>Role administrátora <?php if ($admin): ?>(vaše role)<?php endif ?></h2>
<p>Administrátor může přistupovat k údajům všech osob.
Jeho možnosti jsou dány právy, konkrétní výší oprávnění (viz Práva).</p>
<ul>
<li><h3>Hledat</h3>
<p>Do vyhledávacího pole zadejte příjmení, evidenční číslo nebo rodné číslo (bez lomítka).
Údaje nalezené osoby lze upravit pomocí odkazu pod osobou.
Přístup do GISu lze zřídit vyplněním emailu nebo později změnou přístupových údajů.
Historie zobrazí evidence a registrace, přičemž letošní umožní administrátorovi odstranit.</p></li>
<li><h3>Přestup</h3>
<p>Před samotným provedením přestupu vyhledejte konkrétní osobu a dole zvolte odkaz Přestup.
Přestup lze provést pouze u osoby, která je zaregistrovaná letos nebo minulý rok.
Systém sám nabídne možnosti z kterého oddílu, kterého sportu a ke kterému datu lze přestoupit.
Po výběru cílového oddílu jsou provedeny nezbytné kontroly a následně provedena evidence a registrace v novém oddílu.</p></li>
<li><h3>Nová osoba</h3>
<p>Vypište jméno a příjmení nové osoby.
Pokud není rodné číslo nevymýšlejte jej a vyplňte datum narození, pohlaví a cizince.
Při shodě údajů budete informování o osobách se stejným jménem nebo stejným datem narození.
Vytvoření nové osoby, která má stejné jméno, příjmení i datum narození je velmi vzácné a vyžádá si další potvrzení takového kroku.</p></li>
<li><h3>Statistika</h3>
<p>Systém vygeneruje klíčová data získané z databáze osob.
Je důležité rozlišovat osoby vedené v databázi, osoby evidované a osoby registrované.
Přehledy jsou generovány dle krajů, dle sportů a dle věku.</p></li>
<li><h3>Práva</h3>
<p>Zobrazí administrátory tohoto modulu.
Nejvyšší oprávnění znamená nejvyšší práva, menší oprávnění znamená menší práva.
V tabulce je uvedeno od které výše získáte jaké možnosti.
Doporučujeme přidávat vždy nejmenší možná práva.</p>
</li>
</ul>
<h4>Tabulka oprávnění:</h4>
<table>
<tr><th>9</th><td>(nejvyšší práva)</td></tr>
<tr><th>8</th><td>-</td></tr>
<tr><th>7</th><td>-</td></tr>
<tr><th>6</th><td>-</td></tr>
<tr><th>5</th><td>přestupy, mazání v historii</td></tr>
<tr><th>4</th><td>lze přidávat další administrátory</td></tr>
<tr><th>3</th><td>úpravy všech osob, nová osoba</td></tr>
<tr><th>2</th><td>-</td></tr>
<tr><th>1</th><td>pasivní prohlížení všech osob, hledání, statistika</td></tr>
</table>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = 'base.latte'; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
 if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars()) ; 