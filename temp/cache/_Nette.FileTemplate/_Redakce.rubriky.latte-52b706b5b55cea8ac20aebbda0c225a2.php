<?php //netteCache[01]000368a:2:{s:4:"time";s:21:"0.32477100 1435035796";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:79:"D:\xampp\htdocs\redakcni_system\app\AdminModule\templates\Redakce\rubriky.latte";i:2;i:1433434638;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: D:\xampp\htdocs\redakcni_system\app\AdminModule\templates\Redakce\rubriky.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'ikilavpm2o')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb3f7ba4473c_sekce')) { function _lb3f7ba4473c_sekce($_l, $_args) { extract($_args)
?>Rubriky - <?php echo NTemplateHelpers::escapeHtml($rubrika['nazev'], ENT_NOQUOTES) ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb8b08e41b71_obsah')) { function _lb8b08e41b71_obsah($_l, $_args) { extract($_args)
;if ($rubrika['rodic']==$id_hlavni_skupiny || $rubrika['id']==$id_hlavni_skupiny): ?>
    <h3>Seznam rubrik</h3>
    <table>
        <tr>
            <th>název</th>
<?php if ($opravneni['rubrika_edit']): ?>
            <th>&nbsp;</th>
<?php endif ?>
        </tr>
<?php if (!count($rubriky)): ?>
            <tr><td colspan="5">Nebyly nalezeny žádné rubriky</td></tr>
<?php else: $iterations = 0; foreach ($rubriky as $podrubrika): ?>
            <tr class="radek">
                <td>
                    <a href="<?php echo htmlSpecialChars($_control->link("rubriky", array($podrubrika['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($podrubrika['nazev'], ENT_NOQUOTES) ?></a>
                </td>
<?php if ($opravneni['rubrika_edit']): ?>
                <td<?php if ($podrubrika['zamek']=='A'): ?> title='Rubrika je chráněna proti smazání'<?php endif ;if ($podrubrika['podrubriky']): ?>
 title="Rubrika obsahuje podrubriky"<?php endif ?>>
<?php if ($podrubrika['zamek']=='N'  && !$podrubrika['podrubriky']): ?>
                     <a onclick="if (!confirm('Opravdu smazat rubriku?')) return false;" href="<?php echo htmlSpecialChars($_control->link("deleteRubrika", array($podrubrika['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="smazat" title="smazat" /></a>
                     <?php else: ?>&nbsp;
<?php endif ?>
                </td>
<?php endif ?>
            </tr>
