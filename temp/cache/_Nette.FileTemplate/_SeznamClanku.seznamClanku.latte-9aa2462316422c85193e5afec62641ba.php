<?php //netteCache[01]000374a:2:{s:4:"time";s:21:"0.21825100 1429529912";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:85:"/home/svn/repos/gymfed/trunk/app/WebModule/components/SeznamClanku/seznamClanku.latte";i:2;i:1397024226;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/SeznamClanku/seznamClanku.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'np6ludjbrf')
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
<?php $iterations = 0; foreach ($clanky as $clanek): ?>
        <div class="clanek vypis">
         <a href="<?php echo htmlSpecialChars($_presenter->link("Clanky:", array($clanek['url']))) ?>">
            <span class="nahled-sm"><img src="<?php echo htmlSpecialChars($basePath) ?>
/<?php echo htmlSpecialChars($clanek['nahled']) ?>" alt="" /></span>
            <h2 class="nadpis"><?php echo NTemplateHelpers::escapeHtml($clanek['nadpis'], ENT_NOQUOTES) ?></h2>
               
            <p class="perex">
            <span class="datum"><?php echo NTemplateHelpers::escapeHtml($template->datumClanku($clanek->zobrazit_od), ENT_NOQUOTES) ;if ($clanek['upravil']): ?>
 (upraveno <?php echo NTemplateHelpers::escapeHtml($template->datumClanku($clanek['upraveno']), ENT_NOQUOTES) ?>
)<?php endif ?></span><?php if ($clanek['perex'] && $clanek['perex']!=' '): ?> - <?php echo NTemplateHelpers::escapeHtml($clanek['perex'], ENT_NOQUOTES) ?>
 ...<?php endif ?></p>
         </a>   
        </div>
<?php $iterations++; endforeach ?>
</div>
