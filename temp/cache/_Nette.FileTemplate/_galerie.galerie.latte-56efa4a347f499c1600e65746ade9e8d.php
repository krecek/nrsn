<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.87073800 1429618162";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/WebModule/components/galerie/galerie.latte";i:2;i:1396946208;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/galerie/galerie.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '305pxntg1m')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($pocet_obrazku): ?>
<div class="galerie">
<?php $iterations = 0; foreach ($obrazky as $adresa=>$priloha): ?>
    <a href="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($adresa) ?>
" rel="lytebox[1]"><img src="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($priloha['nahled']) ?>
" alt="<?php echo htmlSpecialChars($priloha['nazev']) ?>" title="<?php echo htmlSpecialChars($priloha['nazev']) ?>" /></a>

<?php $iterations++; endforeach ?>
</div>

<?php endif ;