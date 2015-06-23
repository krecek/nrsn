<?php

class Rubrika extends NObject
{

    private $id;
    private $nazev;
//    private $popis;
    private $rodic;
    private $url;

    public function __construct($id = null)
    {
        if ($id)
        {
            $this->id = $id;
        }
    }

    public function setUdaje($udaje)
    {
        if (isset($udaje['nazev']))
        {
            $this->setNazev($udaje['nazev']);
            if (isset($udaje['url'])) $this->setUrl($udaje['url']);
            else $this->setUrl();
        }

//        if(isset($udaje['popis'])) $this->setPopis($udaje['popis']);
        if (isset($udaje['rodic'])) $this->setRodic($udaje['rodic']);
    }

    public function getUdaje()
    {
        $return = array();
        if (isset($this->nazev)) $return['nazev'] = $this->nazev;
//        if (isset($this->popis)) $return['popis'] = $this->popis;
        if (isset($this->rodic)) $return['rodic'] = $this->rodic;
        if (isset($this->url)) $return['url'] = $this->url;
        return $return;
    }

    public function setNazev($nazev)
    {
        $this->nazev = $nazev;
    }

//    public function setPopis($popis)
//    {
//        $this->popis = $popis;
//    }

    public function setRodic($rodic)
    {
        $this->rodic = $rodic;
    }

    public function setUrl($url = null)
    {
        if (!$url) $url = $this->nazev;
        $this->url = NStrings::webalize($url);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNazev()
    {
        return $this->nazev;
    }

//    public function getPopis()
//    {
//        return $this->popis;
//    }

    public function getRodic()
    {
        return $this->rodic;
    }

}

?>
