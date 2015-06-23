<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.64700100 1429520478";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/WebModule/components/webMenu/webMenu.latte";i:2;i:1398666033;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/webMenu/webMenu.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'a2t4mr3c7j')
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

<ul class="menu naradek">
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:default")) ?>">Hlavní strana</a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('o-nas'))) ?>">O nás</a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('media'))) ?>">Media</a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Clanky:default", array('3-kontakt'))) ?>">Kontakt</a></li>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Homepage:rubriky", array('o-nas/zpravodaj-cgf'))) ?>">Zpravodaj ČGF</a></li>
    <li><a href="https://gis.gymfed.cz" target="_blank">GIS</a></li>
 
</ul>