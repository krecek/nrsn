<?php //netteCache[01]000361a:2:{s:4:"time";s:21:"0.79929700 1429540047";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Osoby/prehled.latte";i:2;i:1421836786;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Osoby/prehled.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'evupnh0ql2')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb7568983c44_sekce')) { function _lb7568983c44_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Osobní údaje<?php if ($admin): ?> - <?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ;endif ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb318baa156d_obsah')) { function _lb318baa156d_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div>
    <div>
        <table>
            <tr>
                <td>Jméno:</td>
                <td><?php if ($osoba['titul']): echo NTemplateHelpers::escapeHtml($osoba['titul'], ENT_NOQUOTES) ?>
 <?php endif ;echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?></td>
            </tr>  
<?php if ($osoba['rodne_prijmeni']): ?>
            <tr>
                <td>Rodné příjmení</td>
                <td><?php echo NTemplateHelpers::escapeHtml($osoba['rodne_prijmeni'], ENT_NOQUOTES) ?></td>
            </tr>
<?php endif ?>
 
            <tr>
                <td>Evidenční číslo:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($osoba['id'], ENT_NOQUOTES) ?></td>
            </tr>  
            <tr>
                <td>Rodné číslo:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($template->rodneCislo($osoba['rc']), ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>  
            <tr>
                <td>Datum narození:</td>
                <td><?php if ($osoba['narozeni']->format('Y')!=-0001): ?>

<?php echo NTemplateHelpers::escapeHtml($template->date($osoba['narozeni'], "j.n.Y"), ENT_NOQUOTES) ;else: ?>
&nbsp;<?php endif ?></td>
            </tr>
            <tr>
                <td>Adresa:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($osoba['ulice'], ENT_NOQUOTES) ;if ($osoba['ulice']): ?>
,<?php endif ?> <?php echo NTemplateHelpers::escapeHtml($osoba['obec'], ENT_NOQUOTES) ;if ($osoba['obec']): ?>
,<?php endif ?> <?php echo NTemplateHelpers::escapeHtml($osoba['psc'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
            <tr>
                <td>Telefon:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($osoba['mobil'], ENT_NOQUOTES) ;if ($osoba['mobil']&&$osoba['telefon']): ?>
, <?php endif ?> <?php echo NTemplateHelpers::escapeHtml($osoba['telefon'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($osoba['email'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
            <tr>
                <td>Web:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($osoba['web'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
            <tr>
                <td>Poznámka:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($osoba['poznamka'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
<?php if ($osoba['trener']): ?>
            <tr>
                <td>Trenér:</td>
                <td><?php echo NTemplateHelpers::escapeHtml($osoba['trener'], ENT_NOQUOTES) ?>&nbsp;</td>
            </tr>
<?php endif ?>
        </table>
    </div>
   
<?php if ($admin): ?>
<div class="bottom_nav">
        <?php if ($opravneni['edit']): ?><a href="<?php echo htmlSpecialChars($_control->link("Osoby:edit", array($osoba['id']))) ?>
">upravit</a><?php endif ?>

<?php if ($opravneni['zmena_hesla']): ?>
        <a href="<?php echo htmlSpecialChars($_control->link("zmenaHesla", array($osoba['id']))) ?>
">změna hesla</a>
        <a href="<?php echo htmlSpecialChars($_control->link("zmenaJmena", array($osoba['id']))) ?>
">změna jména</a>
<?php endif ?>
        <?php if ($opravneni['pristupove_udaje']): ?><a href="<?php echo htmlSpecialChars($_control->link("Osoby:zmenaPristupovychUdaju", array($osoba['id']))) ?>
">změna přístupových údajů</a><?php endif ?>

        <?php if ($opravneni['view']): ?><a href="<?php echo htmlSpecialChars($_control->link("Osoby:historie", array($osoba['id']))) ?>
">historie</a><?php endif ?>

        <?php if ($opravneni['prestup']): ?><a href="<?php echo htmlSpecialChars($_control->link("Osoby:prestup", array($osoba['id']))) ?>
">přestup</a><?php endif ?>

<?php if ($opravneni['delete']): if ($osoba['platne']=='A'): ?>
                <a  onclick="if (!confirm('Opravdu smazat osobu?')) return false;" href="<?php echo htmlSpecialChars($_control->link("Osoby:delete", array($osoba['id']))) ?>
">smazat</a>
<?php elseif ($osoba['platne']=='N'): ?>
                <a  onclick="if (!confirm('Opravdu obnovit osobu?')) return false;" href="<?php echo htmlSpecialChars($_control->link("Osoby:obnovit", array($osoba['id']))) ?>
">obnovit</a>
<?php endif ;endif ?>
</div>
<?php endif ?>
</div><?php
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