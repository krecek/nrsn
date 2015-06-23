<?php //netteCache[01]000360a:2:{s:4:"time";s:21:"0.40297600 1429539382";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:71:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prava.latte";i:2;i:1420544548;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prava.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'w1ocggsmpp')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb19fe351dc1_sekce')) { function _lb19fe351dc1_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Práva <?php if ($nazev): ?>- <?php echo NTemplateHelpers::escapeHtml($nazev, ENT_NOQUOTES) ;endif ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb6996967424_obsah')) { function _lb6996967424_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("prehledPrav"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;if ($moznost_uprav): $_ctrl = $_control->getComponent("priraditPravaForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;if (isset($osoby)): ?>
<div>
    Vyberte osobu:
    <table>
<?php $iterations = 0; foreach ($osoby as $osoba): ?>
        <tr>
            <td><a href="<?php echo htmlSpecialChars($_control->link("nastaveniPrav", array('osoba'=>$osoba['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?> <?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?></a></td>
            <td><?php echo NTemplateHelpers::escapeHtml($template->date($osoba['narozeni']('Y')), ENT_NOQUOTES) ?></td>            
        </tr>
<?php $iterations++; endforeach ?>
    </table>
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
call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars()) ?>
 

<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars()) ; 