<?php //netteCache[01]000362a:2:{s:4:"time";s:21:"0.62654700 1429785157";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:73:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Clanky/default.latte";i:2;i:1407848902;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Clanky/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'w64jc86vm8')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbb2cef89492_content')) { function _lbb2cef89492_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
<div>
<?php $_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
    <div class='clanek'>    
    <?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

        <p><em>
        <?php echo NTemplateHelpers::escapeHtml($clanek['perex'], ENT_NOQUOTES) ?>

        </em></p>
        <?php if ($clanek['obr'] && $clanek['zobrazit_obr']=='A'): ?><img src="<?php echo htmlSpecialChars($basePath) ;echo htmlSpecialChars($clanek['url_obrazku']) ?>
" class="hl_foto" /><?php endif ?>

        <span class="publikovano">Publikováno: <?php echo NTemplateHelpers::escapeHtml($template->datumClanku($clanek->zobrazit_od), ENT_NOQUOTES) ;if ($clanek['upravil']): ?>
 (upraveno <?php echo NTemplateHelpers::escapeHtml($template->datumClanku($clanek['upraveno']), ENT_NOQUOTES) ?>
)<?php endif ?></span>
        <div>
            <?php echo $clanek['obsah'] ?>

        </div>
        <div class="vlozil">Článek vložil: <?php echo NTemplateHelpers::escapeHtml($autor['jmeno'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($autor['prijmeni'], ENT_NOQUOTES) ?> <div class="fb-like" data-href="<?php echo htmlSpecialChars($_control->link("Clanky:default", array($clanek['url']))) ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div></div>
<?php if ($clanek['galerie']=='A'): $_ctrl = $_control->getComponent("galerie"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;if ($clanek['prilohy']=='A'): $_ctrl = $_control->getComponent("seznamPriloh"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ?>
			</div>
    <h3 class="oddelit tecky">Související články</h3>
    <div class="podobne_clanky">
<?php $_ctrl = $_control->getComponent("souvisejiciClanky"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
    </div>
</div>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbf3d8ebf15d_title')) { function _lbf3d8ebf15d_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit"><?php echo NTemplateHelpers::escapeHtml($clanek['nadpis'], ENT_NOQUOTES) ?>
</h1><?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lbad65983ea8_menu')) { function _lbad65983ea8_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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