<?php //netteCache[01]000368a:2:{s:4:"time";s:21:"0.32421000 1429534079";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:79:"/home/svn/repos/gymfed/trunk/app/WebModule/components/topClanky/topClanky.latte";i:2;i:1414165681;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/topClanky/topClanky.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'ow1suaeuyg')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$iterations = 0; foreach ($clanky as $clanek): ?>
<div class="<?php echo htmlSpecialChars($class) ?> ">
    <div class="box-6">
     <div class="slideshow">
<?php $iterations = 0; foreach ($clanek['nahledy'] as $adresa=>$soubor): ?>
        <a href="<?php echo htmlSpecialChars($_presenter->link("Clanky:", array($clanek['id']))) ?>">
            <img src="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($adresa) ?>" alt="nahled" />
        </a>
<?php $iterations++; endforeach ?>
     </div>  
    </div>
    <div class="box-6">
    <span class="nadpis"><a href="<?php echo htmlSpecialChars($_presenter->link("Clanky:", array($clanek['url']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($clanek['nadpis'], ENT_NOQUOTES) ?></a></span>
    <div class="datum"><?php echo NTemplateHelpers::escapeHtml($template->datumClanku($clanek['zobrazit_od']), ENT_NOQUOTES) ;if ($clanek['upravil']): ?>
 (upraveno <?php echo NTemplateHelpers::escapeHtml($template->datumClanku($clanek['upraveno']), ENT_NOQUOTES) ?>
)<?php endif ?></div>
    <div class="perex"><?php if ($clanek['perex'] && $clanek['perex']!=' '): echo NTemplateHelpers::escapeHtml($clanek['perex'], ENT_NOQUOTES) ?>
 ...<?php endif ?></div>
    </div><div style="clear:both;"></div>
</div>
<?php $iterations++; endforeach ;