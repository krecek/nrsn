<?php //netteCache[01]000355a:2:{s:4:"time";s:21:"0.27297600 1432628906";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:66:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/@layout.latte";i:2;i:1432628890;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/@layout.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'jm4gabvjw5')
;
// prolog NUIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb5c5ce69591_title')) { function _lb5c5ce69591_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb3d70183073_head')) { function _lb3d70183073_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block sirka_nadrazeneho_sloupce
//
if (!function_exists($_l->blocks['sirka_nadrazeneho_sloupce'][] = '_lb509126dd6d_sirka_nadrazeneho_sloupce')) { function _lb509126dd6d_sirka_nadrazeneho_sloupce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>9<?php
}}

//
// block topclanek
//
if (!function_exists($_l->blocks['topclanek'][] = '_lb93e6a47158_topclanek')) { function _lb93e6a47158_topclanek($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block levy_blok
//
if (!function_exists($_l->blocks['levy_blok'][] = '_lb51652c9340_levy_blok')) { function _lb51652c9340_levy_blok($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <!--levý blok-->
    <div class="box-4 hidden-print">
        <?php call_user_func(reset($_l->blocks['menu']), $_l, get_defined_vars())  ?>

        <?php call_user_func(reset($_l->blocks['calendar']), $_l, get_defined_vars())  ?>

<?php $_ctrl = $_control->getComponent("akce"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $_control->getComponent("terminovaListina"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
        
<?php NCoreMacros::includeTemplate("reklama.latte", $template->getParameters(), $_l->templates['jm4gabvjw5'])->render() ?>
    </div> 
<?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lb72029dea15_menu')) { function _lb72029dea15_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block calendar
//
if (!function_exists($_l->blocks['calendar'][] = '_lbc4b1ea7afd_calendar')) { function _lbc4b1ea7afd_calendar($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block sirka_stredniho_sloupce
//
if (!function_exists($_l->blocks['sirka_stredniho_sloupce'][] = '_lb5f453c88d4_sirka_stredniho_sloupce')) { function _lb5f453c88d4_sirka_stredniho_sloupce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>8<?php
}}

//
// block pravy_blok
//
if (!function_exists($_l->blocks['pravy_blok'][] = '_lb6fc8a9f5af_pravy_blok')) { function _lb6fc8a9f5af_pravy_blok($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="box-3 hidden-print">
    <!--    pravý blok-->
<?php $_ctrl = $_control->getComponent("vyhledavani"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $_control->getComponent("neprehlednete"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $_control->getComponent("post"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;NCoreMacros::includeTemplate("sponzori.latte", $template->getParameters(), $_l->templates['jm4gabvjw5'])->render() ?>
    <!--  -->  
	<?php call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars())  ?>
    </div>
<?php
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lb5c1c22dcfa_scripts')) { function _lb5c1c22dcfa_scripts($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block sportyMenu
//
if (!function_exists($_l->blocks['sportyMenu'][] = '_lb1c0cf3a637_sportyMenu')) { function _lb1c0cf3a637_sportyMenu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="description" content="" />
<?php if (isset($robots)): ?>        <meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>
        <title><?php if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->pomlcka($template->striptags(ob_get_clean()))  ?>Česká gymnastická federace</title>

        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery-ui-1.10.3.custom.js"></script>
        <!--<script src="<?php echo NTemplateHelpers::escapeHtmlComment($basePath) ?>/js/jquery.nette.js"></script>-->
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/nette.ajax.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/web.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/menu.js"></script>
        <script src="<?php echo htmlSpecialChars($basePath) ?>/js/lytebox/lytebox.js"></script>
        <script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/tablesorter/jquery.tablesorter.js"></script>
        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/custom-theme/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/js/lytebox/lytebox.css" type="text/css" media="screen" />
        <link rel="stylesheet" media="screen,projection,tv,print" href="<?php echo htmlSpecialChars($basePath) ?>/css/web.css" />
        <!--[if IE 7]>
        <link rel="stylesheet" href="<?php echo NTemplateHelpers::escapeHtmlComment($basePath) ?>/css/web-ie.css">
        <![endif]-->
         <!-- link rel="stylesheet" media="print" href="<?php echo NTemplateHelpers::escapeHtmlComment($basePath) ?>/css/print.css" -->
        <link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon2.ico" />
        <?php echo $pozadi ?>

	<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

    </head>

    
    <body>
        <script>
          (function(i,s,o,g,r,a,m){ i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          ( i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          } ) ( window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-52649305-2', 'auto');
          ga('send', 'pageview');
        </script>
      <div class="bgbody">
        <script> document.documentElement.className+=' js' </script>
        <div class="radek top">
        <div class="telo">
          <div class="bez"><a title="Home"  href="<?php echo htmlSpecialChars($_control->link("Homepage:")) ?>
"><img src="/css/cgf-logo.png" alt="Česká gymnastická federace" class="logo <?php if ($nazev_rubriky=="Česká gymnastická federace"): ?>
small<?php endif ?>" /></a><span class="topnadpis">Česká <span>gymnastická</span> federace</span></div>
          <div class="right"><?php $_ctrl = $_control->getComponent("navigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?></div> 
        </div>
        </div>
    <div class="telo obsah">
    <div class="radek"><div class="box-12">
<?php if ($nazev_rubriky=="Česká gymnastická federace"): ?>

<?php else: ?>
     <strong class="nadpis rubrika"><?php echo NTemplateHelpers::escapeHtml($nazev_rubriky, ENT_NOQUOTES) ?></strong>
<?php endif ?>
    </div></div>
	  <div class="radek">
    <div class="box-<?php call_user_func(reset($_l->blocks['sirka_nadrazeneho_sloupce']), $_l, get_defined_vars())  ?>">
         <?php call_user_func(reset($_l->blocks['topclanek']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['levy_blok']), $_l, get_defined_vars())  ?>
    <div class="box-<?php call_user_func(reset($_l->blocks['sirka_stredniho_sloupce']), $_l, get_defined_vars())  ?>">
        
<?php NUIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
    </div>
    </div>
<?php call_user_func(reset($_l->blocks['pravy_blok']), $_l, get_defined_vars())  ?>
    </div></div>
    
<div class="radek spodnilista hidden-print">
<div class="telo">
<div id="sporty_menu">
 <?php call_user_func(reset($_l->blocks['sportyMenu']), $_l, get_defined_vars())  ?>

 <ul class="menu-sporty2 <?php if ($nazev_rubriky=="Česká gymnastická federace"): ?>
homepg<?php endif ?>" id="sporty">
    <li class="box-8-menu sgm"><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('sportovni-gymnastika-muzi'))) ?>
"><span class="bga"></span><span>Gymnastika<br /> muži</span></a></li>
    <li class="box-8-menu sgz"><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('sportovni-gymnastika-zeny'))) ?>
"><span class="bga"></span><span>Gymnastika<br /> ženy</span></a></li>
    <li class="box-8-menu team"><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('teamgym'))) ?>
"><span class="bga"></span><span>Teamgym</span></a></li>
    <li class="box-8-menu aero"><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('aerobik'))) ?>
"><span class="bga"></span><span>Aerobik</span></a></li>
    <li class="box-8-menu akrobatic"><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('akrobaticka-gymnastika'))) ?>
"><span class="bga"></span><span>Akrobatická gymnastika</span></a></li>
    <li class="box-8-menu tramp"><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('skoky-na-trampoline'))) ?>
"><span class="bga"></span><span>Skoky na trampolíně</span></a></li>
    <li class="box-8-menu splh"><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('olympijsky-splh'))) ?>
"><span class="bga"></span><span>Olympijský<br /> šplh</span></a></li>
    <li class="box-8-menu vseob"><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('vseobecna-gymnastika'))) ?>
