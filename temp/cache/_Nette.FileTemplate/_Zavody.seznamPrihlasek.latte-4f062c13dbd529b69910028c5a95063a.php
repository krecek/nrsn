<?php //netteCache[01]000370a:2:{s:4:"time";s:21:"0.50638300 1429896190";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:81:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/seznamPrihlasek.latte";i:2;i:1429892425;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/seznamPrihlasek.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'w6xgzpoh25')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb383a840a14_sekce')) { function _lb383a840a14_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Startovní listina - <?php echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbbf6f613124_obsah')) { function _lbbf6f613124_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
 ?>
<div id="<?php echo $_control->getSnippetId('prihlasky') ?>"><?php call_user_func(reset($_l->blocks['_prihlasky']), $_l, $template->getParameters()) ?>
</div>    <span class="h3">Poznámky</span>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($poznamky) as $poznamka): if ($iterator->isFirst()): ?>
            <table>
                <tr><th>Oddíl</th><th>Poznámka</th></tr>
<?php endif ?>
                <tr><td><?php echo NTemplateHelpers::escapeHtml($poznamka['nazev_oddilu'], ENT_NOQUOTES) ?>
</td><td><?php echo NTemplateHelpers::escapeHtml($poznamka['poznamka'], ENT_NOQUOTES) ?></td></tr>
<?php if ($iterator->isLast()): ?>
             </table>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    <br />
    <a class="ico-xls" href="<?php echo htmlSpecialChars($_control->link("startovniListina", array($akce->id))) ?>
">Startovní listina (xls)</a><br />
    <?php if ($akce->ubytovani=='A'): ?><a class="ico-xls" href="<?php echo htmlSpecialChars($_control->link("ubytovani", array($akce->id))) ?>
">Ubytování (xls)</a><?php endif ?>

    

    <br />
    <br />
    <a href="<?php echo htmlSpecialChars($_control->link("mail", array($akce->id))) ?>
">Poslat mail zúčastněným oddílům</a>
<?php
}}

//
// block _prihlasky
//
if (!function_exists($_l->blocks['_prihlasky'][] = '_lbee100aca37__prihlasky')) { function _lbee100aca37__prihlasky($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('prihlasky')
;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($kategorie) as $id=>$kat): ?>
    <span class="h3"><?php echo NTemplateHelpers::escapeHtml($kat->nazev, ENT_NOQUOTES) ?>
 <?php if ($kat->rocnik_od|| $kat->rocnik_do): ?>(<?php echo NTemplateHelpers::escapeHtml($template->kategorieRocniky($kat->rocnik_od, $kat->rocnik_do), ENT_NOQUOTES) ?>
)<?php endif ?></span>
    <span class="zobraz_popis hidden">&nbsp;&nbsp;&nbsp;<img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-info.png" alt="info" title="zobrazit detaily" /><br /></span>
    <div class="popis hidden">
        <table>
    <tr><th>pohlaví</th><td><?php if ($kat['pohlavi']=='M'): ?>muži<?php elseif ($kat['pohlavi']=='Z'): ?>
ženy<?php else: ?>bez omezení<?php endif ?></td></tr>
    <tr><th>omezení</th><td><?php if ($kat['typ']=='R'): ?>pouze registrovaní<?php elseif ($kat['typ']=='E'): ?>
pouze evidovaní<?php else: ?>bez omezení<?php endif ?></td></tr>
    <tr><th>ročníky narození</th><td><?php echo NTemplateHelpers::escapeHtml($template->kategorieRocniky($kat['rocnik_od'], $kat['rocnik_do']), ENT_NOQUOTES) ?></td></tr>
    <tr><th>&nbsp;</th><td><?php if ($kat['druzstvo']==1): ?>soutěž jednotlivců<?php else: ?>
soutěž družstev (<?php echo NTemplateHelpers::escapeHtml($kat['druzstvo'], ENT_NOQUOTES) ?>
-členných)<?php endif ?></td></tr>
<?php if ($kat['omezeni_na_oddil']): ?>
    <tr>
        <td colspan="2">
        <?php if ($kat['druzstvo']==1): ?>maximálně <?php echo NTemplateHelpers::escapeHtml($kat['omezeni_na_oddil'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->sklonovaniOsoby($kat['omezeni_na_oddil']), ENT_NOQUOTES) ?>
 z jednoho oddílu<?php endif ?>

        <?php if ($kat['druzstvo']>1): ?>maximálně <?php echo NTemplateHelpers::escapeHtml($kat['omezeni_na_oddil'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->sklonovaniDruzstva($kat['omezeni_na_oddil']), ENT_NOQUOTES) ?>
 z jednoho oddílu<?php endif ?>

        </td>
    </tr>
<?php endif ?>
</table>
    </div>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($kat->prihlasky) as $prihlaska): if ($iterator->isFirst()): ?>
        <table class="hover">
            <tr>
                <th class="maly">&nbsp;</th><?php if ($kat->druzstvo>1): ?><th>Družstvo</th><?php endif ?>
<th>Oddíl</th><th>Jméno</th><th class="maly">Ročník</th><th class="maly">Trenér</th><th>Pozn.</th><?php if ($akce->ubytovani=='A'): ?>
<th class="maly"><acronym title="Ubytování"></acronym><?php endif ?></th><th>&nbsp;</th>
            </tr>
<?php endif ?>
            <tr>
                <td><?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_NOQUOTES) ?></td>
<?php if ($kat->druzstvo>1): ?>
                    <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['nazev_druzstva'], ENT_NOQUOTES) ?></td>
