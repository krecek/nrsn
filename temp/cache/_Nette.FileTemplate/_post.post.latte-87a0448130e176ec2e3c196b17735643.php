<?php //netteCache[01]000358a:2:{s:4:"time";s:21:"0.19817600 1429520518";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:69:"/home/svn/repos/gymfed/trunk/app/WebModule/components/post/post.latte";i:2;i:1402060563;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/post/post.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'pfiu12lgaq')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($clanek['obsah']): ?>
<div class='notice'>
<div><h4><?php echo NTemplateHelpers::escapeHtml($clanek['perex'], ENT_NOQUOTES) ?></h4></div>
<?php echo $clanek['obsah'] ?>

</div>
<?php endif ;