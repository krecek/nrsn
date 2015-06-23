<?php //netteCache[01]000359a:2:{s:4:"time";s:21:"0.70021100 1430969183";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:70:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Archiv/roky.latte";i:2;i:1396948275;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Archiv/roky.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'heqj55p0u7')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb4c5a13178f_content')) { function _lb4c5a13178f_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<ul>
<?php $iterations = 0; foreach ($roky as $rok): ?>
    <li><a href="<?php echo htmlSpecialChars($_control->link("Archiv:default", array($rok))) ?>
">Archiv článků <?php echo NTemplateHelpers::escapeHtml($rok, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach ?>
</ul>
Zvolte rok, ve kterém byl článek vydán.

<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbddc1a74e6d_title')) { function _lbddc1a74e6d_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit">Archiv článků</h1><?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lbfcb9fc814b_menu')) { function _lbfcb9fc814b_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("menu"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof NPresenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['menu']), $_l, get_defined_vars()) ; 