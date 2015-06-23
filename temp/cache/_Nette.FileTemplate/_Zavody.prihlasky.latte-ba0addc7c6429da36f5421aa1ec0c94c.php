<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.48733300 1429779780";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prihlasky.latte";i:2;i:1421753608;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prihlasky.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '9jymil0l35')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb1cad721990_sekce')) { function _lb1cad721990_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přihlášky - <?php echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbd34cf6380d_obsah')) { function _lbd34cf6380d_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
 ?>
<div id="<?php echo $_control->getSnippetId('prihlasky') ?>"><?php call_user_func(reset($_l->blocks['_prihlasky']), $_l, $template->getParameters()) ?>
</div><span class="h3">Poznámka</span>
<?php if ($poznamka): $iterations = 0; foreach ($poznamka as $poz): ?>
        <div><?php echo NTemplateHelpers::escapeHtml($poz->poznamka, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ;endif ;if ($opravneni['prihlasky_edit']): ?>
    <div class="bottom_nav" style="margin-top: 0; padding-top:0;">
        <a href="<?php echo htmlSpecialChars($_control->link("poznamka", array($akce->id, $oddil))) ?>
">vložit poznámku</a>
    </div>
<?php endif ?>


        

<?php
}}

//
// block _prihlasky
//
if (!function_exists($_l->blocks['_prihlasky'][] = '_lbe79e80b210__prihlasky')) { function _lbe79e80b210__prihlasky($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('prihlasky')
?>        <div id="modal" class="hidden">
        </div>
    
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($kategorie) as $id=>$kat): ?>
    <span class="h3"><?php echo NTemplateHelpers::escapeHtml($kat->nazev, ENT_NOQUOTES) ?>
 <?php if ($kat->rocnik_od|| $kat->rocnik_do): ?>(<?php echo NTemplateHelpers::escapeHtml($template->kategorieRocniky($kat->rocnik_od, $kat->rocnik_do), ENT_NOQUOTES) ?>
)<?php endif ?></span>
    <span class="zobraz_popis hidden">&nbsp;&nbsp;&nbsp;<img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-info.png" alt="info" title="zobrazit detaily" /><br /></span>
    <div class="popis hidden">
        <table>
            <tr><th>pohlaví</th><td><?php if ($kat['pohlavi']=='M'): ?>muži<?php elseif ($kat['pohlavi']=='Z'): ?>
ženy<?php else: ?>bez omezení<?php endif ?></td></tr>
            <tr><th>určení</th><td><?php if ($kat['typ']=='R'): ?>registrovaní<?php elseif ($kat['typ']=='E'): ?>
evidovaní<?php else: ?>bez omezení<?php endif ?></td></tr>
            <tr><th>ročníky narození</th><td><?php echo NTemplateHelpers::escapeHtml($template->kategorieRocniky($kat['rocnik_od'], $kat['rocnik_do']), ENT_NOQUOTES) ?></td></tr>
            <tr><th>&nbsp;</th><td><?php if ($kat['druzstvo']==1): ?>soutěž jednotlivců<?php else: ?>
soutěž družstev (<?php echo NTemplateHelpers::escapeHtml($kat['druzstvo'], ENT_NOQUOTES) ?>
-členných)<?php if ($kat['detail_druzstva']): ?>: <?php echo NTemplateHelpers::escapeHtml($kat['detail_druzstva'], ENT_NOQUOTES) ;endif ;endif ?></td></tr>
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
<?php if ($kat->druzstvo==1): $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($kat->prihlasky) as $prihlaska): if ($iterator->isFirst()): ?>
                <table class="hover">
                    <tr>
                        <th>Jméno</th><th>Ročník</th><th>Trenér</th><th>Pozn.</th><?php if ($opravneni['prihlasky_edit']): if ($akce->ubytovani=='A'): ?>
<th class="maly">Ubytování</th><?php endif ?><th>&nbsp;</th><?php endif ?>

                    </tr>
<?php endif ?>
                <tr>
                    <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['prijmeni'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($prihlaska['jmeno'], ENT_NOQUOTES) ?></td>
                    <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['rocnik'], ENT_NOQUOTES) ?></td>
                    <td>
<?php if ($opravneni['prihlasky_edit']): ?>
                        <a class="noveokno" href="<?php echo htmlSpecialChars($_control->link("trener", array($akce->id,$prihlaska->id, $prihlaska->osoba, $oddil))) ?>
