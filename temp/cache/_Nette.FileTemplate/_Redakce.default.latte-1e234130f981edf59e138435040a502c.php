<?php //netteCache[01]000363a:2:{s:4:"time";s:21:"0.76690400 1431500809";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:74:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Redakce/default.latte";i:2;i:1402390180;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Redakce/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'eaxbefrc6c')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lbe530a04322_sekce')) { function _lbe530a04322_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Moje články<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb5de91fe9eb_obsah')) { function _lb5de91fe9eb_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
 ?>
<div id="<?php echo $_control->getSnippetId('seznamClanku') ?>"><?php call_user_func(reset($_l->blocks['_seznamClanku']), $_l, $template->getParameters()) ?>
</div><?php
}}

//
// block _seznamClanku
//
if (!function_exists($_l->blocks['_seznamClanku'][] = '_lbcbd44a306c__seznamClanku')) { function _lbcbd44a306c__seznamClanku($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('seznamClanku')
?><table>
    <tr>
        <th class="nazev_clanku">Nadpis</th>
        
        <th class="rubr_clanku">
<?php if (isset($razeni['rubrika'])): if ($razeni['rubrika']=='DESC'): ?>
                     <a class="dolu" href="<?php echo htmlSpecialChars($_control->link("default", array('order' => 'rubrika'))) ?>
">Rubrika</a>
<?php else: ?>
                     <a class="top" href="<?php echo htmlSpecialChars($_control->link("default", array('order' => 'rubrika_DESC'))) ?>
">Rubrika</a>
<?php endif ;else: ?>
                <a href="<?php echo htmlSpecialChars($_control->link("default", array('order' => 'rubrika'))) ?>
">Rubrika</a>
                <?php endif ?></th>
        <th class="oddo">Od</th>
        <th class="oddo">Do</th>
        <th class="maly"><acronym title="Zobrazit na hlavní stránce"></acronym></th>
        <th class="maly">Top</th>
        <th class="maly">&nbsp;</th>
        <th class="maly">&nbsp;</th>
    </tr>  
<?php if (!count($clanky)): ?>
    <tr>
        <td colspan="8">Nebyly nalezeny žádné články</td>
    </tr>
<?php else: ?>
    
<?php $iterations = 0; foreach ($clanky as $clanek): ?>
    <tr class="radek<?php if ($clanek['zobrazit_od']->getTimestamp()>time()): ?>
 nepublikovano<?php endif ?>">
        <td class="left"><a title="<?php echo htmlSpecialChars($clanek['nadpis']) ?>
" href="<?php echo htmlSpecialChars($_control->link("editClanek", array($clanek['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($clanek['nadpis'], ENT_NOQUOTES) ?></a></td>
        <td><a title="<?php echo htmlSpecialChars($clanek['rubrika_nazev'][0]) ;if (isset($clanek['rubrika_nazev'][1])): ?>
 - <?php echo htmlSpecialChars($clanek['rubrika_nazev'][1]) ;endif ?>" href="<?php echo htmlSpecialChars($_control->link("rubriky", array($clanek['rubrika']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($clanek['rubrika_nazev'][0], ENT_NOQUOTES) ?></a></td>
        <td>
<?php if ($clanek['prava']['publikovat']): ?>
                <a href="<?php echo htmlSpecialChars($_control->link("nastavitZacatek", array($clanek['id']))) ?>
">
<?php if ($clanek['zobrazit_od']->getTimeStamp()==$zobrazit_od_neschvaleneho_clanku->getTimeStamp()): ?>
                        Schválit
<?php else: ?>
                         <?php echo NTemplateHelpers::escapeHtml($template->date($clanek['zobrazit_od'], 'j.n.Y'), ENT_NOQUOTES) ?>

<?php endif ?>
                </a>
<?php else: if ($clanek['zobrazit_od']->getTimeStamp()==$zobrazit_od_neschvaleneho_clanku->getTimeStamp()): ?>
                   Neschváleno
<?php else: ?>
                   <?php echo NTemplateHelpers::escapeHtml($template->date($clanek['zobrazit_od'], 'j.n.Y'), ENT_NOQUOTES) ?>

<?php endif ;endif ?>
        </td>
        <td>
<?php if ($clanek['prava']['edit']): ?>
            <a href="<?php echo htmlSpecialChars($_control->link("nastavitKonec", array($clanek['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->date($clanek['zobrazit_do'], 'j.n.Y'), ENT_NOQUOTES) ?></a></td>
<?php else: ?>
            <?php echo NTemplateHelpers::escapeHtml($template->date($clanek['zobrazit_do'], 'j.n.Y'), ENT_NOQUOTES) ?>

<?php endif ?>
        <td> 
<?php if ($clanek['hlavni_strana']): if ($clanek['prava']['publikovat']): ?>
                        <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("nastavitHlavniStranu!", array($clanek['id'],0))) ?>
">
                            <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-ok.gif" alt="zrušit" title="zrušit zobrazení na hlavní straně" />
                        </a>
<?php else: ?>
                        <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-ok.gif" alt="ano" title="zobrazuje se na hlavní straně" />
<?php endif ;else: ?>
                  <a  class="ajax" href="<?php echo htmlSpecialChars($_control->link("nastavitHlavniStranu!", array($clanek['id'],1))) ?>
">
                <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-ok1.png" alt="nastavit" title="nastavit zobrazení na hlavní straně" />
                  </a>
<?php endif ?>
        </td>
        <td>
<?php if ($clanek['top']): ?>
                <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-top.png" alt="top" title="top článek" style="box-shadow: 1px 1px 2px #C0C0C0;" />
<?php elseif ($clanek['zobrazit_od']->getTimestamp()>time()): ?>
                <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-top1.png" alt="článek není publikován" title="Nelze nastavit, článek není publikován." style="box-shadow: 1px 1px 2px #C0C0C0;" />
<?php else: if ($opravneni['nastavit_top']): ?>
                <a  class="ajax1" onclick="if(!confirm('Opravdu nastavit jako top článek?'))return false;" href="<?php echo htmlSpecialChars($_control->link("nastavitTopClanek!", array($clanek['id']))) ?>
">
                  <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-top1.png" alt="nastavit" title="nastavit jako top článek" style="box-shadow: 1px 1px 2px #C0C0C0;" />
                </a>
<?php else: ?>
                   <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-top1.png" alt="není top" title="není top" style="box-shadow: 1px 1px 2px #C0C0C0;" />
<?php endif ;endif ?>
        </td>
        <td>
<?php if ($clanek['prava']['edit']): ?>
                <a href="<?php echo htmlSpecialChars($_presenter->link("Redakce:prilohy", array($clanek['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-priloha.png" alt="přílohy" title="přílohy" /></a>
<?php else: ?>
                &nbsp;
<?php endif ?>
        </td>
        <td<?php if ($clanek['zamek']=='A'): ?> title='Článek je chráněn proti smazání'<?php endif ?>>
<?php if ($clanek['prava']['edit'] && $clanek['zamek']=='N'): ?>
                <a href="<?php echo htmlSpecialChars($_presenter->link("Redakce:deleteClanek", array($clanek['id']))) ?>" onclick="if (!confirm('Opravdu smazat článek?')) return false;">
                    <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="smazat článek" title="smazat článek" />
                </a>
<?php else: ?>
                &nbsp;
<?php endif ?>
        </td>
    </tr>
<?php $iterations++; endforeach ;endif ?>
</table>
<?php
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