<?php //netteCache[01]000363a:2:{s:4:"time";s:21:"0.69092300 1430426224";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:74:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Adresar/default.latte";i:2;i:1396947713;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Adresar/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'lmvvj8e49m')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9e8108485e_content')) { function _lb9e8108485e_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php $_ctrl = $_control->getComponent("adresarFiltr"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;if (isset($oddily)): $iterations = 0; foreach ($oddily as $oddil): ?>
      <div class="oddil">
        <a href="<?php echo htmlSpecialChars($_control->link("Adresar:Oddil", array($oddil['id']))) ?>
"><h3><?php echo NTemplateHelpers::escapeHtml($oddil['nazev'], ENT_NOQUOTES) ?></h3></a>
        <div>
                <?php echo NTemplateHelpers::escapeHtml($oddil['ulice'], ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($oddil['psc'], ENT_NOQUOTES) ?>  <?php echo NTemplateHelpers::escapeHtml($oddil['obec'], ENT_NOQUOTES) ?>

        </div>
      </div>
<?php $iterations++; endforeach ;endif ?>

<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb1681972853_title')) { function _lb1681972853_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit">Adresář oddílů</h1><?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lbe3abee107c_menu')) { function _lbe3abee107c_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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