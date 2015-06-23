<?php //netteCache[01]000362a:2:{s:4:"time";s:21:"0.41438800 1429537970";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:73:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prilohy.latte";i:2;i:1428914175;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Zavody/prilohy.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'qxuc1l4owi')
;
// prolog NUIMacros
//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb7774bc6c35_head')) { function _lb7774bc6c35_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>  
<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(document).ready(function() {
    // Setup html5 version
    $("#uploader").pluploadQueue({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : '../../upload/<?php echo $id ?>',
         
        chunk_size : '1mb',
        rename : true,
        dragdrop: true,
         
        filters : {
            // Maximum file size
            max_file_size : '20mb',
            // Specify what files to browse for
            mime_types: [
                { title : "Image files", extensions : "jpg,gif,png"},
                { title : "Zip files", extensions : "zip"},
                { title : "Pdf files", extensions : "pdf"},
                { title : "Excel files", extensions : "xls,xlsx,csv"},
                { title : "Word files", extensions : "doc,docx"},
                { title : "Text files", extensions : "txt"},
                { title : "Movie files", extensions : "mov,avi"}
            ]
        },
 
//        // Resize images on clientside if we can
        resize: {
            width : <?php echo NTemplateHelpers::escapeJs($max_rozmery_obrazku['vyska']) ?>,
            height : <?php echo NTemplateHelpers::escapeJs($max_rozmery_obrazku['sirka']) ?>,
            quality : 100,
            crop: false // crop to exact dimensions
        },
                // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
        multiple_queues: true,
        prevent_duplicates: true,
 
        flash_swf_url : '/js/plupload/Moxie.swf',
        silverlight_xap_url : '/js/plupload/Moxie.xap'
    });
    

});
     
</script>
<?php
}}

//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lb25a82f8a23_sekce')) { function _lb25a82f8a23_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přílohy - <?php echo NTemplateHelpers::escapeHtml($akce->nazev, ENT_NOQUOTES) ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lb09a8d31ae2_obsah')) { function _lb09a8d31ae2_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
 ?>
<div id="<?php echo $_control->getSnippetId('seznamPriloh') ?>"><?php call_user_func(reset($_l->blocks['_seznamPriloh']), $_l, $template->getParameters()) ?>
</div><div id="uploader">
<?php $_ctrl = $_control->getComponent("nahratPrilohyForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</div>
<?php $_ctrl = $_control->getComponent("nahratVysledkyForm"); if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
<div class="bottom_nav">
<a href="<?php echo htmlSpecialChars($_control->link("detail", array($akce->id))) ?>
">Zpět</a>
</div><?php
}}

//
// block _seznamPriloh
//
if (!function_exists($_l->blocks['_seznamPriloh'][] = '_lbe5e60ff84e__seznamPriloh')) { function _lbe5e60ff84e__seznamPriloh($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->validateControl('seznamPriloh')
;NFormMacros::renderFormBegin($form = $_form = (is_object("prilohyForm") ? "prilohyForm" : $_control["prilohyForm"]), array()) ?>
<table class='no_inline'>
<?php $i=0; $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($seznam_priloh) as $adresa=>$priloha): ?>
    <tr>
        <td>
            <a href="<?php echo htmlSpecialChars($basePath) ?>/<?php echo htmlSpecialChars($adresa) ?>" >
                <?php if ($priloha['je_obrazek']): ?> <img src="<?php echo htmlSpecialChars($basePath) ?>
/css/ico-foto.png" /><?php else: ?> <img src="<?php echo htmlSpecialChars($basePath) ?>
/<?php echo htmlSpecialChars($priloha['nahled']) ?>" alt="<?php echo htmlSpecialChars($priloha['nazev']) ?>
" /><?php endif ?>

               
            </a>
        </td>
        <td class="left"><?php echo NTemplateHelpers::escapeHtml($priloha['nazev'], ENT_NOQUOTES) ?></td>
        <td><?php $_input = (is_object("typ_".$i) ? "typ_".$i : $_form["typ_".$i]); echo $_input->getControl()->addAttributes(array()) ;$_input = (is_object("nazev_".$i) ? "nazev_".$i : $_form["nazev_".$i]); echo $_input->getControl()->addAttributes(array()) ?></td>
        <td class="right">
            <a data-confirm="Opravdu smazat přílohu?" class="ajax" href="<?php echo htmlSpecialChars($_control->link("deletePriloha!", array($akce->id,$priloha['nazev']))) ?>
">
                <img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="smazat prilohu" title="smazat prilohu" />
            </a> 
        </td>
   </tr>
<?php $i++ ;if ($iterator->isLast()): ?>
   <tr class="submit_hidden">
       <td colspan="2">&nbsp;</td>
       <td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td>
       <td>&nbsp;</td>
   </tr>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</table>

<?php NFormMacros::renderFormEnd($_form) ;
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
call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['sekce']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['obsah']), $_l, get_defined_vars()) ; 