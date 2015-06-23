<?php //netteCache[01]000374a:2:{s:4:"time";s:21:"0.67031600 1429802538";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:85:"/home/svn/repos/gymfed/trunk/app/GisModule/components/PrehledPrav/nastaveniPrav.latte";i:2;i:1384333686;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/components/PrehledPrav/nastaveniPrav.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'cjfwhxuzzu')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<table>
    <tr>
        <th>Jméno:</th>
        <td><?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?></td>
    </tr>
    <tr>
        <th>Evidenční číslo:</th>
        <td><?php echo NTemplateHelpers::escapeHtml($osoba['id'], ENT_NOQUOTES) ?></td>
    </tr>
    <tr>
        <th>Rok narození:</th>
        <td><?php echo NTemplateHelpers::escapeHtml($template->date($osoba['narozeni'], 'Y'), ENT_NOQUOTES) ?></td>
    </tr>

    <tr>
        <th>Uživatelské jméno:</th>
        <td><?php echo NTemplateHelpers::escapeHtml($osoba['username'], ENT_NOQUOTES) ?></td>
    </tr>
    <tr>
        <th>Adresa:</th>
        <td><?php echo NTemplateHelpers::escapeHtml($osoba['ulice'], ENT_NOQUOTES) ;if ($osoba['ulice']): ?>
,<?php endif ?> <?php echo NTemplateHelpers::escapeHtml($osoba['obec'], ENT_NOQUOTES) ?>
 <?php if ($osoba['obec']): ?>,<?php endif ?> <?php echo NTemplateHelpers::escapeHtml($osoba['psc'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
    <tr>
        <th>Telefon:</th>
        <td><?php echo NTemplateHelpers::escapeHtml($osoba['mobil'], ENT_NOQUOTES) ;if ($osoba['mobil']&&$osoba['telefon']): ?>
, <?php endif ?> <?php echo NTemplateHelpers::escapeHtml($osoba['telefon'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
    <tr>
        <th>Email:</th>
        <td><?php echo NTemplateHelpers::escapeHtml($osoba['email'], ENT_NOQUOTES) ?>&nbsp;</td>
    </tr>
</table>
<?php $_ctrl = $_control->getComponent("nastaveniPravForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;