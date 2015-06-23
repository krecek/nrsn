<?php //netteCache[01]000356a:2:{s:4:"time";s:21:"0.46979300 1429789030";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:67:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/akce.latte";i:2;i:1420028304;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/akce.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'zn9cta3x3p')
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
<?php $iterations = 0; foreach ($seznam_akci as $akce): ?>
    <akce>
        <id><?php echo NTemplateHelpers::escapeXml($akce->id) ?></id>
        <nazev><?php echo NTemplateHelpers::escapeXml($akce->nazev) ?></nazev>
        <od><?php echo NTemplateHelpers::escapeXml($template->date($akce->od, 'Y-m-d')) ?></od>
        <do><?php echo NTemplateHelpers::escapeXml($template->date($akce->do, "Y-m-d")) ?></do>
        <misto><?php echo NTemplateHelpers::escapeXml($akce->misto) ?></misto>
        <organizator><?php echo NTemplateHelpers::escapeXml($akce->organizator) ?></organizator>
        <sport><?php echo NTemplateHelpers::escapeXml($akce->sport) ?></sport>
        <popis><?php echo NTemplateHelpers::escapeXml($akce->popis) ?></popis>
    </akce>
<?php $iterations++; endforeach ?>
</gis>
