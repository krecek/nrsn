<?php //netteCache[01]000372a:2:{s:4:"time";s:21:"0.17454100 1429520518";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:83:"/home/svn/repos/gymfed/trunk/app/WebModule/components/vyhledavani/vyhledavani.latte";i:2;i:1396016116;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/vyhledavani/vyhledavani.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'ojxuyw1bgr')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<div id="vyhledavani">
<?php NFormMacros::renderFormBegin($form = $_form = (is_object("vyhledatForm") ? "vyhledatForm" : $_control["vyhledatForm"]), array()) ?>
    <?php $_input = (is_object("vyhledat") ? "vyhledat" : $_form["vyhledat"]); echo $_input->getControl()->addAttributes(array()) ;$_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?>

<?php NFormMacros::renderFormEnd($_form) ?>
</div>