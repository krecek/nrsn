<?php //netteCache[01]000372a:2:{s:4:"time";s:21:"0.62694400 1429534108";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:83:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Homepage/clanekNenalezen.latte";i:2;i:1396949214;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Homepage/clanekNenalezen.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '3tdfrmqs25')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbd54b661a49_content')) { function _lbd54b661a49_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

    <div class='clanek'>
    <p>Omlouváme se, ale požadovaný dokument nebyl nalezen.<br />
    Možnou příčinou je špatná adresa, neexistující nebo přesunutý dokument.<br />
    Pro vyhledání požadované stránky zkuste prosím použít hledání anebo navigační menu.</p>
    <p>Děkujeme za pochopení.</p>
    </div>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb7a930d6442_title')) { function _lb7a930d6442_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit">Článek nenalezen</h1><?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lbc2aacfd356_menu')) { function _lbc2aacfd356_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
?>

<?php if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['menu']), $_l, get_defined_vars()) ; 