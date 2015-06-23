<?php //netteCache[01]000368a:2:{s:4:"time";s:21:"0.63328600 1429802538";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:79:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/nastaveniPrav.latte";i:2;i:1379328653;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/nastaveniPrav.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'ud8qgksw75')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lbf8c1ad9aa7_sekce')) { function _lbf8c1ad9aa7_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Práva<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb680daad536_obsah')) { function _lb680daad536_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("nastaveniPravComponent"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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
call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars()) ?>
 
<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars()) ; 