<?php //netteCache[01]000382a:2:{s:4:"time";s:21:"0.98376400 1429520478";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:93:"/home/svn/repos/gymfed/trunk/app/WebModule/components/TerminovaListina/terminovaListina.latte";i:2;i:1420633089;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/components/TerminovaListina/terminovaListina.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'gdfw321903')
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
<div class='seznam_akci'>
 
    <h2></h2>
        <div class="akce">
            <div class="akce_zahlavi oddo">
                <h3>Termínová listina</h3>
            </div>
            <div class="popis_akce">
                <ul>
                    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Kalendar:export")) ?>" class="ico-pdf">Termínová listina (pdf)</a></li>
                    <li><a href="<?php echo htmlSpecialChars($_presenter->link("Kalendar:export", array('xls'))) ?>" class="ico-xls">Termínová listina (xls)</a></li>

                </ul>
            </div>
        </div>   
   
</div>