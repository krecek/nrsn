<?php //netteCache[01]000361a:2:{s:4:"time";s:21:"0.80360700 1433343631";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Osoby/default.latte";i:2;i:1433343628;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Osoby/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'vpmceli8td')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbbdc6a5f0c2_content')) { function _lbbdc6a5f0c2_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<div class='osoba_hlavicka' style='float:left'>
    
    <table>
            <tr><th class='left'>Ročník:</th><td><?php echo NTemplateHelpers::escapeHtml($template->date($osoba['narozeni'], 'Y'), ENT_NOQUOTES) ?></td></tr>
            <tr><th class='left'>Město:</th><td><?php echo NTemplateHelpers::escapeHtml($osoba['obec'], ENT_NOQUOTES) ?></td></tr>
            <tr><th class='left'>Trenér:</th><td><?php echo NTemplateHelpers::escapeHtml($osoba['trener'], ENT_NOQUOTES) ?></td></tr>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($evidence) as $ev): if ($iterator->isFirst()): ?>
           <tr><th class='left'>Oddíl:</th><td>
<?php endif ?>
         <a href="<?php echo htmlSpecialChars($_control->link("Adresar:oddil", array($ev['oddil']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($ev['nazev'], ENT_NOQUOTES) ?></a> <?php if ($ev['registrace']): ?>
(<?php echo NTemplateHelpers::escapeHtml($ev['registrace'], ENT_NOQUOTES) ?>)<?php endif ;if (!$iterator->isLast()): ?>
<br /><?php endif ?>

    <?php if ($iterator->isLast()): ?></td></tr><?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

     </table>
</div>
<div style='float:right'><img  src='<?php echo htmlSpecialChars($basePath, ENT_QUOTES) ?>
/<?php echo htmlSpecialChars($fotografie, ENT_QUOTES) ?>' align="right" /></div>
<div style='clear:both; float:none;'>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($prihlasky) as $prihlaska): if ($iterator->isFirst()): ?>
        <div>
            <h3>Přihlášky</h3>
            <table>
                <tr class='left'>
                    <th>Datum</th>
                    <th>Závod</th>
                </tr>
<?php endif ?>
                <tr>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($prihlaska['od'], $prihlaska['do']), ENT_NOQUOTES) ?></td>
                    <td><a href="<?php echo htmlSpecialChars($_control->link("Kalendar:detail", array($prihlaska['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($prihlaska['nazev'], ENT_NOQUOTES) ?></a></td>
                </tr>
<?php if ($iterator->isLast()): ?>
            </table>
        </div> 
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($vysledky) as $vysledek): if ($iterator->isFirst()): ?>
        <div>
            <h3>Výsledky závodů</h3>
            <table width="100%">
                <tr class='left'>
                    <th>Datum</th>
                    <th>Závod</th>
                    <th>Sport</th>
                    <th>Kategorie</th>
                    <th>Umístění</th>

                </tr>
<?php endif ?>
                <tr>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($vysledek['od'], $vysledek['do']), ENT_NOQUOTES) ?></td>
                    <td><a href="<?php echo htmlSpecialChars($_control->link("Vysledky:detail", array($vysledek['akce'],$vysledek['kategorie']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($vysledek['nazev'], ENT_NOQUOTES) ?></a></td>
                    <td><?php echo NTemplateHelpers::escapeHtml($vysledek['sport'], ENT_NOQUOTES) ?></td>
                    <td><?php echo NTemplateHelpers::escapeHtml($vysledek['nazev_kategorie'], ENT_NOQUOTES) ?></td>
                    <td><?php echo NTemplateHelpers::escapeHtml($vysledek['poradi'], ENT_NOQUOTES) ?>.</td>
                </tr>
<?php if ($iterator->isLast()): ?>
            </table>
        </div>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
<br />
<?php $_ctrl = $_control->getComponent("galerie"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $_control->getComponent("seznamPriloh"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</div>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb013ce8957c_title')) { function _lb013ce8957c_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit"><?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?></h1><?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lbf0f353d8c3_menu')) { function _lbf0f353d8c3_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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