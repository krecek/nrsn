<?php //netteCache[01]000358a:2:{s:4:"time";s:21:"0.24464800 1429881401";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:69:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/add.latte";i:2;i:1414059198;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/add.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'utte141a7i')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb19aa665ce6_sekce')) { function _lb19aa665ce6_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Nová akce<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb830d8f62ff_obsah')) { function _lb830d8f62ff_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("addAkceForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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