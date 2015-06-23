<?php //netteCache[01]000378a:2:{s:4:"time";s:21:"0.26677100 1429979073";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:89:"/home/svn/repos/gymfed/trunk/app/WebModule/components/vysledky/vysledky_SG_druzstva.latte";i:2;i:1429979071;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/vysledky/vysledky_SG_druzstva.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'k3bbvcz38g')
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
<div class="vysledky">
<?php if ($vysledky): $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($vysledky) as $druzstvo): if ($iterator->isFirst()): ?>
    <table class="tablesorter">
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th colspan="3">Družstvo</th>
<?php $iterations = 0; foreach ($naradi as $nar=>$preklad_naradi): ?>
            <th colspan="4"><?php echo NTemplateHelpers::escapeHtml($preklad_naradi, ENT_NOQUOTES) ?></th>
<?php $iterations++; endforeach ?>
            <th>Celkem</th>
        </tr>
        </thead>
<?php endif ?>
        <tbody>
        <tr class="zahlavi">
            <th><?php echo NTemplateHelpers::escapeHtml($template->xml($druzstvo['poradi']), ENT_NOQUOTES) ?></th>
            <th colspan="3"><?php echo NTemplateHelpers::escapeHtml($template->xml($druzstvo['nazev_druzstva']), ENT_NOQUOTES) ?></th>
<?php $iterations = 0; foreach ($naradi as $nar=>$preklad_naradi): ?>
            <th>D</th>
            <th>E</th>
            <th>pen</th>
            <th><?php echo NTemplateHelpers::escapeHtml($preklad_naradi, ENT_NOQUOTES) ?></th>
<?php $iterations++; endforeach ?>
            <th>Celkem</th>
        </tr>
<?php $iterations = 0; foreach ($druzstvo['osoba'] as $vysledek): ?>
            <tr>
                <td>&nbsp;</td>
                <td><?php if ($vysledek['id']): ?><a href="<?php echo htmlSpecialChars($_presenter->link("Osoby:", array($vysledek['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['prijmeni']), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['jmeno']), ENT_NOQUOTES) ?></a>
                    <?php else: echo NTemplateHelpers::escapeHtml($template->xml($vysledek['prijmeni']), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['jmeno']), ENT_NOQUOTES) ?>

<?php endif ?>
                </td>
                <td><?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['rocnik']), ENT_NOQUOTES) ?></td>
                <td><?php if ($vysledek['oddil']): ?><a href="<?php echo htmlSpecialChars($template->xml($_presenter->link("Adresar:oddil", array($vysledek['oddil'])))) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['nazev_oddilu']), ENT_NOQUOTES) ?></a>
                    <?php else: echo NTemplateHelpers::escapeHtml($template->xml($vysledek['nazev_oddilu']), ENT_NOQUOTES) ?>

<?php endif ?>
                </td>
<?php $iterations = 0; foreach ($naradi as $nar=>$preklad_naradi): ?>
                <td><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek[$nar]['d'], 3), ENT_NOQUOTES) ?></td>
                <td><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek[$nar]['e'], 3), ENT_NOQUOTES) ?></td>
                <td><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek[$nar]['p'], 3), ENT_NOQUOTES) ?></td>
                <td><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek[$nar]['body'], 3), ENT_NOQUOTES) ?></td>
<?php $iterations++; endforeach ?>
                <td><b><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek['body'], 3), ENT_NOQUOTES) ?></b></td>
            </tr>
<?php $iterations++; endforeach ?>
            <tr>
                <td>&nbsp;</td>
                <td colspan="3"><b>celkem</b></td>
<?php $iterations = 0; foreach ($naradi as $nar=>$preklad_naradi): ?>
                    <td colspan="4"><b><?php echo NTemplateHelpers::escapeHtml($template->number($druzstvo[$nar."_body"], 3), ENT_NOQUOTES) ?></b></td>
<?php $iterations++; endforeach ?>
                    <td><b><?php echo NTemplateHelpers::escapeHtml($template->number($druzstvo['body'], 3), ENT_NOQUOTES) ?></b></td>    
            </tr>
    <?php if ($iterator->isLast()): ?></tbody></table><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;else: ?>Pro tuto kategorii nejsou výsledky k dispozici.
<?php endif ?>
</div>