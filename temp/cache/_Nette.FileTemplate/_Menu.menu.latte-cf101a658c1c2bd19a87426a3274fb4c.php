<?php //netteCache[01]000358a:2:{s:4:"time";s:21:"0.95976400 1429537844";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:69:"/home/svn/repos/gymfed/trunk/app/GisModule/components/Menu/menu.latte";i:2;i:1378835560;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/components/Menu/menu.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'v6ft36mq54')
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
<nav class="span3">
<ul class="nav">
<?php $iterations = 0; foreach ($items as $item=>$odkaz): if ($odkaz['parametry']): ?>
    <li><a href="<?php echo htmlSpecialChars($_presenter->link($odkaz['odkaz'], array($odkaz['parametry']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($item, ENT_NOQUOTES) ?></a> </li>
<?php else: ?>
   <li><a href="<?php echo htmlSpecialChars($_presenter->link($odkaz['odkaz'])) ?>
"><?php echo NTemplateHelpers::escapeHtml($item, ENT_NOQUOTES) ?></a> </li>
<?php endif ;$iterations++; endforeach ?>
 
</ul>
</nav>