<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.88800800 1429786665";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Aplikace/default.latte";i:2;i:1396948242;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Aplikace/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'prrc7f5fo2')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb133add8b7b_content')) { function _lb133add8b7b_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($seznam_aplikaci) as $aplikace): if ($iterator->isFirst()): ?>
<ul><?php endif ?>

    <li><a href="<?php echo htmlSpecialChars($_presenter->link($aplikace['url'])) ?>
"><?php echo NTemplateHelpers::escapeHtml($aplikace['nazev'], ENT_NOQUOTES) ?></a></li>
    <?php if ($iterator->isLast()): ?></ul><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbfe56328a03_title')) { function _lbfe56328a03_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit">Aplikace</h1><?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lbc0e617c954_menu')) { function _lbc0e617c954_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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