$(function() {
    $.nette.ext('onchange', {
        load: function() {
            $("select.ajax, input[type=checkbox].ajax").change(function() {
                $(this).closest('form').submit();
            });
        }
    });
    $.nette.init();
});
$(document).on("click", "a.noveokno", function(e) {

    e.preventDefault();

    var url = $(this).attr('href');
    var snippUrl = $(this).attr('data-url');
    $("#modal").dialog({
        modal: true,
        autoOpen: true,
        closeOnEscape: true,
        resizable: true,
        open: function()
        {
            console.log('a', 'a');
//          $.nette.ajax({url: url});
//            $.nette.ajax({url: url});
            $(this).load(url);
        },
//        height: 400,
//        width: 500,
        title: '',
        close: function() {
            $(this).dialog('destroy');
            $.nette.ajax({url: snippUrl});
        }
    });

});

$(document).ready(function() {


    //===================== FOCUS =========
    $('.focus').focus();

    //=================== ZVÝRAZNĚNÍ AKTUÁLNÍHO ŘÁDKU ============  
    $(".radek").mouseenter(function() {
        $(this).addClass('aktualni_radek');
    }
    );
    $(".radek").mouseleave(function() {
        $(this).removeClass('aktualni_radek');
    });

    $("table.hover tr td").hover(function(element) {
        $(this).parent('tr').toggleClass('aktualni_radek')
    });

    //=====================SKRÝT ELEMENT ================
//    $('#snippet--k_prihlaseni').find(".hidden_js").addClass('hidden');

    //=====================VYBRAT OSOBU ==================
    //vyplní id osoby a odešle formulář
    $('.vyhledat_osobu').autocomplete({
        source: '/Ajax/autocompleteOsoby',
        delay: 0,
        minLength: 3,
        focus: function(event, ui) {
            return false;
        },
        select: function(event, ui) {
            $('input[id$=popis]').val(ui.item.label);
            $('input[id$=id]').val(ui.item.value);
            $('#frm-vyhledatOsobuForm, .vyhledat_form').submit();
            return false;
        }
    });

    //vyplní jméno osoby , neodešle formulář
    $('.naseptavac_osoba_text').autocomplete({
        source: '/Ajax/autocompleteOsoby',
        delay: 0,
        minLength: 3,
        focus: function(event, ui) {
            return false;
        },
        select: function(event, ui) {
            $('input[id$=osoba]').val(ui.item.label);
            $('input[id$=korespondence_id]').val(ui.item.value);
            return false;
        }
    });
    //===================== VYBRAT ODDÍL ===================  
    //vyplní id oddílu a odešle formulář
    $('#frmvyhledatOddilForm-popis').focus().autocomplete({
        source: '/Ajax/autocompleteOddily',
        delay: 0,
        minLength: 3,
        focus: function(event, ui) {
            return false;
        },
        select: function(event, ui) {
            $('input[id$=popis]').val(ui.item.label);
            $('input[id$=id]').val(ui.item.value);
            $('form').submit();
            return false;
        }
    });

    //vyplní název oddílu, neodešle formulář
    $('.naseptavac_oddil_text').autocomplete({
        source: '/Ajax/autocompleteOddily',
        delay: 0,
        minLength: 3,
        focus: function(event, ui) {
            return false;
        },
        select: function(event, ui) {
            $('input[id$=oddil]').val(ui.item.label);
            $('input[id$=id_oddilu]').val(ui.item.value);
            return false;
        }
    });

    //=============== AUTOMATICKÉ ODESLÁNÍ FILTRU ====================
    $('.filtr_polozka').change(function() {
        $('.filtr_formular').submit();
    });

    //=========== EVIDENCE: VYBRAT VŠECHNY OSOBY ============================
    $('#frmseznamEvidovanychOsobForm-vse').click(function() {
        if (this.checked)
        {
            $("input[name^='osoba']").each(function() {
                $(this).attr('checked', 'checked');
            })
        }
        else
        {
            $("input[name^='osoba_']").removeAttr('checked');
        }
    })
    $("input[name^='osoba_']").click(function() {
        if (!this.checked) {
            $('#frmseznamEvidovanychOsobForm-vse').removeAttr('checked');
        }
    });

    //============ VYBRAT ROK ==============================================
    $('#frmvybratRokForm-rok').change(function() {
        $('#frm-vybratRokForm').submit();
    });

    //=========== REGISTRACE OSOB - spočítat osoby a poplatky=================
//    $('.registrace_vyber').change(function() {
//        var $pocet = $('.registrace_vyber:checked').length;
//        if ($pocet)
//        {
//            $('#pocet_zavodniku').text(' + ' + $pocet);
//            $('#registracni_poplatek').text('+ ' + ($pocet * 100));
//        }
//        else {
//            $('#pocet_zavodniku').text('');
//            $('#registracni_poplatek').text('');
//        }
//
//    });
//    $('.registrace_vyber:disabled').removeAttr('checked');
//
//    if ($('.registrace_vyber:checked').length)
//    {
//        $('#pocet_zavodniku').text(' +' + $('.registrace_vyber:checked').length);
//        $('#registracni_poplatek').text('+ ' + $('.registrace_vyber:checked').length * 100);
//    }

    //=========== VYMAZÁNÍ FORMULÁŘE PRO REGISTRACI =======================
    $('#frmregistraceZavodnikuForm-storno').click(function() {
        $(".registrace_vyber").removeAttr('checked');
        var $pocet = $('.registrace_vyber:checked').length;
        $('#pocet_zavodniku').text('');
        $('#registracni_poplatek').text('');
    });

    //================== PŘESTUP - VLOŽIT NÁZEV ODDÍLU =====================
//    $('#frmprestupForm-oddil').change(function() {
//        $('#prestup_nazev_oddilu').load('/Oddily/najitOddil/' + $("#frmprestupForm-oddil").val());
//    })

    //================= VYBÍRÁNÍ DATUMU ==================================
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
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['cs']);
    $(".datepicker").datepicker({
        showOn: "button",
        buttonImage: "/css/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "d.m.yy"
    });

    //================ FORMULÁŘ PRO NOVÝ ČLÁNEK ================================

    $("#clanek_form_nadpis").blur(function() {
        if ($(this).val() == "") {
            $(this).val('nadpis');
        }
    });
    $("#clanek_form_nadpis").focus(function() {
        if ($(this).val() == 'nadpis') {
            $(this).val('');
        }
    });
    $("#clanek_form_perex").blur(function() {
        if ($(this).val() == "") {
            $(this).val('perex');
        }
    });
    $("#clanek_form_perex").focus(function() {
        if ($(this).val() == 'perex') {
            $(this).val('');
        }
    });

    //================ AKCE ==================================================
    vyplnitMistoAkce();
    $("#frmaddAkceForm-organizator").change(function() {
        vyplnitMistoAkce();
    });

    $('#my-modal').dialog();

    $("#frmaddAkceForm-od").datepicker({
        showOn: "button",
        buttonImage: "/css/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "d.m.yy",
        onClose: function(selectedDate) {
            $("#frmaddAkceForm-do").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#frmaddAkceForm-do").datepicker({
        showOn: "button",
        buttonImage: "/css/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "d.m.yy",
        onClose: function(selectedDate) {
            $("#frmaddAkceForm-od").datepicker("option", "maxDate", selectedDate);
        }
    });
    $("#frmeditAkceForm-od").datepicker({
        showOn: "button",
        buttonImage: "/css/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "d.m.yy",
        onClose: function(selectedDate) {
            $("#frmeditAkceForm-do").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#frmeditAkceForm-do").datepicker({
        showOn: "button",
        buttonImage: "/css/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "d.m.yy",
        onClose: function(selectedDate) {
            $("#frmeditAkceForm-od").datepicker("option", "maxDate", selectedDate);
        }
    });
    $('.zobraz_popis').removeClass('hidden').css('cursor', 'pointer');
    $('.zobraz_popis').click(function($object) {
        $(this).next('.popis').slideToggle('medium');
    });

    $('form .vynulovat').focus(function(e) {
        var obsah = $(this).val();
        var vychozi_hodnota = formVynulovatVychoziHodnoty($(this).attr('id'))
        if (obsah == vychozi_hodnota)
        {
            $(this).val('');
            $(this).blur(function() {
                if ($(this).val() == '') {
                    $(this).val(obsah);
                }
            });
        }
    });
    
    $("select#sport").change(function(){
        var soutez_druzstev=$("#upravitKategoriiForm [name='soutez_druzstev']");
        soutez_druzstev.removeAttr('disabled');
//        soutez_druzstev.removeAttr('checked');
        
        var sport = $("#upravitKategoriiForm #sport option:selected").val();
        var muzi = $("#upravitKategoriiForm [name='pohlavi_m']");
        var zeny = $("#upravitKategoriiForm [name='pohlavi_z']");
        var druzstvo = $("#upravitKategoriiForm [name='druzstvo']");
        if(sport=='SGM')
            {
              muzi.prop('checked', true);
              zeny.removeAttr('checked');
              druzstvo.val(8);
            }
        if(sport=='SGZ')
            {
              zeny.prop('checked', true);
              muzi.removeAttr('checked');
              druzstvo.val(6);
            }
            if(sport=='TG')
                {
                    soutez_druzstev.attr('checked', 'checked');
                    soutez_druzstev.attr('disabled', 'disabled');
                    druzstvo.val(12);
                    $("#detail_druzstva").attr('style','');
                    $("#hostovani").attr('style','');
                    $("#druzstvo").attr('style','');
                }
    });
});

function formVynulovatVychoziHodnoty(id)
{
    var hodnoty = {
        'rocnik_od': 'neomezeno',
        'rocnik_do': 'neomezeno',
        'detail_druzstva': 'např. 2 žákyně + 1 juniorka'
    };
    return hodnoty[id];
}

function vyplnitMistoAkce()
{
    if ($("#frmaddAkceForm-organizator option:selected").val() == 0)
        var text = '';
    else
    {
        var text = $("#frmaddAkceForm-organizator option:selected").text();
    }
    $("#frmaddAkceForm-misto").val(text);
}

function is_int(value) {
    if ((parseFloat(value) == parseInt(value)) && !isNaN(value)) {
        return true;
    } else {
        return false;
    }
}


