<?php //netteCache[01]000365a:2:{s:4:"time";s:21:"0.50175100 1435035681";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:76:"D:\xampp\htdocs\redakcni_system\app\AdminModule\templates\Redakce\base.latte";i:2;i:1433434638;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: D:\xampp\htdocs\redakcni_system\app\AdminModule\templates\Redakce\base.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '8vc064hefl')
;
// prolog NUIMacros
//
// block subtitle
//
if (!function_exists($_l->blocks['subtitle'][] = '_lb2c7373ff24_subtitle')) { function _lb2c7373ff24_subtitle($_l, $_args) { extract($_args)
?> - redakce<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba7500b1785_content')) { function _lba7500b1785_content($_l, $_args) { extract($_args)
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
if (!function_exists($_l->blocks['_flashMessages'][] = '_lb24f8f752ee__flashMessages')) { function _lb24f8f752ee__flashMessages($_l, $_args) { extract($_args); $_control->validateControl('flashMessages')
;$iterations = 0; foreach ($flashes as $flash): ?>        <div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo NTemplateHelpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ;
}}

//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb469c796763_sekce')) { function _lb469c796763_sekce($_l, $_args) { extract($_args)
;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb2a936053a5_obsah')) { function _lb2a936053a5_obsah($_l, $_args) { extract($_args)
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