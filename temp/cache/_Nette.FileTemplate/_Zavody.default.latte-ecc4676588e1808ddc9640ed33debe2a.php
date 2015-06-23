<?php //netteCache[01]000362a:2:{s:4:"time";s:21:"0.42234900 1429537851";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:73:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/default.latte";i:2;i:1415717035;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'q2qa1vjcf5')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lbee23be07d4_sekce')) { function _lbee23be07d4_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Moje Akce<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb30b34e254e_obsah')) { function _lb30b34e254e_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><table>
    <tr>
        <th class="vel25">Datum</th>
        <th class="oddo">Sport</th>
        <th class="width_auto">Název</th>
    </tr>
<?php if ($seznam_akci): $iterations = 0; foreach ($seznam_akci as $akce): ?>
    <tr>
        <td><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?></td>
        <td><?php echo NTemplateHelpers::escapeHtml($akce['sport'], ENT_NOQUOTES) ?></td>
        <td><a href="<?php echo htmlSpecialChars($_control->link("detail", array($akce->id))) ?>
"><?php echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ?></a></td>
    </tr>
<?php $iterations++; endforeach ;else: ?>
    <tr><td colspan='2'>Nebyly nalezeny žádné akce.</td></tr>
<?php endif ?>
</table>
<?php if ($opravneni['add']): ?>
<div class="bottom_nav">
    <a href="<?php echo htmlSpecialChars($_control->link("add")) ?>">Nová akce</a>
    <a href="<?php echo htmlSpecialChars($_control->link("archiv")) ?>">Archiv</a>
</div>
<?php endif ;
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