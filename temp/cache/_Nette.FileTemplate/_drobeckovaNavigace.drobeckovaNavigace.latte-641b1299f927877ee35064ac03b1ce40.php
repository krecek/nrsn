<?php //netteCache[01]000386a:2:{s:4:"time";s:21:"0.99912400 1429520478";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:97:"/home/svn/repos/gymfed/trunk/app/WebModule/components/drobeckovaNavigace/drobeckovaNavigace.latte";i:2;i:1396870187;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/drobeckovaNavigace/drobeckovaNavigace.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '0w44ps6nj0')
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
<div class="naradek mini">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($items) as $item): ?>
       <a href="<?php echo htmlSpecialChars($_presenter->link($item['url'], array($item['parametry']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($item['nazev'], ENT_NOQUOTES) ?></a> <?php if (!$iterator->isLast()): ?>
&raquo;<?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</div>