<?php //netteCache[01]000360a:2:{s:4:"time";s:21:"0.23190900 1429781040";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:71:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/vysledky.latte";i:2;i:1428571673;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/M2m/vysledky.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'hgp5kynd75')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$netteHttpResponse->setHeader("Content-Type", 'application/xml') ;echo $obsah ?>

