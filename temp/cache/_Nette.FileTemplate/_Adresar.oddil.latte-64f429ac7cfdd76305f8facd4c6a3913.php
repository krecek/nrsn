<?php //netteCache[01]000361a:2:{s:4:"time";s:21:"0.76625200 1429602743";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Adresar/oddil.latte";i:2;i:1429602742;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Adresar/oddil.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'm14s9qtotf')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb82b1484877_content')) { function _lb82b1484877_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>


<table>
            <tr>
                <td>Adresa:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($oddil['ulice'], ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($oddil['psc'], ENT_NOQUOTES) ?>  <?php echo NTemplateHelpers::escapeHtml($oddil['obec'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
            <tr>
                <td>Telefon:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($oddil['mobil'], ENT_NOQUOTES) ;if ($oddil['mobil'] && $oddil['telefon']): ?>
, <?php endif ;echo NTemplateHelpers::escapeHtml($oddil['telefon'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($oddil['email'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
            <tr>
                <td>Číslo účtu:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($oddil['banka'], ENT_NOQUOTES) ?>
 <?php if ($oddil['vs']): ?>VS: <?php echo NTemplateHelpers::escapeHtml($oddil['vs'], ENT_NOQUOTES) ;endif ?>&nbsp;</td>
            </tr>
</table>

<h2>Seznam registrovaných závodníků:</h2>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($seznam_clenu) as $osoba): if ($iterator->isFirst()): ?>
<ul><?php endif ?>

    <li><a href="<?php echo htmlSpecialChars($_control->link("Osoby:default", array($osoba['id']))) ?>
"> <?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?> <?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?></a></li>
<?php if ($iterator->isLast()): ?></ul><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($vysledky) as $akce_id=>$akce): if ($iterator->isFirst()): ?>
    <h2>Účast na závodech:</h2>
    <ul>
<?php endif ?>
        <li><a href="<?php echo htmlSpecialChars($_control->link("Vysledky:detail", array($akce['akce']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?></a> (<?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?>)</li>
    <?php if ($iterator->isLast()): ?></ul><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb7e9757e66a_title')) { function _lb7e9757e66a_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit"><?php echo NTemplateHelpers::escapeHtml($oddil['nazev'], ENT_NOQUOTES) ?>
</h1><?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lbd75ddf8029_menu')) { function _lbd75ddf8029_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("menu"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['menu']), $_l, get_defined_vars()) ; 