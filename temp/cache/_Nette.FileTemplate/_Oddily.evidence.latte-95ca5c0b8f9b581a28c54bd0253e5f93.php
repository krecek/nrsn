<?php //netteCache[01]000363a:2:{s:4:"time";s:21:"0.72666700 1429540067";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:74:"/home/svn/repos/gymfed/trunk/app/GisModule/templates/Oddily/evidence.latte";i:2;i:1420454201;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"dc83a21 released on 2013-07-11";}}}?><?php

// source file: /home/svn/repos/gymfed/trunk/app/GisModule/templates/Oddily/evidence.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'qbdfh3646d')
;
// prolog NUIMacros
//
// block sekce
//
if (!function_exists($_l->blocks['sekce'][] = '_lba491a7c171_sekce')) { function _lba491a7c171_sekce($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Evidence členů <?php echo NTemplateHelpers::escapeHtml($rok, ENT_NOQUOTES) ?>
 - <?php echo NTemplateHelpers::escapeHtml($oddil['nazev'], ENT_NOQUOTES) ;
}}

//
// block obsah
//
if (!function_exists($_l->blocks['obsah'][] = '_lbe2f230bde0_obsah')) { function _lbe2f230bde0_obsah($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div>

<?php NFormMacros::renderFormBegin($form = $_form = (is_object("vybratRokForm") ? "vybratRokForm" : $_control["vybratRokForm"]), array()) ;if ($form->hasErrors()): ?>    <ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error): ?>        <li><?php echo NTemplateHelpers::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; endforeach ?>
    </ul>
<?php endif ?>
    <table>
        <tr >
            <th><?php $_input = is_object("rok") ? "rok" : $_form["rok"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?></th>
            <td><?php $_input = (is_object("rok") ? "rok" : $_form["rok"]); echo $_input->getControl()->addAttributes(array()) ?></td>
            <td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td>
        </tr>

    </table>
<?php NFormMacros::renderFormEnd($_form) ?>
</div>
<div>

 <table class="evidence">
        <tr>
            <th>
<?php if (isset($razeni['id'])): if ($razeni['id']=='DESC'): ?>
                <a class="dolu" href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'id')))) ?>
">Ev. č.</a>
<?php else: ?>
                 <a class="top" href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'id_DESC')))) ?>
">Ev. č.</a>
<?php endif ?>
                
<?php else: ?>
                <a href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'id')))) ?>
">Ev. č.</a>
<?php endif ?>
            </th>
            <th>
<?php if (isset($razeni['prijmeni'])): if ($razeni['prijmeni']=='DESC'): ?>
                <a class="dolu" href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'prijmeni')))) ?>
">Jméno</a>
<?php else: ?>
                <a class="top" href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'prijmeni_DESC')))) ?>
">Jméno</a>
<?php endif ;else: ?>
                <a href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'prijmeni')))) ?>
">Jméno</a>
<?php endif ?>
            </th>
            <th>
<?php if (isset($razeni['narozeni'])): if ($razeni['narozeni']=='DESC'): ?>
                <a class="dolu" href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'narozeni')))) ?>
">Ročník</a>
<?php else: ?>
                <a class="top" href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'narozeni_DESC')))) ?>
">Ročník</a>
<?php endif ;else: ?>
                <a href="<?php echo htmlSpecialChars($_control->link("evidence", array_merge(array($id,), $filtr, array( 'order' => 'narozeni')))) ?>
">Ročník</a>
<?php endif ?>
            </th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
<?php if (!$osoby || $osoby->rowCount()==0): ?>
        <tr><td colspan="5">žádné evidence pro tento rok</td></tr>
<?php endif ;$iterations = 0; foreach ($osoby as $osoba): ?>
        <tr class="radek">
        <td><?php if ($admin): ?><a href="<?php echo htmlSpecialChars($_control->link("Osoby:prehled", array($osoba['id']))) ?>
