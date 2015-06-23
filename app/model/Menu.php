<?php

class Menu extends NObject
{
    private $polozky;
    private $rubrika;
    
    public function __construct($id_rubriky)
    {
        $this->rubrika = $id_rubriky;
    }

    public function setPolozky($polozky)
    {
        foreach($polozky as $key=>$polozka)
        {
            $polozky[$key]['rubrika']=$this->rubrika;
        }
        $this->polozky = $polozky;
    }

    public function getPolozky()
    {
        return $this->polozky;
    }
    public function getRubrika()
    {
        return $this->rubrika;
    }



}

?>
