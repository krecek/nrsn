<?php //netteCache[01]000357a:2:{s:4:"time";s:21:"0.03276700 1429802261";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:68:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Osoby/add.latte";i:2;i:1380903060;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Osoby/add.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'ng3rgpla1k')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb3613a33b90_sekce')) { function _lb3613a33b90_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Nová osoba<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lba8ff32ad1e_obsah')) { function _lba8ff32ad1e_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if (isset($podobne_osoby)): ?>
<div class="flash error">
    
Narozeni ve stejný den:
<ul>
<?php $iterations = 0; foreach ($podobne_osoby['narozeni'] as $podobna_osoba): ?>
    <li>
<a href="<?php echo htmlSpecialChars($_control->link("prehled", array($podobna_osoba['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($podobna_osoba['jmeno'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($podobna_osoba['prijmeni'], ENT_NOQUOTES) ?>
</a> <?php echo NTemplateHelpers::escapeHtml($template->date($podobna_osoba['narozeni'], 'j.n.Y'), ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($template->rodneCislo($podobna_osoba['rc']), ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($podobna_osoba['email'], ENT_NOQUOTES) ?>
,<?php echo NTemplateHelpers::escapeHtml($podobna_osoba['obec'], ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($podobna_osoba['poznamka'], ENT_NOQUOTES) ?>

    </li>
<?php $iterations++; endforeach ?>
</ul>
</div>
<div class="flash error">
Se stejným jménem:
<ul>
<?php $iterations = 0; foreach ($podobne_osoby['jmeno'] as $podobna_osoba): ?>
    <li>
       <a href="<?php echo htmlSpecialChars($_control->link("prehled", array($podobna_osoba['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($podobna_osoba['jmeno'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($podobna_osoba['prijmeni'], ENT_NOQUOTES) ?>
</a>  <?php echo NTemplateHelpers::escapeHtml($template->date($podobna_osoba['narozeni'], 'j.n.Y'), ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($template->rodneCislo($podobna_osoba['rc']), ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($podobna_osoba['email'], ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($podobna_osoba['obec'], ENT_NOQUOTES) ?>
, <?php echo NTemplateHelpers::escapeHtml($podobna_osoba['poznamka'], ENT_NOQUOTES) ?>

    </li>
        
<?php $iterations++; endforeach ?>
</ul>
</div>
<?php endif ?>

<?php $_ctrl = $_control->getComponent("addOsobaForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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