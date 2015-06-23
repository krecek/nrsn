<?php //netteCache[01]000376a:2:{s:4:"time";s:21:"0.06762100 1430968071";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:87:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Kalendar/terminovaListinaPdf.latte";i:2;i:1415377191;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Kalendar/terminovaListinaPdf.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '09g6rzwbzj')
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
<link rel="stylesheet" media="print" href="<?php echo htmlSpecialChars($basePath) ?>/css/pdf.css" />
<!--mpdf
<?php $iterations = 0; foreach ($sporty as $zkr=>$sport): if ($zkr=='XX'): ?>
    <pageheader name="XX" content-right="Termínová listina"  header-style="font-size: 9pt; font-weight: bold; color: grey; font-style:italic;"/>
<?php else: ?>
    <pageheader name="<?php echo NTemplateHelpers::escapeHtmlComment($zkr) ?>"  content-right="<?php echo NTemplateHelpers::escapeHtmlComment($template->firstUpper($sport->sport)) ?>" header-style="font-size: 9pt; font-weight: bold; color: grey; font-style:italic;"/>
<?php endif ;$iterations++; endforeach ?>
<pagefooter name="paticka" content-left="Termínová listina" content-right="{PAGENO} / {nb}" footer-style="font-size: 9pt; font-weight: bold; color: grey; font-style:italic;"/>
mpdf-->
<div style="text-align:center;">
    <span style="text-transform: uppercase; letter-spacing: 1px; font-weight: bold; font-size: 150%;">Česká gymnastická federace</span><br />
<span><i>Zátopkova 100/2, 160 17 Praha 6, tel./fax:  242 429 260,  e-mail: cgf@gymfed.cz</i></span><br /><br /><br /><br />
<span style="text-transform: uppercase; letter-spacing: 1px; font-weight: bold;font-size: 150%;">Termínová listina</span><br />
<span style="text-transform: uppercase; letter-spacing: 1px; font-weight: bold;font-size: 150%;"><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($od, $do), ENT_NOQUOTES) ?></span>
<img src="<?php echo htmlSpecialChars($basePath) ?>/css/cgf-logo-velke.jpg" />
</div>
<?php if (isset($terminova_listina_XX)): ?>

<!--mpdf
<setpageheader name="XX" value="on"  />

mpdf-->
<pagebreak margin-top="100">
   
    <table>
<?php $iterations = 0; foreach ($terminova_listina_XX as $akce): ?>
            <tr>
                    <td><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?></td>
                    <td><?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?></td>
                    <td><?php echo NTemplateHelpers::escapeHtml($akce['misto'], ENT_NOQUOTES) ?></td>
            </tr>
<?php $iterations++; endforeach ?>
    </table>
<?php endif ;$iterations = 0; foreach ($terminovaListina as $sport=>$seznam_akci): if ($sport!='XX'): ?>
<!--mpdf
<setpageheader name="<?php echo NTemplateHelpers::escapeHtmlComment($sporty[$sport]) ?>" value="on" />
<setpagefooter name="paticka" value="on" />
mpdf-->
<pagebreak pagenumstyle='1' margin-top="100" >
<h2><?php echo NTemplateHelpers::escapeHtml($template->firstUpper($sporty[$sport]->sport), ENT_NOQUOTES) ?></h2>
<table>
<?php $iterations = 0; foreach ($seznam_akci as $akce): ?>
    <tr>
        <td><?php echo NTemplateHelpers::escapeHtml($template->datumKonani($akce['od'], $akce['do']), ENT_NOQUOTES) ?></td>
        <td><?php echo NTemplateHelpers::escapeHtml($akce['nazev'], ENT_NOQUOTES) ?></td>
        <td><?php echo NTemplateHelpers::escapeHtml($akce['misto'], ENT_NOQUOTES) ?></td>
    </tr>
<?php $iterations++; endforeach ?>
</table>
<?php endif ;$iterations++; endforeach ;