">
                                         <?php if (!$prihlaska['trener']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/ico-minus.png" alt="nezadáno" title="zadat" /><?php else: echo NTemplateHelpers::escapeHtml($prihlaska['trener'], ENT_NOQUOTES) ;endif ?>

                        </a>
<?php else: ?>
                                        <?php echo NTemplateHelpers::escapeHtml($prihlaska['trener'], ENT_NOQUOTES) ?>

<?php endif ?>
                    </td>
                    <td>
                        <?php if ($akce->uzavirka_prihlasek && $prihlaska['datum_prihlaseni']->format('Y-m-d')>$akce->uzavirka_prihlasek->format('Y-m-d')): ?>
<img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-calendar-warning.png" alt="po uzávěrce" title="přihlášeno po uzávěrce: <?php echo htmlSpecialChars($template->date($prihlaska['datum_prihlaseni'], 'j.n.Y H:i')) ?>
" /><?php endif ?>

<?php if ($opravneni['prihlasky_edit']): ?>
                        <a class="noveokno" href="<?php echo htmlSpecialChars($_control->link("poznamkaPrihlasky", array($akce->id, $prihlaska->id, $prihlaska->osoba, $oddil))) ?>
">
                                            <?php if (!$prihlaska['poznamka']): ?>
<img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-minus.png" alt="nezadáno" title="zadat" /><?php else: echo NTemplateHelpers::escapeHtml($prihlaska['poznamka'], ENT_NOQUOTES) ;endif ?>

                        </a>
<?php else: ?>
                                        <?php echo NTemplateHelpers::escapeHtml($prihlaska['poznamka'], ENT_NOQUOTES) ?>

<?php endif ?>
                    </td>
<?php if ($opravneni['prihlasky_edit']): if ($akce->ubytovani=='A'): ?>
                    <td>
<?php if ($prihlaska['ubytovani']=='N'): ?>
                        <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("objednatUbytovani!", array($prihlaska['id'], TRUE))) ?>
">
                            <img title="Objednat ubytování" alt="objednat" src="/css/ico-ok1.png" />
                        </a>
<?php else: ?>
                        <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("objednatUbytovani!", array($prihlaska['id'], FALSE))) ?>
">
                            <img title="Zrušit ubytování" alt="zrušit" src="/css/ico-ok.gif" />
                        </a>
<?php endif ?>
                    </td>
<?php endif ?>
                    <td><a class="ajax" href="<?php echo htmlSpecialChars($_control->link("smazatPrihlasku!", array($akce->id, $id, $prihlaska['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="zrušit" title="zrušit přihlášku" /></a></td>
<?php endif ?>
                </tr>
<?php if ($iterator->isLast()): ?>
                </table>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;if ($kat->elektronicke_prihlasky=='A'): ?>

            <div class="bottom_nav" style="margin-top: 0; padding-top:0;">
<?php if (!$kat['omezeni_na_oddil'] || (count($kat->prihlasky)<$kat['omezeni_na_oddil'])): if ($opravneni['prihlasky_edit']): ?>
                        <?php if ($akce->uzavirka_prihlasek && ($akce->uzavirka_prihlasek->format('Y-m-d')<date('Y-m-d'))): ?>
Je po uzávěrce přihlášek. Nové přihlášky nemusí být akceptovány.<br /><?php endif ?>

                        <a href="<?php echo htmlSpecialChars($_control->link("prihlasit", array($akce->id, $id, $oddil))) ?>
">přihlásit</a>
<?php endif ;elseif ($kat['omezeni_na_oddil']): ?>
                         Nejsou možné další přihlášky, v této kategorii <?php echo NTemplateHelpers::escapeHtml($template->casovaniMoci($kat['omezeni_na_oddil']), ENT_NOQUOTES) ?>
 startovat max. <?php echo NTemplateHelpers::escapeHtml($kat['omezeni_na_oddil'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->sklonovaniOsoby($kat['omezeni_na_oddil']), ENT_NOQUOTES) ?> z jednoho oddílu.
<?php endif ?>
            </div>
        <?php else: ?>V této kategorii nejsou povoleny elektronické přihlášky.<br /><br />
<?php endif ;else: $pocet_druzstev=0 ;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($kat->druzstva) as $id_druzstva=>$druzstvo): if ($id_druzstva): ?>
                    <span class="h4"><?php echo NTemplateHelpers::escapeHtml($druzstvo['nazev'], ENT_NOQUOTES) ?></span> 
<?php if ($druzstvo['vlastni']): $pocet_druzstev++ ?>
                    &nbsp;
<?php if (count($druzstvo['prihlasky'])<$kat['druzstvo']): ?>
                     <a href="<?php echo htmlSpecialChars($_control->link("pridatDoDruzstva", array($akce->id, $id, $oddil, $druzstvo['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-add.png" alt="Přidat do družstva" title="přidat do družstva" /></a>
<?php else: ?>
                     <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-add-grey.png" alt="nelze přidat" title="Družstvo může být max.  <?php echo htmlSpecialChars($kat->druzstvo) ?>-členné. Do družstva již nelze přidat další osoby." />
