<?php //netteCache[01]000374a:2:{s:4:"time";s:21:"0.29414500 1429537892";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:85:"/home/svn/repos/gymfed/trunk/app/GisModule/components/PrilohyKAkci/prilohyKAkci.latte";i:2;i:1415119937;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/components/PrilohyKAkci/prilohyKAkci.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'kh3310cfqf')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($seznam_priloh): ?>
<div class="seznam_priloh">
<h3>Přílohy</h3>
<table>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($seznam_priloh) as $typ=>$prilohy): ?>
    <tr>
        <th><?php echo NTemplateHelpers::escapeHtml($typy_priloh[$typ], ENT_NOQUOTES) ?></th>
        <td>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($prilohy) as $adresa=>$priloha): ?>
            <?php if ($iterator->isFirst()): ?><ul><?php endif ?>

                <li> <?php if ($priloha['je_obrazek']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/ico-foto.png" title="zobrazit" /><?php else: ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/<?php echo htmlSpecialChars($priloha['nahled']) ?>" alt="" title="zobrazit" /><?php endif ?>
 <a href="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($adresa) ?>
"><?php echo NTemplateHelpers::escapeHtml($priloha['nazev'], ENT_NOQUOTES) ?></a></li>
                <?php if ($iterator->isLast()): ?></ul><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
        </td>
    </tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</table>
</div>
<?php endif ;if ($zobrazit_galerii): $_ctrl = $_control->getComponent("galerie"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;