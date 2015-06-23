<?php //netteCache[01]000361a:2:{s:4:"time";s:21:"0.15711500 1430497255";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/hledat.latte";i:2;i:1415717043;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/hledat.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'eymlh67tso')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb0ad285abae_sekce')) { function _lb0ad285abae_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Hledat<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbdbe8a543b2_obsah')) { function _lbdbe8a543b2_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("hledatForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
<table>
<?php $iterations = 0; foreach ($seznam_akci as $akce): ?>
    <tr>
        <td class="vel25"><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?></td>
        <td class="oddo"><?php if ($akce['sport']=='XX'): ?>&nbsp;<?php else: echo NTemplateHelpers::escapeHtml($akce['sport'], ENT_NOQUOTES) ;endif ?></td>
        <td class="width_auto"><a href="<?php echo htmlSpecialChars($_control->link("detail", array($akce['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?></a></td>
    </tr>
<?php $iterations++; endforeach ?>
</table><?php
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