<?php endif ?>
                     
                     &nbsp;&nbsp;&nbsp;
                    <a class="ajax" data-confirm="Opravdu zrušit družstvo?" href="<?php echo htmlSpecialChars($_control->link("zrusitDruzstvo!", array($akce->id, $id, $oddil, $druzstvo['id']))) ?>
">
                        <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="zrušit" title="zrušit družstvo" /></a>                    
                    <?php else: ?> (<?php echo NTemplateHelpers::escapeHtml($druzstvo['druzstvo_nazev_oddilu'], ENT_NOQUOTES) ?>)
<?php endif ;else: ?>
                    <span class="h4">K hostování</span> 
<?php endif ;$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($druzstvo['prihlasky']) as $prihlaska): if ($iterator->isFirst()): ?>
                        <table class="hover">
                            <tr>
                                <th>Jméno</th><th class="maly">Ročník</th><th>Trenér</th><?php if (!$id_druzstva): ?>
<th>Hostování</th><?php endif ?><th>Pozn.</th><?php if ($opravneni['prihlasky_edit']): if ($akce->ubytovani=='A'): ?>
<th class="maly">Ubytování</th><?php endif ?><th class="maly">&nbsp;</th><?php endif ?>

                            </tr>
<?php endif ?>
                        <tr>
                            <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['prijmeni'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($prihlaska['jmeno'], ENT_NOQUOTES) ?></td>
                            <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['rocnik'], ENT_NOQUOTES) ?></td>
                            <td>
<?php if ($opravneni['prihlasky_edit']): ?>
                                    <a class="noveokno" href="<?php echo htmlSpecialChars($_control->link("trener", array($akce->id,$prihlaska->id, $prihlaska->osoba, $oddil))) ?>
">
                                        <?php if (!$prihlaska['trener']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/ico-minus.png" alt="nezadáno" title="zadat" /><?php else: echo NTemplateHelpers::escapeHtml($prihlaska['trener'], ENT_NOQUOTES) ;endif ?>

                                    </a>
<?php else: ?>
                                    <?php echo NTemplateHelpers::escapeHtml($prihlaska['trener'], ENT_NOQUOTES) ?>

<?php endif ?>
                            </td>
                            <?php if (!$id_druzstva): ?><td><?php echo NTemplateHelpers::escapeHtml($prihlaska['hostujici_oddil'], ENT_NOQUOTES) ?>
</td><?php endif ?>

                            <td>
                                <?php if ($akce->uzavirka_prihlasek && $prihlaska['datum_prihlaseni']->format('Y-m-d')>$akce->uzavirka_prihlasek->format('Y-m-d')): ?>
<img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-calendar-warning.png" alt="po uzávěrce" title="přihlášeno po uzávěrce: <?php echo htmlSpecialChars($template->date($prihlaska['datum_prihlaseni'], 'j.n.Y H:i')) ?>
" /><?php endif ?>

<?php if ($opravneni['prihlasky_edit']): ?>
                                    <a class="noveokno" href="<?php echo htmlSpecialChars($_control->link("poznamkaPrihlasky", array($akce->id, $prihlaska->id, $prihlaska->osoba, $oddil))) ?>
">
                                         <?php if (!$prihlaska['poznamka']): ?><img src="<?php echo htmlSpecialChars($basePath) ?>
/css/ico-minus.png" alt="nezadáno" title="zadat" /><?php else: echo NTemplateHelpers::escapeHtml($prihlaska['poznamka'], ENT_NOQUOTES) ;endif ?>

                                    </a>
<?php else: ?>
                                    <?php echo NTemplateHelpers::escapeHtml($prihlaska['poznamka'], ENT_NOQUOTES) ?>

<?php endif ?>
                            </td>
<?php if ($opravneni['prihlasky_edit']): if ($akce->ubytovani=='A'): ?>
                                        <td>
<?php if ($prihlaska['ubytovani']=='N'): ?>
                                                <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("objednatUbytovani!", array($prihlaska['id'], TRUE))) ?>
">
                                                    <img title="Objednat ubytování" alt="objednat" src="/css/ico-ok1.png" />
                                                </a>
<?php else: ?>
                                                <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("objednatUbytovani!", array($prihlaska['id'], FALSE))) ?>
">
                                                    <img title="Zrušit ubytování" alt="zrušit" src="/css/ico-ok.gif" />
                                                </a>
<?php endif ?>
                                        </td>
<?php endif ?>
                                    <td><a class="ajax" href="<?php echo htmlSpecialChars($_control->link("smazatPrihlasku!", array($akce->id, $id, $prihlaska['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="zrušit" title="zrušit přihlášku" /></a></td>
<?php endif ?>
                        </tr>
<?php if ($iterator->isLast()): ?>
                        </table>
