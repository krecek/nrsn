<?php //netteCache[01]000370a:2:{s:4:"time";s:21:"0.19344100 1432039870";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:81:"/home/svn/repos/gymfed/trunk/app/WebModule/components/seznamAkci/seznamAkci.latte";i:2;i:1432039866;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/seznamAkci/seznamAkci.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'covyzhej7t')
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
<div class='seznam_akci'>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($seznam_akci) as $akce): ?>
        <?php if ($iterator->isFirst()): ?><h2 class="oddelit"><a href="<?php echo htmlSpecialChars($_presenter->link("Kalendar:")) ?>
">Akce</a></h2><?php endif ?>

        <div class="akce">
            <div class="akce_zahlavi oddo">
                <?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?>

                <h3><?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?></h3>
            </div>
            <div class="popis_akce hidden">
                <?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(explode(', ',$akce->sport)) as $zkr): echo NTemplateHelpers::escapeHtml($sporty[$zkr], ENT_NOQUOTES) ;if (!$iterator->isLast()): ?>
, <?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?><br />
                <?php echo NTemplateHelpers::escapeHtml($akce->popis, ENT_NOQUOTES) ?>

               <a class='na_detail' href='<?php echo htmlSpecialChars($_presenter->link("Kalendar:detail", array($akce['id'])), ENT_QUOTES) ?>'>více&nbsp;informací</a>
               <?php if ($akce['exisuji_vysledky']): ?><br /><img src="/css/medaile.png" /><a href="<?php echo htmlSpecialChars($_presenter->link("Vysledky:detail", array($akce['id']))) ?>
">elektronické výsledky</a><?php endif ?>

<?php if ($akce['prilohy']): ?>
                <ul>
<?php $iterations = 0; foreach ($akce['prilohy'] as $typ=>$seznam_priloh): if (count($seznam_priloh)==1): ?>
                    <li> <a href="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($seznam_priloh[0]['adresa']) ?>
"><?php echo NTemplateHelpers::escapeHtml($typy_priloh[$typ], ENT_NOQUOTES) ?></a></li>
<?php else: $iterations = 0; foreach ($seznam_priloh as $poradi=>$priloha): ?>
                    <li>    <a href="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($priloha['adresa']) ?>
"><?php echo NTemplateHelpers::escapeHtml($typy_priloh[$typ], ENT_NOQUOTES) ?> <?php echo NTemplateHelpers::escapeHtml($poradi+1, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach ;endif ;$iterations++; endforeach ?>
                </ul>
<?php endif ?>
            </div>
        </div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</div>