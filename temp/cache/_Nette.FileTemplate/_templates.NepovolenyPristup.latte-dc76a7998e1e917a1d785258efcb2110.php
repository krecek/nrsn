<?php //netteCache[01]000370a:2:{s:4:"time";s:21:"0.96689300 1435035440";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:81:"D:\xampp\htdocs\redakcni_system\app\AdminModule\templates\NepovolenyPristup.latte";i:2;i:1433434639;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: D:\xampp\htdocs\redakcni_system\app\AdminModule\templates\NepovolenyPristup.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'tcygdj8w2f')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb8b27780d5b_content')) { function _lb8b27780d5b_content($_l, $_args) { extract($_args)
?><div style="text-align:center">
Do tohoto modulu nemáte přístup.
</div><?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = '@layout.latte'; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
 if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 