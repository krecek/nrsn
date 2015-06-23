<?php //netteCache[01]000361a:2:{s:4:"time";s:21:"0.62116600 1429793708";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/detail.latte";i:2;i:1429793707;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/detail.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'xeoyl5wz3u')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb91b391d2b6_sekce')) { function _lb91b391d2b6_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb1ef30d9ddb_obsah')) { function _lb1ef30d9ddb_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><table>
    <tr>
        <td>Název:</td>
        <td><?php echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ?></td>
    </tr>
    <tr>
        <td>Datum:</td>
        <td><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?></td>
    </tr>
<?php if ($poradatel_preklad): ?>
    <tr>
        <td>Pořadatel:</td>
        <td><?php echo NTemplateHelpers::escapeHtml($poradatel_preklad, ENT_NOQUOTES) ?></td>
    </tr>
<?php endif ?>
    <tr>
        <td>Místo:</td>
        <td><?php echo NTemplateHelpers::escapeHtml($akce->misto, ENT_NOQUOTES) ?></td>
    </tr>
<?php if ($akce->adresa): ?>
    <tr>
        <td>Adresa:</td>
        <td><?php echo NTemplateHelpers::escapeHtml($akce->adresa, ENT_NOQUOTES) ?></td>
    </tr>
<?php endif ?>
    <tr>
        <td>Sport:</td>
        <td><?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(explode(', ',$akce->sport)) as $zkr): echo NTemplateHelpers::escapeHtml($sporty[$zkr], ENT_NOQUOTES) ;if (!$iterator->isLast()): ?>
, <?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?></td>
    </tr>
<?php if ($akce->popis): ?>
    <tr>
        <td>Popis:</td>
        <td><?php echo NTemplateHelpers::escapeHtml($akce->popis, ENT_NOQUOTES) ?></td>
    </tr>
<?php endif ;if ($akce->ubytovani=='A'): ?>
    <tr>
        <td>Možnost ubytování:</td>
        <td>Ano</td>
    </tr>
<?php endif ;if ($akce->uzavirka_prihlasek): ?>
    <tr>
        <td>Přihlášky do:</td>
        <td><?php echo NTemplateHelpers::escapeHtml($template->date($akce->uzavirka_prihlasek, 'j.n.Y'), ENT_NOQUOTES) ?></td>
    </tr>
<?php endif ?>
</table>

<div class="bottom_nav">
<?php if ($opravneni['edit']): ?>
<a href="<?php echo htmlSpecialChars($_control->link("edit", array($akce->id))) ?>
">Upravit</a>
<a href="<?php echo htmlSpecialChars($_control->link("prilohy", array($akce->id))) ?>
">Přílohy</a>
<a href="<?php echo htmlSpecialChars($_control->link("kategorie", array($akce->id))) ?>
">Kategorie</a>
<?php if ($opravneni['prihlasky']): ?><a href="<?php echo htmlSpecialChars($_control->link("seznamPrihlasek", array($akce->id))) ?>
">Startovka</a><?php endif ?>

<a href="<?php echo htmlSpecialChars($_control->link("vysledky", array($akce->id))) ?>
">El. výsledky</a>
<a onclick="if(!confirm('Opravdu archivovat tuto akci? Archivované akce již nelze upravovat.')) return false;" href="<?php echo htmlSpecialChars($_control->link("archivovat", array($akce->id))) ?>
">Archivovat</a>
<?php endif ;if ($opravneni['delete']): ?>
<a onclick="if(!confirm('Opravdu smazat tuto akci? Tento krok je nevratný. Případné přihlášky budou zrušeny a oddílům zaslána informace e-mailem.')) return false;" href="<?php echo htmlSpecialChars($_control->link("delete", array($akce->id))) ?>
">Smazat</a>
<?php endif ?>
</div>
<?php $_ctrl = $_control->getComponent("seznamPriloh"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = 'base.latte'; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
 if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars()) ; 