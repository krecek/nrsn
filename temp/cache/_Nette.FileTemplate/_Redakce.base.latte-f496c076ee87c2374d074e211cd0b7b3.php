<?php //netteCache[01]000360a:2:{s:4:"time";s:21:"0.78067400 1431500809";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:71:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Redakce/base.latte";i:2;i:1395396164;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Redakce/base.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'crfpit0fla')
;
// prolog NUIMacros
//
// block subtitle
//
if (!function_exists($_l->blocks['subtitle'][] = '_lb334a1eb71a_subtitle')) { function _lb334a1eb71a_subtitle($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> - redakce<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbac5f067377_content')) { function _lbac5f067377_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("bocniMenu"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>

<div class="span9"><div class="inner">
<div id="<?php echo $_control->getSnippetId('flashMessages') ?>"><?php call_user_func(reset($_l->blocks['_flashMessages']), $_l, $template->getParameters()) ?>
</div>        <h1><?php call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars())  ?></h1>
<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars())  ?>

    </div></div>
<?php
}}

//
// block _flashMessages
//
if (!function_exists($_l->blocks['_flashMessages'][] = '_lb2e0a6c393d__flashMessages')) { function _lb2e0a6c393d__flashMessages($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('flashMessages')
;$iterations = 0; foreach ($flashes as $flash): ?>        <div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo NTemplateHelpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ;
}}

//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb2b8f3ca0ba_sekce')) { function _lb2b8f3ca0ba_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbf29eb36e04_obsah')) { function _lbf29eb36e04_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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