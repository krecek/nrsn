<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.76541100 1429520478";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/WebModule/components/podmenu/podmenu.latte";i:2;i:1396269845;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/podmenu/podmenu.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'agxft3dafj')
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
<h2>Menu</h2>
<ul class="naradek blok">
<?php $iterations = 0; foreach ($items as $item): ?>
    <li><a href="<?php echo htmlSpecialChars($item['url']) ?>"><?php echo NTemplateHelpers::escapeHtml($item['nazev'], ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach ?>
</ul>