<?php //netteCache[01]000363a:2:{s:4:"time";s:21:"0.22847200 1429787212";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:74:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Vysledky/detail.latte";i:2;i:1429787194;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Vysledky/detail.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'bv1x8fzjfb')
;
// prolog NUIMacros
//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbdfbcaf58c4_head')) { function _lbdfbcaf58c4_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> <script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/tablesorter/jquery.tablesorter.js"></script>
 <link rel="stylesheet" media="screen,projection,tv,print" href="<?php echo htmlSpecialChars($basePath) ?>/js/tablesorter/style.css" />
<?php
}}

//
// block sirka_nadrazeneho_sloupce
//
if (!function_exists($_l->blocks['sirka_nadrazeneho_sloupce'][] = '_lbfb36596e7e_sirka_nadrazeneho_sloupce')) { function _lbfb36596e7e_sirka_nadrazeneho_sloupce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>12<?php
}}

//
// block levy_blok
//
if (!function_exists($_l->blocks['levy_blok'][] = '_lb5b838dde08_levy_blok')) { function _lb5b838dde08_levy_blok($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block pravy_blok
//
if (!function_exists($_l->blocks['pravy_blok'][] = '_lb361c8e289d_pravy_blok')) { function _lb361c8e289d_pravy_blok($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block sirka_stredniho_sloupce
//
if (!function_exists($_l->blocks['sirka_stredniho_sloupce'][] = '_lbb166101092_sirka_stredniho_sloupce')) { function _lbb166101092_sirka_stredniho_sloupce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>12<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb3bb298d597_content')) { function _lb3bb298d597_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<img src="<?php echo htmlSpecialChars($basePath) ?>/css/datum.png" />&nbsp;<?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?>

<br />
<?php if ($akce['misto']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/location.png" />&nbsp;pořadatel: <?php echo NTemplateHelpers::escapeHtml($akce['misto'], ENT_NOQUOTES) ?>
<br /><?php endif ?>

<?php if ($existuji_vysledky): ?>
<br />
    <?php NFormMacros::renderFormBegin($form = $_form = (is_object("seznamKategoriiForm") ? "seznamKategoriiForm" : $_control["seznamKategoriiForm"]), array()) ;$_input = is_object("kategorie") ? "kategorie" : $_form["kategorie"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?>
:&nbsp;<?php $_input = (is_object("kategorie") ? "kategorie" : $_form["kategorie"]); echo $_input->getControl()->addAttributes(array()) ;$_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ;NFormMacros::renderFormEnd($_form) ?>

<?php if ($kategorie): ?>
    <h3><?php echo NTemplateHelpers::escapeHtml($kategorie['nazev'], ENT_NOQUOTES) ?></h3>
    <table>
        <tr><td>Sport:</td><td><?php echo NTemplateHelpers::escapeHtml($sporty[$kategorie['sport']], ENT_NOQUOTES) ?></td></tr>
    </table>
<?php endif ;$_ctrl = $_control->getComponent("vysledky"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;else: ?>
    <p>Elektronické výsledky této akce nebyly nalezeny.</p>
<?php endif ?>
<br />
<a href="<?php echo htmlSpecialChars($_control->link("Kalendar:detail", array($akce['id']))) ?>
">zpět na detail závodu</a>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lba8a2e90eda_title')) { function _lba8a2e90eda_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit">Elektronické výsledky - <?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?>
</h1><?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof NPresenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>
 <?php call_user_func(reset($_l->blocks['sirka_nadrazeneho_sloupce']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['levy_blok']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['pravy_blok']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['sirka_stredniho_sloupce']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 