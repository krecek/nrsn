<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.18505100 1429529912";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Vyhledat/default.latte";i:2;i:1415080888;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Vyhledat/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '65mb0ixhpg')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb7a70701f43_content')) { function _lb7a70701f43_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php $_ctrl = $_control->getComponent("seznamClanku"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($akce) as $ak): if ($iterator->isFirst()): ?>
        <div>
            <h2>Akce</h2>
            <ul>
<?php endif ?>
                <li><a href="<?php echo htmlSpecialChars($_control->link("Kalendar:detail", array($ak['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($ak['nazev'], ENT_NOQUOTES) ?> (<?php echo NTemplateHelpers::escapeHtml($template->datumKonani($ak['od'], $ak['do']), ENT_NOQUOTES) ?>)</a></li>
<?php if ($iterator->isLast()): ?>
            </ul>
        </div>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($oddily) as $oddil): if ($iterator->isFirst()): ?>
        <div>
            <h2>Oddíly</h2>
            <ul>
<?php endif ?>
                <li><a href="<?php echo htmlSpecialChars($_control->link("Adresar:oddil", array($oddil['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($oddil['nazev'], ENT_NOQUOTES) ?></a></li> 
<?php if ($iterator->isLast()): ?>
            </ul>
        </div> 
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($osoby) as $osoba): if ($iterator->isFirst()): ?>
        <div>
            <h2>Osoby</h2>
            <ul>
<?php endif ?>
               <li><a href="<?php echo htmlSpecialChars($_control->link("Osoby:default", array($osoba['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?> <?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?></a></li>
<?php if ($iterator->isLast()): ?>
            </ul>
        </div>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb3141528c6d_title')) { function _lb3141528c6d_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit">Výsledky vyhledávání</h1><?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lb2654964051_menu')) { function _lb2654964051_menu($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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