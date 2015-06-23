<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.93163100 1429779782";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prihlasit.latte";i:2;i:1416565483;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prihlasit.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'b2j4r0plvj')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb53751aedc8_sekce')) { function _lb53751aedc8_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ?> - přihláška<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb757bcace97_obsah')) { function _lb757bcace97_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("prihlaskaJednotlivciForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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