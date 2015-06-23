<?php //netteCache[01]000359a:2:{s:4:"time";s:21:"0.47953800 1430304550";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:70:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/default.latte";i:2;i:1419947293;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '0xc6ad7tz8')
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
<?php $iterations = 0; foreach ($moznosti as $moznost): ?>
    <sluzba><?php echo NTemplateHelpers::escapeXml($moznost) ?></sluzba>
<?php $iterations++; endforeach ?>
</gis>