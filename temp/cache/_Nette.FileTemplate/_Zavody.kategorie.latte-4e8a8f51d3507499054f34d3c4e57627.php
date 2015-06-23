<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.03714000 1429537983";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/kategorie.latte";i:2;i:1421752075;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/kategorie.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '4jif1yptxl')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb487bf23a68_sekce')) { function _lb487bf23a68_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ?> - kategorie<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbcb033a8f38_obsah')) { function _lbcb033a8f38_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
 ?>
<div id="<?php echo $_control->getSnippetId('seznamKategorii') ?>"><?php call_user_func(reset($_l->blocks['_seznamKategorii']), $_l, $template->getParameters()) ?>
</div><div class="bottom_nav">
<a href="<?php echo htmlSpecialChars($_control->link("detail", array($akce->id))) ?>
">Zpět</a>    
<?php if ($opravneni['edit']): ?><a href="<?php echo htmlSpecialChars($_control->link("kategorieAdd", array($akce->id))) ?>
">Nová kategorie</a><?php endif ?>

</div>

<?php
}}

//
// block _seznamKategorii
//
if (!function_exists($_l->blocks['_seznamKategorii'][] = '_lb653377a01d__seznamKategorii')) { function _lb653377a01d__seznamKategorii($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('seznamKategorii')
;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($kategorie) as $id=>$kat): ?>
<span class="h3"><?php echo NTemplateHelpers::escapeHtml($kat['nazev'], ENT_NOQUOTES) ?></span>
<?php if ($opravneni['edit']): ?>&nbsp;&nbsp;&nbsp;
<a href="<?php echo htmlSpecialChars($_control->link("kategorieEdit", array($akce->id,$kat->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-edit.gif" alt="upravit" title="upravit kategorii" /></a>&nbsp;&nbsp;&nbsp;
<a class="ajax" data-confirm="Opravdu smazat kategorii? Případné přihlášky budou zrušeny a oddílům zaslána informace e-mailem."  href="<?php echo htmlSpecialChars($_control->link("deleteKategorie!", array($akce->id,$kat->id))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="zrušit" title="zrušit kategorii" /></a>
<?php endif ?>
<table>
    <tr><th class="left">pohlaví</th><td><?php if ($kat['pohlavi']=='M'): ?>muži<?php elseif ($kat['pohlavi']=='Z'): ?>
ženy<?php else: ?>bez omezení<?php endif ?></td></tr>
    <tr><th class="left">určení</th><td><?php if ($kat['typ']=='R'): ?>registrovaní<?php elseif ($kat['typ']=='E'): ?>
evidovaní<?php else: ?>bez omezení<?php endif ?></td></tr>
    <tr><th class="left">ročníky narození</th><td><?php echo NTemplateHelpers::escapeHtml($template->kategorieRocniky($kat['rocnik_od'], $kat['rocnik_do']), ENT_NOQUOTES) ?></td></tr>
    <tr><th class="left">typ</th><td><?php if ($kat['druzstvo']==1): ?>soutěž jednotlivců<?php else: ?>
soutěž družstev (<?php echo NTemplateHelpers::escapeHtml($kat['druzstvo'], ENT_NOQUOTES) ?>
-členných)<?php if ($kat['detail_druzstva']): ?>: <?php echo NTemplateHelpers::escapeHtml($kat['detail_druzstva'], ENT_NOQUOTES) ;endif ;endif ?></td></tr>
<?php if ($kat['druzstvo']!=1): ?>
    <tr><th class="left">povolené hostování</th><td><?php if ($kat['hostovani']=='A'): ?>
ano<?php else: ?>ne<?php endif ?></td></tr>
<?php endif ;if ($kat['omezeni_na_oddil']): ?>
    <tr>
        <td colspan="2">
        <?php if ($kat['druzstvo']==1): ?>maximálně <?php echo NTemplateHelpers::escapeHtml($kat['omezeni_na_oddil'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->sklonovaniOsoby($kat['omezeni_na_oddil']), ENT_NOQUOTES) ?>
 z jednoho oddílu<?php endif ?>

        <?php if ($kat['druzstvo']>1): ?>maximálně <?php echo NTemplateHelpers::escapeHtml($kat['omezeni_na_oddil'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->sklonovaniDruzstva($kat['omezeni_na_oddil']), ENT_NOQUOTES) ?>
 z jednoho oddílu<?php endif ?>

        </td>
    </tr>
<?php endif ?>

</table>
<?php if (!$iterator->isLast()): ?><br /> <?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;
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