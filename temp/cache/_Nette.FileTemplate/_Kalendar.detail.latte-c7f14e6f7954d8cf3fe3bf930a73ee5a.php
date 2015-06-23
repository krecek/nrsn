<?php //netteCache[01]000363a:2:{s:4:"time";s:21:"0.02287600 1429534774";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:74:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Kalendar/detail.latte";i:2;i:1428910538;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Kalendar/detail.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'meny8g2m3g')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb04423283a3_content')) { function _lb04423283a3_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
<?php $_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(explode(', ',$akce['sport'])) as $zkr): ?>
<b><?php echo NTemplateHelpers::escapeHtml($sporty[$zkr], ENT_NOQUOTES) ;if (!$iterator->isLast()): ?>
, <?php endif ?></b><?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?><br />
<img src="<?php echo htmlSpecialChars($basePath) ?>/css/datum.png" />&nbsp;<?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?><br />
<?php if ($akce['misto']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/location.png" />&nbsp;pořadatel: <?php echo NTemplateHelpers::escapeHtml($akce['misto'], ENT_NOQUOTES) ?>
<br /><?php endif ?>

<?php if ($akce['adresa']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/map.png" />&nbsp;adresa: <?php echo NTemplateHelpers::escapeHtml($akce['adresa'], ENT_NOQUOTES) ?>
<br /><?php endif ?>

<?php if ($akce['uzavirka_prihlasek']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/pencil.png" />&nbsp;přihlášky <?php if ($akce['elektronicke_prihlasky']): ?>
<a href="<?php echo htmlSpecialChars($akce['adresa_prihlasek']) ?>">prostřednictvím GISu</a> <?php endif ?>
do <?php echo NTemplateHelpers::escapeHtml($template->date($akce['uzavirka_prihlasek'], 'j.n.Y'), ENT_NOQUOTES) ?>
<br /><?php endif ?>

<?php if ($existuji_vysledky): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/medaile.png" />&nbsp;<a href="<?php echo htmlSpecialChars($_control->link("Vysledky:detail", array($akce['id']))) ?>
">elektronické výsledky</a><?php endif ?>

<?php if ($akce['popis']): ?><br /><?php echo nl2br(htmlspecialchars($akce['popis'])) ;endif ?>

<?php $_ctrl = $_control->getComponent("seznamPriloh"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
<br />
<div class="fb-like" data-href="<?php echo htmlSpecialChars($_control->link("Kalendar:detail", array($akce['id']))) ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
 </div><?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb61fd034c78_title')) { function _lb61fd034c78_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit"><?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?>
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