<?php //netteCache[01]000372a:2:{s:4:"time";s:21:"0.59265000 1429539382";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:83:"/home/svn/repos/gymfed/trunk/app/GisModule/components/PrehledPrav/prehledPrav.latte";i:2;i:1393240044;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/components/PrehledPrav/prehledPrav.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'vp8ababe76')
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
        <th>Jméno</th>
        <th>Uživatelské jméno</th>
        <th>Oprávnění</th>
        <th></th>
    </tr>
<?php $iterations = 0; foreach ($osoby as $osoba): ?>
    <tr class="radek">
         <td><?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?></td>
         <td><?php echo NTemplateHelpers::escapeHtml($osoba['username'], ENT_NOQUOTES) ?>&nbsp;</td>
        <td><?php echo NTemplateHelpers::escapeHtml($osoba['uroven'], ENT_NOQUOTES) ?></td>
        <td><?php if ($osoba['uroven']< $pravo_uzivatele || $osoba['uroven']< $admin): ?>

<?php if (isset($id)): ?>
                <a href='<?php echo htmlSpecialChars($_presenter->link("nastaveniPrav", array("osoba"=>"{$osoba['osoba']}", "id"=>"{$id}")), ENT_QUOTES) ?>'>
<?php else: ?>
               <a href='<?php echo htmlSpecialChars($_presenter->link("nastaveniPrav", array("osoba"=>"{$osoba['osoba']}")), ENT_QUOTES) ?>'>
<?php endif ?>
                   Upravit</a><?php else: ?>&nbsp;<?php endif ?></td>
    </tr>
<?php $iterations++; endforeach ?>
</table>