<?php //netteCache[01]000361a:2:{s:4:"time";s:21:"0.76144800 1429537836";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Login/default.latte";i:2;i:1409307426;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Login/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '11db26vvzq')
;
// prolog NUIMacros
//
// block subtitle
//
if (!function_exists($_l->blocks['subtitle'][] = '_lb2772abd75b_subtitle')) { function _lb2772abd75b_subtitle($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> - přihlásit<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb69ec8a8145_content')) { function _lb69ec8a8145_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$iterations = 0; foreach ($flashes as $flash): ?><div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo NTemplateHelpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>
<div id="prihlasovani">
<h1>Přihlásit</h1>
<?php $_ctrl = $_control->getComponent("loginForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
<div class="center">
<a href="<?php echo htmlSpecialChars($_control->link("Heslo:zapomenuteHeslo")) ?>
">Zapoměli jste heslo?</a>
</div>
<p>SVN Revision <?php echo NTemplateHelpers::escapeHtml($verze, ENT_NOQUOTES) ?></p>
</div>
<?php
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
$robots = 'noindex' ;if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['subtitle']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 