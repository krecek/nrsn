<?php //netteCache[01]000366a:2:{s:4:"time";s:21:"0.58413700 1429537903";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:77:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/pravaSelect.latte";i:2;i:1415268392;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/pravaSelect.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'lni94b8hiz')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb04256b1279_sekce')) { function _lb04256b1279_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Práva<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb9e6af4e54f_obsah')) { function _lb9e6af4e54f_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Zvolte oddíl:
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($seznam) as $id=>$oddil): if ($iterator->isFirst()): ?>
<ul><?php endif ?>

    <li><a href="<?php echo htmlSpecialChars($_control->link("prava", array($id))) ?>
"><?php echo NTemplateHelpers::escapeHtml($oddil, ENT_NOQUOTES) ?> <?php if ($id): ?>
(<?php echo NTemplateHelpers::escapeHtml($id, ENT_NOQUOTES) ?>)<?php endif ?></a></li>
    <?php if ($iterator->isLast()): ?></ul><?php endif ?>

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