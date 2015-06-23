<?php //netteCache[01]000361a:2:{s:4:"time";s:21:"0.79017400 1429781019";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/startovka.latte";i:2;i:1428681070;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/startovka.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'hf5gnkr7ts')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$netteHttpResponse->setHeader("Content-Type", 'application/xml') ?>
<<?php ?>?xml version="1.0" encoding="UTF-8"?>
<gis>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($kategorie) as $id=>$kat): ?>
    <kategorie>
        <id><?php echo NTemplateHelpers::escapeXml($id) ?></id>
        <nazev><?php echo NTemplateHelpers::escapeXml($kat->nazev) ?></nazev>
        <sport><?php echo NTemplateHelpers::escapeXml($kat->sport) ?></sport>
        <typ><?php if ($kat->druzstvo==1): ?>jednotlivci<?php else: ?>družstva<?php endif ?></typ>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($kat['prihlasky']) as $prihlaska): ?>
        <?php if ($iterator->isFirst()): if ($kat->druzstvo<>1): ?>
        <druzstvo>
            <id><?php echo NTemplateHelpers::escapeXml($prihlaska['druzstvo']) ?></id>
            <nazev><?php echo NTemplateHelpers::escapeXml($prihlaska['nazev_druzstva']) ?></nazev>
            <druzstvo_oddil><?php echo NTemplateHelpers::escapeXml($prihlaska['druzstvo_oddil']) ?></druzstvo_oddil>
            <druzstvo_nazev_oddilu><?php echo NTemplateHelpers::escapeXml($prihlaska['druzstvo_nazev_oddilu']) ?>
</druzstvo_nazev_oddilu><?php endif ?>

<?php endif ?>
            <osoba>
                <id><?php echo NTemplateHelpers::escapeXml($prihlaska['osoba']) ?></id>
                <jmeno><?php echo NTemplateHelpers::escapeXml($prihlaska['jmeno']) ?></jmeno>
                <prijmeni><?php echo NTemplateHelpers::escapeXml($prihlaska['prijmeni']) ?></prijmeni>
                <rocnik><?php echo NTemplateHelpers::escapeXml($prihlaska['rocnik']) ?></rocnik>
                <trener><?php echo NTemplateHelpers::escapeXml($prihlaska['trener']) ?></trener>
                <oddil><?php echo NTemplateHelpers::escapeXml($prihlaska['oddil']) ?></oddil>
                <nazev_oddilu><?php echo NTemplateHelpers::escapeXml($prihlaska['nazev_oddilu']) ?></nazev_oddilu>
                <poznamka><?php echo NTemplateHelpers::escapeXml($prihlaska['poznamka']) ?></poznamka>
            </osoba>
<?php if ($iterator->isLast()): if ($kat->druzstvo<>1): ?>
       </druzstvo>
<?php endif ;endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

    </kategorie>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</gis>