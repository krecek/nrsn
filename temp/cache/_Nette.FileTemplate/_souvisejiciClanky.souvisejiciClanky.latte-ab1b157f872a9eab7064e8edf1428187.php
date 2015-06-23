<?php //netteCache[01]000384a:2:{s:4:"time";s:21:"0.90029800 1429785167";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:95:"/home/svn/repos/gymfed/trunk/app/WebModule/components/souvisejiciClanky/souvisejiciClanky.latte";i:2;i:1396344886;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/souvisejiciClanky/souvisejiciClanky.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '2uwsfribrp')
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
<div class='pg-clanky'>
  <ul>
<?php $iterations = 0; foreach ($clanky as $clanek): ?>
        <!--div class="clanek vypis">
         <a href="<?php echo NTemplateHelpers::escapeHtmlComment($_presenter->link("Clanky:", array($clanek['url']))) ?>">
             <strong><?php echo NTemplateHelpers::escapeHtmlComment($clanek['nadpis']) ?></strong>
         </a>   
        </div -->
        <li><a href="<?php echo htmlSpecialChars($_presenter->link("Clanky:", array($clanek['url']))) ?>">
        <?php echo NTemplateHelpers::escapeHtml($clanek['nadpis'], ENT_NOQUOTES) ?>

         </a></li>   
<?php $iterations++; endforeach ?>
  </ul>
</div>
