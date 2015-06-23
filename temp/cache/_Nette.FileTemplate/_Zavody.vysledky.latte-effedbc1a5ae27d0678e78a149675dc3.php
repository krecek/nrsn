<?php //netteCache[01]000363a:2:{s:4:"time";s:21:"0.67190100 1430206852";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:74:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/vysledky.latte";i:2;i:1430206847;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/vysledky.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '7g8230wpdu')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lbb982d37f16_sekce')) { function _lbb982d37f16_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Elektronické výsledky - <?php echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb6fc032ae8f_obsah')) { function _lb6fc032ae8f_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($existuji_vysledky): ?>
<img src="<?php echo htmlSpecialChars($basePath) ?>/css/result.png" alt="Výsledky jsou nahrány" title="Výsledky jsou nahrány" align="left" /> Elektronické výsledky těchto závodů jsou nahrány. Přejete-li si je změnit, je potřeba je nejprve smazat a nahrát upravenou verzi.
<div class="bottom_nav">
    <a href="<?php echo htmlSpecialChars($_control->link("detail", array($akce->id))) ?>
">Zpět</a>
    <a href="<?php echo htmlSpecialChars($_control->link("exportVysledku", array($akce->id))) ?>
">Stáhnout</a>
    <a onclick="if(!confirm('Opravdu smazat výsledky?')) return false;" href="<?php echo htmlSpecialChars($_control->link("deleteVysledky", array($akce->id))) ?>
">Smazat</a>
</div>
<?php else: ?>
<div class="ico-info">

    <!--<img src="<?php echo NTemplateHelpers::escapeHtmlComment($basePath) ?>/css/info-big.png" align="left">-->
Podporovány jsou výsledky jednotlivců a družstev ve sportech "Sportovní gymnastika mužů" a "Sportovní gymnastika žen". Nahrávaný soubor musí být ve formátu xlsx. Všechny kategorie musí být v jednom souboru, každá kategorie na vlastním listu. Název listu musí začínat číslem kategorie a podtržítkem ( _ ).
</div>
<br />
<?php $_ctrl = $_control->getComponent("nahratVysledkyForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
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