<?php endif ?>
                <?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?> 
        <?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?> 
            
<?php if ($kat->elektronicke_prihlasky=='A'): ?>
            <div class="bottom_nav" style="margin-top: 0; padding-top:0;">
<?php if ($opravneni['prihlasky_edit']): ?>
                        <?php if ($akce->uzavirka_prihlasek && ($akce->uzavirka_prihlasek->format('Y-m-d')<date('Y-m-d'))): ?>
Je po uzávěrce přihlášek. Nové přihlášky nemusí být akceptovány.<br /><?php endif ?>

<?php if (!$kat['omezeni_na_oddil'] ||  $pocet_druzstev <$kat['omezeni_na_oddil']): ?>
                            <a href="<?php echo htmlSpecialChars($_control->link("prihlasitDruzstvo", array($akce->id, $id, $oddil))) ?>
">přidat družstvo</a>
<?php else: ?>
                            Není možné přidat další družstvo, v této kategorii <?php echo NTemplateHelpers::escapeHtml($template->casovaniMoci($kat['omezeni_na_oddil']), ENT_NOQUOTES) ?>
 startovat max. <?php echo NTemplateHelpers::escapeHtml($kat['omezeni_na_oddil'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->sklonovaniDruzstva($kat['omezeni_na_oddil']), ENT_NOQUOTES) ?> z jednoho oddílu.
<?php endif ?>
                        
                        <?php if ($kat['hostovani']=='A'): ?><a href="<?php echo htmlSpecialChars($_control->link("hostovani", array($akce->id, $id, $oddil))) ?>
">povolit hostování</a><?php endif ?>

<?php endif ?>
            </div>
        <?php else: ?>V této kategorii nejsou povoleny elektronické přihlášky.<br /><br />
<?php endif ?>
     <?php endif ?> 
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?> 
<?php if ($akce->rozhodci=='A'): ?>
    <span class="h3">Rozhodčí</span>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($rozhodci) as $prihlaska): if ($iterator->isFirst()): ?>
        <table><tr><th>Příjmení</th><th>Jméno</th><th>Poznámka</th><?php if ($opravneni['prihlasky_edit']): if ($akce->ubytovani=='A'): ?>
<th class="maly">Ubytování</th><?php endif ?><th class="maly">&nbsp;</th><?php endif ?></tr>
<?php endif ?>
        <tr>
            <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['prijmeni'], ENT_NOQUOTES) ?></td>
            <td><?php echo NTemplateHelpers::escapeHtml($prihlaska['jmeno'], ENT_NOQUOTES) ?></td>
            <td>
                <?php if ($akce->uzavirka_prihlasek && $prihlaska['datum_prihlaseni']->format('Y-m-d')>$akce->uzavirka_prihlasek->format('Y-m-d')): ?>
<img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-calendar-warning.png" alt="po uzávěrce" title="přihlášeno po uzávěrce: <?php echo htmlSpecialChars($template->date($prihlaska['datum_prihlaseni'], 'j.n.Y H:i')) ?>
" /><?php endif ?>

                <?php echo NTemplateHelpers::escapeHtml($prihlaska['poznamka'], ENT_NOQUOTES) ?>

            </td>
<?php if ($opravneni['prihlasky_edit']): if ($akce->ubytovani=='A'): ?>
                  <td>
<?php if ($prihlaska['ubytovani']=='N'): ?>
                        <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("objednatUbytovani!", array($prihlaska['id'], TRUE))) ?>
">
                            <img title="Objednat ubytování" alt="objednat" src="/css/ico-ok1.png" />
                        </a>
<?php else: ?>
                        <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("objednatUbytovani!", array($prihlaska['id'], FALSE))) ?>
">
                            <img title="Zrušit ubytování" alt="zrušit" src="/css/ico-ok.gif" />
                        </a>
<?php endif ?>
                 </td>
<?php endif ?>
                <td><a class="ajax" href="<?php echo htmlSpecialChars($_control->link("smazatPrihlasku!", array($akce->id, -1, $prihlaska['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="zrušit" title="zrušit přihlášku" /></a></td>
<?php endif ?>
        </tr>
<?php if ($iterator->isLast()): ?>
       </table>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    <div class="bottom_nav" style="margin-top: 0; padding-top:0;">
<?php if ($opravneni['prihlasky_edit']): ?>
           <?php if ($akce->uzavirka_prihlasek && ($akce->uzavirka_prihlasek->format('Y-m-d')<date('Y-m-d'))): ?>
Je po uzávěrce přihlášek. Nové přihlášky nemusí být akceptovány.<br /><?php endif ?>

            <a href="<?php echo htmlSpecialChars($_control->link("prihlasitRozhodci", array($akce->id, $oddil))) ?>
">přihlásit</a>
<?php endif ?>
    </div>
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