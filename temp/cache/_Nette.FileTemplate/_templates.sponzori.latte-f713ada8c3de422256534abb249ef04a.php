<?php //netteCache[01]000356a:2:{s:4:"time";s:21:"0.21446300 1429520518";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:67:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/sponzori.latte";i:2;i:1421749170;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/sponzori.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '6d9g88yf7k')
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
<h3 class="oddelit">Sponzoři a partneři</h3>
<div class="obr-box sponzori">
<a href="http://www.manufaktura.cz/" target="_blank">MANUFAKTURA<br /><img src="<?php echo htmlSpecialChars($basePath) ?>/images/logo-manufaktura.png" alt="Manufaktura" title="Manufaktura" /></a>
<a href="http://www.prospect.cz/" target="_blank">PROSPECT<br /><img src="<?php echo htmlSpecialChars($basePath) ?>/images/logo-prospect.png" alt="Manufaktura" title="Prospect" /></a>
<a href="http://www.msmt.cz/" target="_blank">MŠMT (MINISTERSTVO ŠKOLSTVÍ, MLÁDEŽE A TĚLOVÝCHOVY)<br /><img src="<?php echo htmlSpecialChars($basePath) ?>/images/logo-MSMT.jpg" alt="MŠMT" title="MŠMT" /></a>
<a href="http://www.olympic.cz/" target="_blank">ČOV (ČESKÝ OLYMPIJSKÝ VÝBOR)<br /><img src="<?php echo htmlSpecialChars($basePath) ?>/images/logo-COV.png" alt="ČOV" title="ČOV" /></a>
<a href="https://www.fig-gymnastics.com/site/" target="_blank">FIG (MEZINÁRODNÍ GYMNASTICKÁ FEDERACE)<br /><img src="<?php echo htmlSpecialChars($basePath) ?>/images/logo_FIG.jpg" alt="FIG" title="FIG" /></a>
<a href="http://www.ueg.org/"  target="_blank">UEG (EVROPSKÁ GYMNASTICKÁ UNIE)<br /><img src="<?php echo htmlSpecialChars($basePath) ?>/images/logo-UEG.png" alt="UEG" title="UEG" /></a>
<a href="http://www.dionysports.com"  target="_blank">DIONY SPORTS<br /><img src="<?php echo htmlSpecialChars($basePath) ?>/images/logo-dionysports.png" alt="Diony sports" title="Diony sports" /></a>
</div>