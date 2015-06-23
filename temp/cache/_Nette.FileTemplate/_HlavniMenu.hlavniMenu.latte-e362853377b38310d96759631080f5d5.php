<?php //netteCache[01]000370a:2:{s:4:"time";s:21:"0.93855500 1429537844";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:81:"/home/svn/repos/gymfed/trunk/app/GisModule/components/HlavniMenu/hlavniMenu.latte";i:2;i:1407319263;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/components/HlavniMenu/hlavniMenu.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '55tes1k25p')
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
<ul>
<?php $iterations = 0; foreach ($items as $item=>$odkaz): ?>
    <li <?php if ($aktivni==$odkaz['odkaz']): ?> class="aktivni" <?php endif ?> ><a href="<?php echo htmlSpecialChars($_presenter->link($odkaz['odkaz'])) ?>
"><?php echo NTemplateHelpers::escapeHtml($item, ENT_NOQUOTES) ?></a> </li>
<?php $iterations++; endforeach ?>
</ul>