"><span class="bga"></span><span>Všeobecná gymnastika</span></a></li>

</ul>
 </div>
<div class="box-3 spodnilista">
<h3>Rychlý kontakt</h3>
<pre>
Česká gymnastická federace
Zátopkova 100/2
160 17 Praha 6

tel/fax: 242 429 260
mail:<a href="#">cgf@gymfed.cz</a>
<a href="<?php echo htmlSpecialChars($_control->link("Homepage:")) ?>">http://gymfed.cz</a>
<a href="https://plus.google.com/+GymfedCz/posts" rel="publisher">Google+</a>
</pre></div>

<div class="box-3 spodnilista">
<h3>Sporty</h3>
<ul>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('sportovni-gymnastika-muzi'))) ?>
"><span>Sportovní gymnastika muži</span></a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('sportovni-gymnastika-zeny'))) ?>
"><span>Sportovní gymnastika ženy</span></a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('teamgym'))) ?>
"><span>Teamgym</span></a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('aerobik'))) ?>
"><span>Aerobik</span></a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('akrobaticka-gymnastika'))) ?>
"><span>Akrobatická gymnastika</span></a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('skoky-na-trampoline'))) ?>
"><span>Skoky na trampolíně</span></a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('olympijsky-splh'))) ?>
"><span>Olympijský šplh</span></a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('vseobecna-gymnastika'))) ?>
"><span>Všeobecná gymnastika</span></a></li>

</ul> 
</div>
<div class="box-3 spodnilista">
<h3>Ostatní</h3>
<ul>
<li><a href="<?php echo htmlSpecialChars($_control->link("Archiv:")) ?>">Archiv článků</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Adresar:")) ?>">Adresář oddílů</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Clanky:default", array('16-stanovy-a-rady'))) ?>
">Stanovy a řády</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Homepage:rubriky", array('o-nas'))) ?>
">O nás</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Homepage:rubriky", array('media'))) ?>
">Média</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Homepage:rubriky", array('o-nas/zpravodaj-cgf'))) ?>
">Zpravodaj ČGF</a></li>
<li><a href="https://gis.gymfed.cz" target="_blank">GIS</a></li>
<li><a href="http://gymnastika.cstv.cz" target="_blank">Starý web</a></li>


</ul> 
</div>
<div class="box-3 spodnilista">
<div class="soc"><a class="rss" href="<?php echo htmlSpecialChars($_control->link("Homepage:rss")) ?>
"></a> 
                 <a href="https://www.facebook.com/CeskaGymnastickaFederace" target="_blank" class="fb"></a> 
                 <a href="https://plus.google.com/+GymfedCz/posts" rel="publisher" target="_blank" class="gp"></a> 
                 <a href="https://www.youtube.com/c/gymfedcz" target="_blank" class="yt"></a>
</div>
&copy; 2014 Česká gymnastická federace<br /> Všechna práva vyhrazena</div>
<div class="cl"></div>
</div>
</div>
      </div>
    </body>
</html>
