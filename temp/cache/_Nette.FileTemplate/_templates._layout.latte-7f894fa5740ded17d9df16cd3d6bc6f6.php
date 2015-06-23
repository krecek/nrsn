<?php //netteCache[01]000355a:2:{s:4:"time";s:21:"0.81110600 1429537836";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:66:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/@layout.latte";i:2;i:1420221060;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/@layout.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '407tw4pqxs')
;
// prolog NUIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbb1bd3eb8a2_title')) { function _lbb1bd3eb8a2_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>GIS<?php call_user_func(reset($_l->blocks['subtitle']), $_l, get_defined_vars()) ; 
}}

//
// block subtitle
//
if (!function_exists($_l->blocks['subtitle'][] = '_lbbcae1364a7_subtitle')) { function _lbbcae1364a7_subtitle($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb145e218a3e_head')) { function _lb145e218a3e_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
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
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8" />
        <meta name="description" content="" />
<?php if (isset($robots)): ?>        <meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>

        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/nette.ajax.js"></script>
        
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/plupload/plupload.full.min.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/plupload/cs.js"></script>
                <link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/custom-theme-red/custom-theme/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/js/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css" />
        
        
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/tiny_mce/tiny_mce.js"></script>
        
        <!--<script src="<?php echo NTemplateHelpers::escapeHtmlComment($basePath) ?>/js/jquery-ui-1.10.3.custom.js"></script>-->
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/netteForms.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/live-form-validation.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/main.js"></script>
        <title><?php if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->striptags(ob_get_clean())  ?></title>

        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/screen.css" />
  <!--[if IE 7]>
 <link rel="stylesheet" href="<?php echo NTemplateHelpers::escapeHtmlComment($basePath) ?>/css/styleIE7.css">
<![endif]-->
<!--[if gte IE 9]>
<link rel="stylesheet" href="<?php echo NTemplateHelpers::escapeHtmlComment($basePath) ?>/css/styleIE9.css">
<![endif]-->
        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
        <link rel="stylesheet" media="print" href="<?php echo htmlSpecialChars($basePath) ?>/css/print.css" />
       	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" />
	<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

    </head>

    <body<?php if ($debugMod): ?> class="demo"<?php endif ?>>
        <div id="container">
            <script> document.documentElement.className+=' js' </script>
<?php if ($user->isLoggedIn()): ?>
            <div class="top inner"><span id="pos"><a class="home" title="Home" href="<?php echo htmlSpecialChars($_control->link("Homepage:")) ?>
"><span>&nbsp;</span></a></span>
                <div class="user">
                    <span class="icon_user"><a href="<?php echo htmlSpecialChars($_control->link("Osoby:prehled", array($user->getIdentity()->id))) ?>
"><?php echo NTemplateHelpers::escapeHtml($user->getIdentity()->username, ENT_NOQUOTES) ?></a></span>  |
                    <a href="<?php echo htmlSpecialChars($_control->link("odhlasit!")) ?>
">Odhlásit se</a>
                </div>

            </div>
            <div class="bgline"><div class="span3">&nbsp;</div><div class="span9 hlmenu"><?php $_ctrl = $_control->getComponent("hlavniMenu"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?></div><div class="cl">&nbsp;</div></div>
<?php endif ?>

<?php NUIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
            <div class="footer cl"></div>
        </div>
    </body>
</html>