"><?php echo NTemplateHelpers::escapeHtml($osoba['id'], ENT_NOQUOTES) ?></a><?php else: echo NTemplateHelpers::escapeHtml($osoba['id'], ENT_NOQUOTES) ;endif ?></td>
            
            <td><?php echo NTemplateHelpers::escapeHtml($osoba['prijmeni'], ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($osoba['jmeno'], ENT_NOQUOTES) ?> </td>
            <td class="center"><?php echo NTemplateHelpers::escapeHtml($template->date($osoba['narozeni'], "Y"), ENT_NOQUOTES) ?></td>
            <td class="center">
<?php if (isset($osoba['registrace']) && ($opravneni['evidence_edit'] || ($opravneni['individualni_clen'] && $osoba['id']==$user->getIdentity()->id))): if (!$osoba['registrace'] && $osoba['od']>=$dnes): ?>
                       <a href="<?php echo htmlSpecialChars($_control->link("zrusitEvidenci", array('id_osoby'=> $osoba['id'], 'rok'=>$filtr['rok']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-del.gif" alt="zrušit evidenci" title="zrušit evidenci" /></a>
<?php endif ;if ($opravneni['individualni_clen'] && $osoba['od']<$dnes): ?>
                       <a href="<?php echo htmlSpecialChars($_control->link("registraceIndividualniPdf", array($oddil['id'], $osoba['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-pdf.gif" alt="pdf" title="pdf" /></a>
                     <?php else: ?>&nbsp;
<?php endif ?>
                <?php else: ?>&nbsp;       
                <?php endif ?></td>  
            <td class="center">
             <?php if ((!$opravneni['individualni_clen'])): ?>    <a style="text-decoration:none;" href="<?php echo htmlSpecialChars($_control->link("upravitOsobu", array($oddil['id'], $osoba['id']))) ?>
"><?php endif ?>

<?php if ($osoba['mobil'] || $osoba['telefon']): ?>
                        <img src="<?php echo htmlSpecialChars($basePath) ?>/css/phone-blue.png" alt="" title="<?php echo htmlSpecialChars($osoba['mobil']) ;if ($osoba['mobil']&&$osoba['telefon']): ?>
, <?php endif ;echo htmlSpecialChars($osoba['telefon']) ?>" />
                     <?php else: ?><img src="<?php echo htmlSpecialChars($basePath) ?>/css/phone-grey.png" alt="" title="nezadáno" />
<?php endif ;if ($osoba['ulice'] && $osoba['obec'] && $osoba['psc']): ?>
                               <img src="<?php echo htmlSpecialChars($basePath) ?>
/css/home-blue.png" alt="" title="<?php echo htmlSpecialChars($osoba['ulice']) ?>
, <?php echo htmlSpecialChars($osoba['obec']) ?>, <?php echo htmlSpecialChars($osoba['psc']) ?>" />
                      <?php else: ?>   <img src="<?php echo htmlSpecialChars($basePath) ?>/css/home-grey.png" alt="" title="nezadáno" />
<?php endif ;if ($osoba['email']): ?>
                      <img src="<?php echo htmlSpecialChars($basePath) ?>/css/mail-blue.png" alt="" title="<?php echo htmlSpecialChars($osoba['email']) ?>" />
                      <?php else: ?><img src="<?php echo htmlSpecialChars($basePath) ?>/css/mail-grey.png" alt="" title="nezadáno" />
<?php endif ?>
<!--                     <img src="<?php echo NTemplateHelpers::escapeHtmlComment($basePath) ?>/css/ico-edit.gif" alt="upravit" title="upravit"/>-->
            <?php if ((!$opravneni['individualni_clen'])): ?>  </a><?php endif ?>

            </td>
        </tr>
        <?php if ($opravneni['individualni_clen'] && $osoba['id']== $user->getIdentity()->id): $evidovany = TRUE ;endif ?>

       
<?php $iterations++; endforeach ?>
 </table>
</div> 
<div>
    Počet evidovaných členů: <?php echo NTemplateHelpers::escapeHtml($osoby->rowCount(), ENT_NOQUOTES) ?> &nbsp;&nbsp;
<?php if ($oddil['id']!=$id_individualni_clenove): ?>
    <br />
    Evidenční poplatek za rok <?php echo NTemplateHelpers::escapeHtml($rok, ENT_NOQUOTES) ?>
: <?php echo NTemplateHelpers::escapeHtml($template->poplatky($osoby->rowCount()), ENT_NOQUOTES) ?> Kč<br />
    Číslo účtu: 121230339/0800 VS <?php echo NTemplateHelpers::escapeHtml($oddil['id'], ENT_NOQUOTES) ?>

<?php endif ;if ($oddil['id']==$id_individualni_clenove && $rok == date('Y')): ?>
    <a href="<?php echo htmlSpecialChars($_control->link("registraceIndividualniPdf", array($oddil['id']))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-pdf.gif" alt="pdf" title="pdf" /></a>
<?php endif ;if ($osoby && $osoby->rowCount()): ?>
    <br /><a href="<?php echo htmlSpecialChars($_control->link("evidenceExport", array($oddil['id'], $rok))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-xls.gif" alt="export do xls" title="export do xls" />&nbsp;Export evidence do xls</a>
    <br /><a href="<?php echo htmlSpecialChars($_control->link("evidenceExportWord", array($oddil['id'], $rok))) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/css/ico-doc.gif" alt="export do docx" title="export do docx" />&nbsp;Export evidence do docx</a>
<?php endif ?>
</div>
<?php if ($rok >= date('Y') && $opravneni['evidence_edit']): ?>
<br />
<div>
    <h3>Přidat do evidence:</h3>
     <div>
<?php NFormMacros::renderFormBegin($form = $_form = (is_object("zobrazitOsobyEvidovaneMinulyRokForm") ? "zobrazitOsobyEvidovaneMinulyRokForm" : $_control["zobrazitOsobyEvidovaneMinulyRokForm"]), array()) ?>
        <table>
            <tr><th>Osoby evidované v roce <?php echo NTemplateHelpers::escapeHtml($rok-1, ENT_NOQUOTES) ?></th>
                <td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td>
        </table>
<?php NFormMacros::renderFormEnd($_form) ?>
    </div>
     <div>
<?php NFormMacros::renderFormBegin($form = $_form = (is_object("vyhledatOsobuForm") ? "vyhledatOsobuForm" : $_control["vyhledatOsobuForm"]), array()) ;if ($form->hasErrors()): ?>        <ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error): ?>               <li><?php echo NTemplateHelpers::escapeHtml($error, ENT_NOQUOTES) ?></li>
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
    
    
    <div>
