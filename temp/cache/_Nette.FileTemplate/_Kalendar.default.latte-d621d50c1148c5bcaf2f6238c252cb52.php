<?php //netteCache[01]000364a:2:{s:4:"time";s:21:"0.10046200 1429602646";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Kalendar/default.latte";i:2;i:1415627502;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Kalendar/default.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '4yyrqlcncc')
;
// prolog NUIMacros
//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb53bc45f8b2_head')) { function _lb53bc45f8b2_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><script type="text/javascript">
$(document).ready(function() {
  $.datepicker.regional['cs'] = {
        closeText: 'Cerrar',
        prevText: 'Předchozí',
        nextText: 'Další',
        currentText: 'Hoy',
        monthNames: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'],
        monthNamesShort: ['Le', 'Ún', 'Bř', 'Du', 'Kv', 'Čn', 'Čc', 'Sr', 'Zá', 'Ří', 'Li', 'Pr'],
        dayNames: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
        dayNamesShort: ['Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So', ],
        dayNamesMin: ['Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So'],
        weekHeader: 'Sm',
        dateFormat: 'd.m.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['cs']);
    $("#from").datepicker({
        onClose: function(selectedDate) {
            $("#to").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#to").datepicker({
        defaultDate: "+1w",
        onClose: function(selectedDate) {
            $("#from").datepicker("option", "maxDate", selectedDate);
        }
    });
});
</script>
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb91b8fcf423_content')) { function _lb91b8fcf423_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_ctrl = $_control->getComponent("drobeckovaNavigace"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<h2> <?php echo NTemplateHelpers::escapeHtml($template->datumKonani($od, $do), ENT_NOQUOTES) ?></h2>
<table>

<?php NFormMacros::renderFormBegin($form = $_form = (is_object("akceFiltr") ? "akceFiltr" : $_control["akceFiltr"]), array()) ?>
    <tr>
        <th><?php $_input = is_object("obdobi") ? "obdobi" : $_form["obdobi"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?></th>
        <th><?php $_input = is_object("sport") ? "sport" : $_form["sport"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?></th>
        <th>&nbsp;</th>
    </tr>
    <tr>
        <td><?php $_input = (is_object("obdobi") ? "obdobi" : $_form["obdobi"]); echo $_input->getControl()->addAttributes(array()) ?></td>
        <td><?php $_input = (is_object("sport") ? "sport" : $_form["sport"]); echo $_input->getControl()->addAttributes(array()) ?></td>
        <td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td>
    </tr>
<?php NFormMacros::renderFormEnd($_form) ?>
 
<div id="<?php echo $_control->getSnippetId('seznam_akci') ?>"><?php call_user_func(reset($_l->blocks['_seznam_akci']), $_l, $template->getParameters()) ?>
</div></table>

<br />
<a class='ico-pdf' href="<?php echo htmlSpecialChars($_control->link("export", array('format'=>'pdf'))) ?>
">Termínová listina (pdf)</a><br />
<a class='ico-xls' href="<?php echo htmlSpecialChars($_control->link("export", array('format'=>'xls'))) ?>
">Termínová listina (xls)</a><br />
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbf6a2401149_title')) { function _lbf6a2401149_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="oddelit">Kalendář akcí</h1><?php
}}

//
// block _seznam_akci
//
if (!function_exists($_l->blocks['_seznam_akci'][] = '_lb32138d13e9__seznam_akci')) { function _lb32138d13e9__seznam_akci($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('seznam_akci')
;if (count($seznam_akci)): $iterations = 0; foreach ($seznam_akci as $akce): ?>
    <tr><td><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?>
</td><td><?php if ($akce['sport']=='XX'): ?>&nbsp;<?php else: echo NTemplateHelpers::escapeHtml($akce['sport'], ENT_NOQUOTES) ;endif ?>
</td><td><a href="<?php echo htmlSpecialChars($_control->link("detail", array($akce["id"]))) ?>
"><?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?></a></td></tr>
<?php $iterations++; endforeach ;else: ?>
    <tr><td colspan='3'>
    Nebyly nalezeny žádné akce odpovídající požadavkům.</td>
    </tr>
<?php endif ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof NPresenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 