<?php endif ?>
                <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['nazev_oddilu'], ENT_NOQUOTES) ?></td>
                <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['prijmeni'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($prihlaska['jmeno'], ENT_NOQUOTES) ?></td>
                <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['rocnik'], ENT_NOQUOTES) ?></td>
                <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['trener'], ENT_NOQUOTES) ?></td>
                <td><?php if ($akce->uzavirka_prihlasek && ($prihlaska['datum_prihlaseni']->format('Y-m-d')>$akce->uzavirka_prihlasek->format('Y-m-d'))): ?>
<img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-calendar-warning.png" alt="po uzávěrce" title="přihlášeno po uzávěrce: <?php echo htmlSpecialChars($template->date($prihlaska['datum_prihlaseni'], 'j.n.Y H:i')) ?>
" /><?php endif ?>

                    <?php echo NTemplateHelpers::escapeHtml($prihlaska['poznamka'], ENT_NOQUOTES) ?>

                </td>
<?php if ($akce->ubytovani=='A'): ?>
                <td>
<?php if ($prihlaska['ubytovani']=='N'): ?>
                         <img title="ne" alt="ne" src="/css/ico-ok1.png" />
<?php else: ?>
                         <img title="ano" alt="ano" src="/css/ico-ok.gif" />
<?php endif ?>
                </td>
<?php endif ?>
                   <td><a  onclick="if(!confirm('Oprvdu odmítnout přihlášku? Tento krok je nevratný.'))return false;" href="<?php echo htmlSpecialChars($_control->link("odmitnoutPrihlasku!", array($akce->id, $prihlaska['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="odmítnout" title="odmítnout přihlášku" /></a></td>
            </tr>
<?php if ($iterator->isLast()): ?>
        </table>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;if ($kat->elektronicke_prihlasky=='N'): ?>
        <div>V této kategorii nejsou povoleny elektronické přihlášky.</div>
<?php endif ?>
    <br />
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    <?php if (!$kategorie): ?><br />Není vypsaná žádná kategorie. Kategorii můžete vytvořit <a href="<?php echo htmlSpecialChars($_control->link("kategorie", array($akce->id))) ?>
">zde</a>.<br /><br /><?php endif ?>

<?php if ($akce->rozhodci=='A'): ?>
    <span class="h3">Rozhodčí</span>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($rozhodci) as $prihlaska): if ($iterator->isFirst()): ?>
                <table class="hover">
                    <tr>
                        <th class="maly">&nbsp;</th>
                        <th>Oddíl</th>
                        <th>Jméno</th>
                        <th>Poznámka</th>
                           <?php if ($akce->ubytovani=='A'): ?><th class="maly"><acronym title="Ubytování"></acronym></th><?php endif ?>

                           <th>&nbsp;</th>
                    </tr>
<?php endif ?>
                    <tr>
                        <td><?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_NOQUOTES) ?></td>
                        <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['nazev_oddilu'], ENT_NOQUOTES) ?></td>
                        <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['prijmeni'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($prihlaska['jmeno'], ENT_NOQUOTES) ?></td>
                        <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['poznamka'], ENT_NOQUOTES) ?></td>
<?php if ($akce->ubytovani=='A'): ?>
                        <td>
<?php if ($prihlaska['ubytovani']=='N'): ?>
                                 <img title="ne" alt="ne" src="/css/ico-ok1.png" />
<?php else: ?>
                                 <img title="ano" alt="ano" src="/css/ico-ok.gif" />
<?php endif ?>
                        </td>
<?php endif ?>
                        <td><a class="ajax" data-confirm="Opravdu odmítnout tuto přihlášku? Tento krok je nevratný" href="<?php echo htmlSpecialChars($_control->link("odmitnoutPrihlasku!", array($akce->id, $prihlaska['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="odmítnout" title="odmítnou přihlášku" /></a></td>
                     </tr>
<?php if ($iterator->isLast()): ?>
                </table>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    <br />
<?php endif ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = 'base.latte'; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
 if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars()) ; 