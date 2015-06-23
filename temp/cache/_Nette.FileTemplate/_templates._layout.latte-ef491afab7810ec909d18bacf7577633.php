<?php //netteCache[01]000360a:2:{s:4:"time";s:21:"0.63980900 1435035285";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:71:"D:\xampp\htdocs\redakcni_system\app\AdminModule\templates\@layout.latte";i:2;i:1433434639;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: D:\xampp\htdocs\redakcni_system\app\AdminModule\templates\@layout.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '2akebfgl1p')
;
// prolog NUIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb56f505e53b_title')) { function _lb56f505e53b_title($_l, $_args) { extract($_args)
?>GIS<?php call_user_func(reset($_l->blocks['subtitle']), $_l, get_defined_vars()) ; 
}}

//
// block subtitle
//
if (!function_exists($_l->blocks['subtitle'][] = '_lbc03a6f4dc2_subtitle')) { function _lbc03a6f4dc2_subtitle($_l, $_args) { extract($_args)
;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbcdb30e3cbf_head')) { function _lbcdb30e3cbf_head($_l, $_args) { extract($_args)
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
