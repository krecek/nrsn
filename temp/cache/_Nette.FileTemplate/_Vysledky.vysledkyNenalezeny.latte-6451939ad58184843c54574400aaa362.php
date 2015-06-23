<?php //netteCache[01]000375a:2:{s:4:"time";s:21:"0.17119300 1429786197";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:86:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Vysledky/vysledkyNenalezeny.latte";i:2;i:1429786195;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Vysledky/vysledkyNenalezeny.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'pnim1o072j')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb488bc6e7ed_content')) { function _lb488bc6e7ed_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

    <div class='clanek'>
    <p>Omlouváme se, ale elektronické výsledky této akce nebyly nalezeny.<br />
      Pravděpodobně nejsou nahrány do systému.</p>
    <p>Děkujeme za pochopení.</p>
    </div><?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbf808aecc79_title')) { function _lbf808aecc79_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit">Elektronické výsledky - <?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?>
</h1><?php
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
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 