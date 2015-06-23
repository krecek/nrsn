<?php //netteCache[01]000366a:2:{s:4:"time";s:21:"0.38953500 1429534079";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:77:"/home/svn/repos/gymfed/trunk/app/WebModule/components/Kalendar/kalendar.latte";i:2;i:1415623279;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/Kalendar/kalendar.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '3s56i0e7gd')
;
// prolog NUIMacros
//
// block _kalendar
//
if (!function_exists($_l->blocks['_kalendar'][] = '_lb1bee07b2a6__kalendar')) { function _lb1bee07b2a6__kalendar($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('kalendar')
?><div id="calendar"><h3 class="oddelit"><a href="<?php echo htmlSpecialChars($_presenter->link("Kalendar:")) ?>">Kalendář akcí</a></h3>
    <div class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;">
    <div id="calendar_title" class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all"><a class='ajax ui-datepicker-prev ui-corner-all' title='předcházející měsíc' href="<?php echo htmlSpecialChars($_control->link("change!", array($lastMonth['mesic'],$lastMonth['rok']))) ?>
"><span class="ui-icon ui-icon-circle-triangle-w"><<</span></a>
        <div class="ui-datepicker-title"><?php echo NTemplateHelpers::escapeHtml($mesic_text, ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($rok, ENT_NOQUOTES) ?></div>
        <a class='ajax ui-datepicker-next ui-corner-all' title='další měsíc' href="<?php echo htmlSpecialChars($_control->link("change!", array($nextMonth['mesic'],$nextMonth['rok']))) ?>
"><span class="ui-icon ui-icon-circle-triangle-e">>></span></a></div>
<table>
    <thead>
        <tr>
            <th>Po</th>
            <th>Út</th>
            <th>St</th>
            <th>Čt</th>
            <th>Pá</th>
            <th>So</th>
            <th>Ne</th>
        </tr>
    </thead>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($mesic) as $tyden): ?>
    <tr>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($tyden) as $den): ?>
        <?php if (isset($akce[$den])): ?><td title="<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($akce[$den]) as $ak): echo htmlSpecialChars($ak['nazev']) ;if (!$iterator->isLast()): ?>
, <?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
" ><a  class='den_s_akci' href="<?php echo htmlSpecialChars($_presenter->link("Kalendar:", array('termin'=>$rok.'-'.$month.'-'.$den, 'obdobi'=>0))) ?>
"><?php echo NTemplateHelpers::escapeHtml($den, ENT_NOQUOTES) ?></a></td>
<?php elseif ($den): ?>
        <td><a class='ui-state-default' href='<?php echo htmlSpecialChars($_presenter->link("Kalendar:", array('termin'=>$rok.'-'.$month.'-'.$den, 'obdobi'=>0)), ENT_QUOTES) ?>
'><?php echo NTemplateHelpers::escapeHtml($den, ENT_NOQUOTES) ?></a></td>
        <?php else: ?><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp</td>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    </tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</table>
    </div>
</div>
<?php
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
if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>
<div id="<?php echo $_control->getSnippetId('kalendar') ?>"><?php call_user_func(reset($_l->blocks['_kalendar']), $_l, $template->getParameters()) ?>
</div>