<?php

class GisEntity
{

    public $id;
    protected $udaje_k_vraceni = array();

    public function __construct($id = null)
    {
        if ($id) $this->id = $id;
    }

    public function setUdaje($udaje)
    {
        foreach ($udaje as $key => $udaj)
        {
            $method_name = 'set' . NStrings::firstUpper($key);
            if (method_exists($this, $method_name)) call_user_func_array(array($this, $method_name), array($udaj));
        }
    }

    public function getUdaje()
    {
        $return = array();
        foreach ($this->udaje_k_vraceni as $key)
        {
            if (isset($this->$key)) $return[$key] = $this->$key;
        }
        return $return;
    }

    protected function bool2Str($str)
    {
        if ($str === TRUE || $str == 'A') return 'A';
        else return 'N';
    }

}

?>
