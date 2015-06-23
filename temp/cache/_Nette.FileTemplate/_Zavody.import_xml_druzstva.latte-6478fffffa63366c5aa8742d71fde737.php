<?php //netteCache[01]000374a:2:{s:4:"time";s:21:"0.53449000 1430030236";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:85:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/import_xml_druzstva.latte";i:2;i:1430030047;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/import_xml_druzstva.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '2kb6b629b5')
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
<<?php ?>?xml version="1.0" encoding="UTF-8"?>
<gis>
    <kategorie>
        <id><?php echo NTemplateHelpers::escapeHtml($kategorie, ENT_NOQUOTES) ?></id>
<?php $iterations = 0; foreach ($druzstva as $druzstvo): ?>
            <druzstvo>
                <id><?php echo NTemplateHelpers::escapeHtml($druzstvo['id'], ENT_NOQUOTES) ?></id>
                <nazev_druzstva><?php echo NTemplateHelpers::escapeHtml($druzstvo['nazev_druzstva'], ENT_NOQUOTES) ?></nazev_druzstva>
                <oddil><?php echo NTemplateHelpers::escapeHtml($druzstvo['oddil'], ENT_NOQUOTES) ?></oddil>
                <poradi><?php echo NTemplateHelpers::escapeHtml($druzstvo['poradi'], ENT_NOQUOTES) ?></poradi>
                <body><?php echo NTemplateHelpers::escapeHtml($druzstvo['body'], ENT_NOQUOTES) ?></body>
                    
<?php $iterations = 0; foreach ($pouzite_naradi as $naradi): ?>
                <<?php echo NTemplateHelpers::escapeHtml($naradi, ENT_NOQUOTES) ?>>
                    <body><?php echo NTemplateHelpers::escapeHtml($druzstvo[$naradi]['body'], ENT_NOQUOTES) ?></body>
                    <pen><?php echo NTemplateHelpers::escapeHtml($druzstvo[$naradi]['pen'], ENT_NOQUOTES) ?></pen>
                </<?php echo NTemplateHelpers::escapeHtml($naradi, ENT_NOQUOTES) ?>>
<?php $iterations++; endforeach ;$iterations = 0; foreach ($druzstvo['osoby'] as $osoba): ?>
                    <osoba>
                        <id><?php echo NTemplateHelpers::escapeHtml($osoba['osoba'], ENT_NOQUOTES) ?></id>
                        <jmeno><?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?></jmeno>
                        <prijmeni><?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?></prijmeni>
                        <rocnik><?php echo NTemplateHelpers::escapeHtml($osoba['rocnik'], ENT_NOQUOTES) ?></rocnik>
                        <poradi><?php echo NTemplateHelpers::escapeHtml($osoba['poradi'], ENT_NOQUOTES) ?></poradi>
                        <body><?php echo NTemplateHelpers::escapeHtml($osoba['body'], ENT_NOQUOTES) ?></body>
                        <trener><?php if (isset($osoba['trener'])): echo NTemplateHelpers::escapeHtml($osoba['trener'], ENT_NOQUOTES) ;endif ?></trener>
                        <oddil><?php if (isset($osoba['oddil'])): echo NTemplateHelpers::escapeHtml($osoba['oddil'], ENT_NOQUOTES) ;else: ?>
0<?php endif ?></oddil>
                        <nazev_oddilu><?php if (isset($osoba['nazev_oddilu'])): echo NTemplateHelpers::escapeHtml($osoba['nazev_oddilu'], ENT_NOQUOTES) ;endif ?></nazev_oddilu>
                        <poznamka><?php if (isset($osoba['poznamka'])): echo NTemplateHelpers::escapeHtml($osoba['poznamka'], ENT_NOQUOTES) ;endif ?></poznamka>
<?php $iterations = 0; foreach ($pouzite_naradi as $naradi): ?>
                            <<?php echo NTemplateHelpers::escapeHtml($naradi, ENT_NOQUOTES) ?>>
                            <d><?php echo NTemplateHelpers::escapeHtml($osoba[$naradi.'_d'], ENT_NOQUOTES) ?></d>
                            <e><?php echo NTemplateHelpers::escapeHtml($osoba[$naradi.'_e'], ENT_NOQUOTES) ?></e>
                            <p><?php echo NTemplateHelpers::escapeHtml($osoba[$naradi.'_p'], ENT_NOQUOTES) ?></p>
                            <body><?php echo NTemplateHelpers::escapeHtml($osoba[$naradi.'_body'], ENT_NOQUOTES) ?></body>
                            </<?php echo NTemplateHelpers::escapeHtml($naradi, ENT_NOQUOTES) ?>>
<?php $iterations++; endforeach ?>
                    </osoba>
<?php $iterations++; endforeach ?>
                </druzstvo>
<?php $iterations++; endforeach ?>
        
    </kategorie>
</gis>