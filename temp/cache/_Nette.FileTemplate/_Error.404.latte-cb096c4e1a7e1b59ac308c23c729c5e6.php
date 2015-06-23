<?php //netteCache[01]000347a:2:{s:4:"time";s:21:"0.24963700 1429606138";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:58:"/home/svn/repos/gymfed/trunk/app/templates/Error/404.latte";i:2;i:1375116223;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/templates/Error/404.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'eakutozn0r')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbd65982c03f_content')) { function _lbd65982c03f_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<p>The page you requested could not be found. It is possible that the address is
incorrect, or that the page no longer exists. Please use a search engine to find
what you are looking for.</p>

<p><small>error 404</small></p>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb4677f7db13_title')) { function _lb4677f7db13_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Page Not Found</h1>
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
$robots = 'noindex' ?>

<?php if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 