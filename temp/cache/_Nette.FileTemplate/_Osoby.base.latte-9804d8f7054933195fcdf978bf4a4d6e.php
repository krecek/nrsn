<?php //netteCache[01]000358a:2:{s:4:"time";s:21:"0.92979000 1429537844";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:69:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Osoby/base.latte";i:2;i:1378836207;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Osoby/base.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'nx2xlitl7s')
;
// prolog NUIMacros
//
// block subtitle
//
if (!function_exists($_l->blocks['subtitle'][] = '_lbf2d9fc67f7_subtitle')) { function _lbf2d9fc67f7_subtitle($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> - osoby<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb2616d84e8c_content')) { function _lb2616d84e8c_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("bocniMenu"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>

<div class="span9"><div class="inner">
<?php $iterations = 0; foreach ($flashes as $flash): ?>    	<div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo NTemplateHelpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>
<h1><?php call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars())  ?></h1>
<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars())  ?>
</div></div>
<?php
}}

//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb05d9b73356_sekce')) { function _lb05d9b73356_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbb40636c08b_obsah')) { function _lbb40636c08b_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = '../@layout.latte'; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
 if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['subtitle']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 