<?php

class Logger extends NObject {

    private $soubor;
    private $id_uzivatele = null;

    public function __construct($soubor) {
        $this->soubor = $soubor;
    }

    public function setId_uzivatele($id_uzivatele) {
        $this->id_uzivatele = $id_uzivatele;
    }

    public function logg($text, $id_uzivatele = null) {
        $fp = FOpen($this->soubor, 'a');

        if ($id_uzivatele) {
            $osoba = $id_uzivatele;
        } else {
            $osoba = $this->id_uzivatele;
        }
        if (!$osoba) {
            $osoba = '000000';
        }
        FPutS($fp, Date("Y-m-d H:i:s") . " gis: $osoba " . NStrings::toAscii($text) . "\n");
        FClose($fp);
    }

}

?>
