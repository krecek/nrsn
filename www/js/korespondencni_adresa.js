$(document).ready(function() {
    var typ = $('#frmeditOddilForm-korespondence_typ').val();
    if (typ)
    {
        nastav_zobrazeni(typ);
        $('#frmeditOddilForm-korespondence_typ').change(function() {
            var nova_hodnota = $('#frmeditOddilForm-korespondence_typ').val();
            nastav_zobrazeni(nova_hodnota);
        });
    }

    //============= nový oddíl
    var typ2 = $('#frmaddOddilForm-korespondence_typ').val();
    if (typ2)
    {
        nastav_zobrazeni(typ2);
        $('#frmaddOddilForm-korespondence_typ').change(function() {
            var nova_hodnota = $('#frmaddOddilForm-korespondence_typ').val();
            nastav_zobrazeni(nova_hodnota);
        });
    }
    
    //==================
    function nastav_zobrazeni(typ)
    {
        if (typ == 'jine')
        {
            $('tr:has(.korespondence_osoba)').addClass('hidden');
            $('tr:has(.korespondence_jine)').removeClass('hidden');
        }
        else if (typ == 'osoba')
        {
            $('tr:has(.korespondence_jine)').addClass('hidden');
            $('tr:has(.korespondence_osoba)').removeClass('hidden');
        }
        else {
            $('tr:has(.korespondence_osoba)').addClass('hidden');
            $('tr:has(.korespondence_jine)').addClass('hidden');
        }
    }
});



