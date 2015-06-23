<?php //netteCache[01]000371a:2:{s:4:"time";s:21:"0.17099000 1429779740";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:82:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prehledPrihlasek.latte";i:2;i:1420633520;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prehledPrihlasek.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'as3cwpgie7')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lba3b5fce54a_sekce')) { function _lba3b5fce54a_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přihlášky<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb218590e1a3_obsah')) { function _lb218590e1a3_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
 ?>
<div id="<?php echo $_control->getSnippetId('k_prihlaseni') ?>"><?php call_user_func(reset($_l->blocks['_k_prihlaseni']), $_l, $template->getParameters()) ?>
</div><?php
}}

//
// block _k_prihlaseni
//
if (!function_exists($_l->blocks['_k_prihlaseni'][] = '_lbfcd3fed6ce__k_prihlaseni')) { function _lbfcd3fed6ce__k_prihlaseni($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('k_prihlaseni')
;NFormMacros::renderFormBegin($form = $_form = (is_object("sportyFiltrForm") ? "sportyFiltrForm" : $_control["sportyFiltrForm"]), array()) ?>
<table>
    <tbody>
    <tr>
        <td><?php $_input = (is_object("sporty") ? "sporty" : $_form["sporty"]); echo $_input->getControl()->addAttributes(array()) ?></td>
        <td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td>
    </tr>
    </tbody>
</table>
<?php NFormMacros::renderFormEnd($_form) ;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($k_prihlaseni) as $akce): if ($iterator->isFirst()): ?>
<table class="hover">
    <tr>
        <th>Datum</th><th class="oddo">Sport</th><th>Akce</th><th>Přihlášky do</th><th>&nbsp;</th><th>&nbsp;</th>
    </tr>
<?php endif ?>
    <tr>
        <td><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?></td>
        <td><?php echo NTemplateHelpers::escapeHtml($akce['sport'], ENT_NOQUOTES) ?></td>
        <td><a href="<?php echo htmlSpecialChars($_control->link("info", array($akce['id'], $oddil))) ?>
"><?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?></a></td>
        <td><?php echo NTemplateHelpers::escapeHtml($template->date($akce['uzavirka_prihlasek'], 'j.n.Y'), ENT_NOQUOTES) ?></td>
        <td><?php if ($opravneni['prihlasky'] && $akce['elektronicke_prihlasky']): ?>
<a href="<?php echo htmlSpecialChars($_control->link("prihlasky", array($akce['id'], $oddil))) ?>
">přihlásit</a><?php endif ?></td>
        <td><?php if ($akce['prihlaseno']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/ico-ok.gif" alt="ano" title="přihlášeno <?php echo htmlSpecialChars($akce['prihlaseno']) ?>
 osob" /><?php else: ?>&nbsp;<?php endif ?></td>
    </tr>
<?php if ($iterator->isLast()): ?></table><?php endif ?>

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