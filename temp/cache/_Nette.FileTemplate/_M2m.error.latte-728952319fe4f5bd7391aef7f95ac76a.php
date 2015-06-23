<?php //netteCache[01]000357a:2:{s:4:"time";s:21:"0.21944800 1429609577";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:68:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/error.latte";i:2;i:1419947299;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/error.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'ri8tloj865')
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
    <error><?php echo NTemplateHelpers::escapeXml($error) ?></error>
</gis>