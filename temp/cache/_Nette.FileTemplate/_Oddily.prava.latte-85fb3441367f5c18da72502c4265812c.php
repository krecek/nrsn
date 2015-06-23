<?php //netteCache[01]000360a:2:{s:4:"time";s:21:"0.33889000 1430391507";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:71:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Oddily/prava.latte";i:2;i:1415096099;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Oddily/prava.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'krw2u8unjb')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lbb015543b22_sekce')) { function _lbb015543b22_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Práva - <?php if (!($oddil)): ?>globální <?php else: ?> <?php echo NTemplateHelpers::escapeHtml($oddil['nazev'], ENT_NOQUOTES) ;endif ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb7da70f834c_obsah')) { function _lb7da70f834c_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("prehledPrav"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;if ($moznost_uprav): ?>

<?php NFormMacros::renderFormBegin($form = $_form = (is_object("priraditPravaForm") ? "priraditPravaForm" : $_control["priraditPravaForm"]), array()) ;if ($form->hasErrors()): ?>    <ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error): ?>        <li><?php echo NTemplateHelpers::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; endforeach ?>
</ul>
<?php endif ?>

<table>
    <tr >
        <th><?php $_input = is_object("popis") ? "popis" : $_form["popis"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?></th>
        <td><?php $_input = (is_object("popis") ? "popis" : $_form["popis"]); echo $_input->getControl()->addAttributes(array()) ?></td>
        <td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td>
    </tr>

</table>
<?php $_input = is_object("id") ? "id" : $_form["id"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ;$_input = (is_object("id") ? "id" : $_form["id"]); echo $_input->getControl()->addAttributes(array()) ;NFormMacros::renderFormEnd($_form) ;endif ;if (isset($osoby)): ?>
<div>
    Vyberte osobu:
    <table>
<?php $iterations = 0; foreach ($osoby as $osoba): ?>
        <tr>
            <td><a href="<?php echo htmlSpecialChars($_control->link("nastaveniPrav", array('osoba'=>$osoba['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?> <?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?></a></td>
            <td><?php echo NTemplateHelpers::escapeHtml($template->date($osoba['narozeni'], 'j.n.Y'), ENT_NOQUOTES) ?></td>            
        </tr>
<?php $iterations++; endforeach ?>
    </table>
</div>
<?php endif ;if ($moznost_uprav): if (!$shodna_prava_banka): if ($oddil['id']==$id_individualni_clenove): ?>
<a onclick="if(!confirm('Všem individuálním členům budou nastavena práva pro jejich osobní účet v modulu BANKA. Opravdu provést?'))return false;" href="<?php echo htmlSpecialChars($_control->link("nastaveniPravProBankuIndividualni")) ?>
">Nastavit individuálním členům práva do modulu BANKA</a>
<?php else: ?>
<a onclick="if(!confirm('Všechna práva z modulu BANKA budou nahrazena právy z modulu ODDÍLY. Opravdu provést?'))return false;" href="<?php echo htmlSpecialChars($_control->link("nastaveniPravProBanku", array($oddil['id']))) ?>
">Překopírovat práva do modulu BANKA</a>
<?php endif ?>
<br />
<?php endif ;if (!$shodna_prava_zavody): ?>
        
<?php if ($oddil['id']==$id_individualni_clenove): ?>
            <a onclick="if(!confirm('Všem individuálním členům budou nastavena práva pro modul ZÁVODY. Opravdu provést?'))return false;" href="<?php echo htmlSpecialChars($_control->link("nastaveniPravProZavodyIndividualni")) ?>
">Nastavit individuálním členům práva do modulu ZÁVODY</a>
<?php else: ?>
            <a onclick="if(!confirm('Všechna práva z modulu ZÁVODY budou nahrazena právy z modulu ODDÍLY. Opravdu provést?'))return false;" href="<?php echo htmlSpecialChars($_control->link("nastaveniPravProZavody", array($oddil['id']))) ?>
">Překopírovat práva do modulu ZÁVODY</a>
<?php endif ;endif ;endif ;
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