<?php //netteCache[01]000381a:2:{s:4:"time";s:21:"0.17746800 1429787373";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:92:"/home/svn/repos/gymfed/trunk/app/WebModule/components/vysledky/vysledky_SG_jednotlivci.latte";i:2;i:1429787103;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/vysledky/vysledky_SG_jednotlivci.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '3ytu87cm4o')
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
<script>
       $(function() {
                $("table.tablesorter")
                        .tablesorter( { widthFixed: true, widgets: ['zebra'] } );
        });
</script>
<div class="vysledky">
<?php if ($vysledky): NDebugger::barDump(array('$vysledky' => $vysledky), "Template " . str_replace(dirname(dirname($template->getFile())), "\xE2\x80\xA6", $template->getFile())) ?>
        <table cellspacing="1" class="tablesorter clickselect" >
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Jméno</th>
                    <th>Ročník</th>
                    <th>Oddíl</th>
                    <th>Trenér</th>
<?php $iterations = 0; foreach ($naradi as $nar=>$preklad_naradi): ?>
                    <th>D</th>
                    <th>E</th>
                    <th>pen</th>
                    <th><?php echo NTemplateHelpers::escapeHtml($preklad_naradi, ENT_NOQUOTES) ?></th>
<?php $iterations++; endforeach ?>
                    <th>Celkem</th>
                </tr>
            </thead>
            <tbody>
<?php $iterations = 0; foreach ($vysledky as $vysledek): ?>
                <tr>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['poradi']), ENT_NOQUOTES) ?>.</td>
                    <td><?php if ($vysledek['id']): ?><a href="<?php echo htmlSpecialChars($_presenter->link("Osoby:", array($vysledek['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['prijmeni']), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['jmeno']), ENT_NOQUOTES) ?></a>
                <?php else: echo NTemplateHelpers::escapeHtml($template->xml($vysledek['prijmeni']), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['jmeno']), ENT_NOQUOTES) ?>

<?php endif ?>
                    </td>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['rocnik']), ENT_NOQUOTES) ?></td>
                    <td><?php if ($vysledek['oddil']): ?><a href="<?php echo htmlSpecialChars($_presenter->link("Adresar:oddil", array($vysledek['oddil']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->xml($vysledek['nazev_oddilu']), ENT_NOQUOTES) ?></a>
                <?php else: echo NTemplateHelpers::escapeHtml($template->xml($vysledek['nazev_oddilu']), ENT_NOQUOTES) ?>

<?php endif ?>
                    </td>
                    <td><?php if ($vysledek['trener']): echo NTemplateHelpers::escapeHtml($template->xml($vysledek['trener']), ENT_NOQUOTES) ;endif ?></td>
<?php $iterations = 0; foreach ($naradi as $nar=>$preklad_naradi): ?>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek[$nar."_d"], 3), ENT_NOQUOTES) ?></td>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek[$nar."_e"], 3), ENT_NOQUOTES) ?></td>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek[$nar."_p"], 3), ENT_NOQUOTES) ?></td>
                    <td><b><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek[$nar."_body"], 3), ENT_NOQUOTES) ?></b></td>
<?php $iterations++; endforeach ?>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->number($vysledek['body'], 3), ENT_NOQUOTES) ?></td>
                </tr>
<?php $iterations++; endforeach ?>

            </tbody>
        </table>
<?php else: ?>Pro tuto kategorii nejsou výsledky k dispozici.
<?php endif ?>
    </div>