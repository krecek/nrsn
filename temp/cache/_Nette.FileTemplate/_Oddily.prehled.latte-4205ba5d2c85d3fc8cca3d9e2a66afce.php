<?php //netteCache[01]000362a:2:{s:4:"time";s:21:"0.40218700 1429540062";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:73:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Oddily/prehled.latte";i:2;i:1409741241;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Oddily/prehled.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'tzivig2123')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb90418cf7f1_sekce')) { function _lb90418cf7f1_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Výpis oddílu - <?php echo NTemplateHelpers::escapeHtml($oddil['nazev'], ENT_NOQUOTES) ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbf67eea5a19_obsah')) { function _lbf67eea5a19_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><table>
    <tr>
        <td>Název oddílu: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['nazev'], ENT_NOQUOTES) ?></td>
    </tr>
    <tr>
        <td>Číslo oddílu</td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['id'], ENT_NOQUOTES) ?></td>
    </tr>
    <tr>
        <td>IČ: </td>
        <td><?php if ($oddil['ic']): echo NTemplateHelpers::escapeHtml($oddil['ic'], ENT_NOQUOTES) ;endif ?>&nbsp;</td>
    </tr>
       <tr>
        <td>Adresa: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['ulice'], ENT_NOQUOTES) ;if ($oddil['ulice']): ?>
, <?php endif ;echo NTemplateHelpers::escapeHtml($oddil['obec'], ENT_NOQUOTES) ;if ($oddil['obec']): ?>
, <?php endif ;echo NTemplateHelpers::escapeHtml($oddil['psc'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
    </tr>
       <tr>
        <td>Korespondenční adresa: </td>
        <td><?php if ($oddil->korespondencni_adresa['jmeno']): echo NTemplateHelpers::escapeHtml($oddil->korespondencni_adresa['jmeno'], ENT_NOQUOTES) ?>
, <?php endif ;echo NTemplateHelpers::escapeHtml($oddil->korespondencni_adresa['ulice'], ENT_NOQUOTES) ;if ($oddil->korespondencni_adresa['ulice']): ?>
, <?php endif ;echo NTemplateHelpers::escapeHtml($oddil->korespondencni_adresa['obec'], ENT_NOQUOTES) ;if ($oddil->korespondencni_adresa['obec']): ?>
, <?php endif ;echo NTemplateHelpers::escapeHtml($oddil->korespondencni_adresa['psc'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
    <tr>
        <td>Kraj: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($template->kraj($oddil['kraj']), ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
    <tr>
        <td>Telefon: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['mobil'], ENT_NOQUOTES) ;if ($oddil['mobil']&&$oddil['telefon']): ?>
, <?php endif ;echo NTemplateHelpers::escapeHtml($oddil['telefon'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
    <tr>
        <td>E-mail: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['email'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
    <tr>
        <td>Web: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['web'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>

    <tr>
        <td>Číslo účtu: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['banka'], ENT_NOQUOTES) ;if ($oddil['vs']): ?>
, VS: <?php echo NTemplateHelpers::escapeHtml($oddil['vs'], ENT_NOQUOTES) ?> <?php endif ?>&nbsp;</td>
    </tr>
    <tr>
        <td>Registrace MVČR: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['regmv'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
    <tr>
        <td>Střešní organizace: </td>
        <td><?php echo NTemplateHelpers::escapeHtml($template->sdruzeni($oddil['sdruzeni']), ENT_NOQUOTES) ?></td>
    </tr>
    <tr>
        <td>Sporty:</td>
        <td><?php echo NTemplateHelpers::escapeHtml($oddil['sporty'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
</table>
<?php if ($admin): ?>
<div class="bottom_nav">
    <?php if ($opravneni['edit']): ?><a href="<?php echo htmlSpecialChars($_control->link("edit", array($oddil['id']))) ?>
">Upravit</a><?php endif ?>

   <?php if ($opravneni['evidence_view']): ?><a href="<?php echo htmlSpecialChars($_control->link("evidence", array($oddil['id']))) ?>
">Evidence členů</a><?php endif ?>

   
    <?php if ($opravneni['registrace_view']): ?><a href="<?php echo htmlSpecialChars($_control->link("registrace", array($oddil['id']))) ?>
">Registrace závodníků</a><?php endif ?>

    <?php if ($opravneni['delete']): if ($oddil['platne']=='A'): ?>
    <a onclick="if (!confirm('Opravdu smazat oddíl?')) return false;" href="<?php echo htmlSpecialChars($_control->link("delete", array($oddil['id']))) ?>
">Smazat oddíl</a>
<?php else: ?>
    <a href="<?php echo htmlSpecialChars($_control->link("obnovit", array($oddil['id']))) ?>
">Obnovit oddíl</a>
    <?php endif ;endif ?>

</div>
<?php endif ;
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