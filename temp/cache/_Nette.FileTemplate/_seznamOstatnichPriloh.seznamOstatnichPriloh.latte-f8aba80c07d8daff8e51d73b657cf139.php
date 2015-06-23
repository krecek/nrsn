<?php //netteCache[01]000393a:2:{s:4:"time";s:21:"0.88763000 1429785167";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:103:"/home/svn/repos/gymfed/trunk/app/WebModule/components/seznamOstatnichPriloh/seznamOstatnichPriloh.latte";i:2;i:1396434155;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/seznamOstatnichPriloh/seznamOstatnichPriloh.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'g93hc68ezy')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($prilohy): ?>
<h3>Ke stažení:</h3>
<div class="prilohy">
    <ul>
<?php $iterations = 0; foreach ($prilohy as $adresa=>$priloha): ?>
        <li><img src="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($priloha['nahled']) ?>
" alt="" title="zobrazit" /> <a href="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($adresa) ?>
"><?php echo NTemplateHelpers::escapeHtml($priloha['nazev'], ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach ?>
    </ul>
</div>
<?php endif ;