<?php NFormMacros::renderFormBegin($form = $_form = (is_object("evidovatNovouOsobuForm") ? "evidovatNovouOsobuForm" : $_control["evidovatNovouOsobuForm"]), array()) ?>
        <table>
            <tr><th>Evidovat novou osobu</th><td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td></tr>
        </table>
<?php NFormMacros::renderFormEnd($_form) ?>
     </div>
  <div>
<?php NFormMacros::renderFormBegin($form = $_form = (is_object("csvForm") ? "csvForm" : $_control["csvForm"]), array()) ;if ($form->hasErrors()): ?>        <ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error): ?>            <li><?php echo NTemplateHelpers::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; endforeach ?>
        </ul>
<?php endif ?>
        <table>
            <tr >
                <th><?php $_input = is_object("soubor") ? "soubor" : $_form["soubor"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?> </th>
                <td><?php $_input = (is_object("soubor") ? "soubor" : $_form["soubor"]); echo $_input->getControl()->addAttributes(array()) ?></td>
                <td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td>
            </tr>

        </table>
<?php NFormMacros::renderFormEnd($_form) ?>
    </div>
 </div>
<?php endif ?>

<?php if ($rok >= date('Y') && $opravneni['individualni_clen']): if (!isset($evidovany)): ?>
<a href="<?php echo htmlSpecialChars($_control->link("evidovatOsobu", array($id, $user->getIdentity()->id, $rok))) ?>
">Evidovat</a>
<?php endif ;endif ;if ($admin): ?>
<div class="bottom_nav">
    <a href="<?php echo htmlSpecialChars($_control->link("prehled", array($oddil['id']))) ?>
">Zpět na oddíl</a>
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