<?php if ($podrubrika['podrubriky']): $iterations = 0; foreach ($podrubrika['podrubriky'] as $podrubr): ?>
            <tr class="radek">
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo htmlSpecialChars($_control->link("rubriky", array($podrubr['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($podrubr['nazev'], ENT_NOQUOTES) ?></a>
                </td>
<?php if ($podrubrika['rubrika_edit']): ?>
                    <td<?php if ($podrubr['zamek']=='A'): ?> title='Rubrika je chráněna proti smazání'<?php endif ?>>
<?php if ($podrubr['zamek']=='N'): ?>
                         <a onclick="if (!confirm('Opravdu smazat rubriku?')) return false;" href="<?php echo htmlSpecialChars($_control->link("deleteRubrika", array($podrubr['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="smazat" title="smazat" /></a>
                       <?php else: ?>&nbsp;
<?php endif ?>
                    </td>
<?php else: ?>
                    <td title='Nemáte oprávnění smazat tuto rubriku'>&nbsp;</td>
<?php endif ?>
                
             </tr>
<?php $iterations++; endforeach ;endif ;$iterations++; endforeach ;endif ?>
    </table>
<?php endif ;if ($rubrika['rodic']==$id_hlavni_skupiny && $rubrika['id']!=$id_hlavni_skupiny): ?>
<br /><?php endif ?>

<?php if ($rubrika['id']!=$id_hlavni_skupiny): ?>
<div id="<?php echo $_control->getSnippetId('seznamClanku') ?>"><?php call_user_func(reset($_l->blocks['_seznamClanku']), $_l, $template->getParameters()) ?>
</div><?php endif ?>

<div class="bottom_nav">
<?php if ($opravneni['rubrika_edit']): ?>
         <a href="<?php echo htmlSpecialChars($_control->link("editRubrika", array($rubrika['id']))) ?>
">Vlastnosti</a>
<?php endif ;if ($opravneni['menu_edit']): ?>
         <a href="<?php echo htmlSpecialChars($_control->link("editMenu", array($rubrika['id']))) ?>
">Menu</a>
<?php endif ;if ($opravneni['prevzit_pravo']): ?>
        <a href="<?php echo htmlSpecialChars($_control->link("prevzitPrava", array($rubrika['id']))) ?>
">Převzít práva</a>
<?php endif ?>
</div>



<?php
}}

//
// block _seznamClanku
//
if (!function_exists($_l->blocks['_seznamClanku'][] = '_lbfe51d1edf3__seznamClanku')) { function _lbfe51d1edf3__seznamClanku($_l, $_args) { extract($_args); $_control->validateControl('seznamClanku')
?>    <h3>Seznam článků</h3>
    <table>
        <tr>
        <th class="nazev_clanku">Nadpis</th>
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
<?php else: $iterations = 0; foreach ($clanky as $clanek): ?>
        <tr class="radek<?php if ($clanek['zobrazit_od']->getTimestamp()>time()): ?>
 nepublikovano<?php endif ?>">
            <td class="left"><a title="<?php echo htmlSpecialChars($clanek['nadpis']) ?>
" href="<?php echo htmlSpecialChars($_control->link("editClanek", array($clanek['id'], $backlink))) ?>
"><?php echo NTemplateHelpers::escapeHtml($clanek['nadpis'], ENT_NOQUOTES) ?></a></td>
            <td>
<?php if ($clanek['prava']['publikovat']): ?>
                    <a href="<?php echo htmlSpecialChars($_control->link("nastavitZacatek", array($clanek['id'], $backlink))) ?>
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
                    <a href="<?php echo htmlSpecialChars($_control->link("nastavitKonec", array($clanek['id'], $backlink))) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->date($clanek['zobrazit_do'], 'j.n.Y'), ENT_NOQUOTES) ?></a>
<?php else: ?>
                    <?php echo NTemplateHelpers::escapeHtml($template->date($clanek['zobrazit_do'], 'j.n.Y'), ENT_NOQUOTES) ?>

<?php endif ?>
            </td>
            <td> 
<?php if ($clanek['hlavni_strana']): if ($clanek['prava']['publikovat']): ?>
                        <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("nastavitHlavniStranu!", array($clanek['id'],0))) ?>
">
                           <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-ok.gif" alt="zrušit" title="zrušit zobrazení na hlavní straně" />
                        </a>
<?php else: ?>
                        <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-ok.gif" alt="ano" title="zobrazuje se na hlavní straně" />
<?php endif ;else: if ($clanek['prava']['publikovat']): ?>
                        <a  class="ajax" href="<?php echo htmlSpecialChars($_control->link("nastavitHlavniStranu!", array($clanek['id'],1))) ?>
">
                          <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-ok1.png" alt="nastavit" title="nastavit zobrazení na hlavní straně" />
                        </a>
<?php else: ?>
                         <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-ok1.png" alt="ne" title="nezobrazuje se na hlavní straně" />
<?php endif ;endif ?>
            </td>
        <td>
<?php if ($clanek['top']): ?>
                <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-top.png" alt="top" title="top článek" style="box-shadow: 1px 1px 2px #C0C0C0;" />
<?php elseif ($clanek['zobrazit_od']->getTimestamp()>time()): ?>
                <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-top1.png" alt="článek není publikován" title="Nelze nastavit, článek není publikován." style="box-shadow: 1px 1px 2px #C0C0C0;" />
<?php else: if ($opravneni['nastavit_top']): ?>
                <a  class="ajax" onclick="if(!confirm('Opravdu nastavit jako top článek?'))return false;" href="<?php echo htmlSpecialChars($_control->link("nastavitTopClanek!", array($clanek['id']))) ?>
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
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-priloha.png" alt="přílohy" title="přílohy" /></a></td>
<?php else: ?>
                    &nbsp;
<?php endif ?>
            <td<?php if ($clanek['zamek']=='A'): ?> title='Článek je chráněn proti smazání'<?php endif ?>>
<?php if ($clanek['prava']['edit'] && $clanek['zamek']=='N'): ?>
                    <a href="<?php echo htmlSpecialChars($_presenter->link("Redakce:deleteClanek", array($clanek['id'], $backlink))) ?>" onclick="if (!confirm('Opravdu smazat článek?')) return false;">
                        <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="smazat článek" title="smazat článek" />
                    </a>
                <?php else: ?>&nbsp;
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