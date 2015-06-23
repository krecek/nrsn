<?php //netteCache[01]000361a:2:{s:4:"time";s:21:"0.78766100 1429538032";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:72:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Banka/default.latte";i:2;i:1410256595;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Banka/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'i93rs5h6lf')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb63b7625f85_sekce')) { function _lb63b7625f85_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Vyhledat účet<?php
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbe2b33ac51f_obsah')) { function _lbe2b33ac51f_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div>

<?php NFormMacros::renderFormBegin($form = $_form = (is_object("vyhledatOddilForm") ? "vyhledatOddilForm" : $_control["vyhledatOddilForm"]), array()) ;if ($form->hasErrors()): ?>    <ul class="errors">
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
<?php $_input = is_object("id") ? "id" : $_form["id"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ;$_input = (is_object("id") ? "id" : $_form["id"]); echo $_input->getControl()->addAttributes(array()) ;NFormMacros::renderFormEnd($_form) ?>
</div>
<?php if (isset($oddily)): ?>
<div>
    <table>
<?php $iterations = 0; foreach ($oddily as $oddil): ?>
        <tr>
            <td><a href="<?php echo htmlSpecialChars($_control->link("detail", array($oddil['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($oddil['nazev'], ENT_NOQUOTES) ?></a></td>
        </tr>
<?php $iterations++; endforeach ?>
    </table>
</div>
<?php endif ;if (isset($osoby)): ?>
<div>
    <table>
<?php $iterations = 0; foreach ($osoby as $osoba): ?>
        <tr>
            <td><a href="<?php echo htmlSpecialChars($_control->link("detail", array($osoba['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?> <?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?></a></td>
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
call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars()) ; 