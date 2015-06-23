<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.30025000 1429534079";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Homepage/default.latte";i:2;i:1415012701;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Homepage/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'jhecw956bp')
;
// prolog NUIMacros
//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb23b1860f54_head')) { function _lb23b1860f54_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><script src="<?php echo htmlSpecialChars($basePath) ?>/js/cycle/jquery.cycle.all.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle({
                fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
                containerResize: 0,
                fit: false,
                slideResize:1
        });
});
</script>
<?php
}}

//
// block topclanek
//
if (!function_exists($_l->blocks['topclanek'][] = '_lb3a2f25f2ed_topclanek')) { function _lb3a2f25f2ed_topclanek($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("topClanky"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb119884e882_content')) { function _lb119884e882_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("seznamClanku"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
<div width="100%" class="right"><a href="<?php echo htmlSpecialChars($_control->link("Archiv:default")) ?>
">další články</a></div>

<?php
}}

//
// block calendar
//
if (!function_exists($_l->blocks['calendar'][] = '_lbc6879bbfee_calendar')) { function _lbc6879bbfee_calendar($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("kalendar"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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
call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['topclanek']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['calendar']), $_l, get_defined_vars())  ?>

