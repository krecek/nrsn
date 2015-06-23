<?php //netteCache[01]000360a:2:{s:4:"time";s:21:"0.53844900 1430968032";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:71:"/home/svn/repos/gymfed/trunk/app/WebModule/templates/Homepage/rss.latte";i:2;i:1396954812;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/WebModule/templates/Homepage/rss.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '8ip4g5wak8')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$netteHttpResponse->setHeader("Content-Type", 'application/rss+xml; charset=utf-8') ?>
<<?php ?>?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title>Česká gymnastická federace</title>
        <link><?php echo NTemplateHelpers::escapeXml($_control->link("//Homepage:default")) ?></link>
        <description>Česká gymnastická federace</description>
        <language>cs</language>
        <image>
            <url><?php echo NTemplateHelpers::escapeXml($basePath) ?>/images/cgf-logo_smallx.jpg</url>
            <title>Česká gymnastická federace</title>
            <link><?php echo NTemplateHelpers::escapeXml($_control->link("//Homepage:default")) ?></link>
            <width>120</width>
            <height>99</height>
        </image>

<?php $iterations = 0; foreach ($clanky as $clanek): ?>
        <item>
            <title><?php echo NTemplateHelpers::escapeXml($clanek->nadpis) ?></title>
            <link><?php echo NTemplateHelpers::escapeXml($_control->link("//Clanky:default", array($clanek->url))) ?></link>
            <description><?php echo NTemplateHelpers::escapeXml($clanek->perex) ?></description>
            <pubDate><?php echo NTemplateHelpers::escapeXml($clanek->zobrazit_od->format('r')) ?></pubDate>
            <enclosure url="<?php echo NTemplateHelpers::escapeXml($_control->link("//Homepage:default")) ;echo NTemplateHelpers::escapeXml($basePath) ?>
/<?php echo NTemplateHelpers::escapeXml($clanek['nahled']) ?>" length="<?php echo NTemplateHelpers::escapeXml($clanek['nahled_velikost']) ?>
" type="<?php echo NTemplateHelpers::escapeXml($clanek['nahled_type']) ?>"/>
        </item>
<?php $iterations++; endforeach ?>
    </channel>
</rss>