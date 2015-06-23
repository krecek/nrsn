<?php

abstract class Repository extends NObject
{

    /**
     *
     * @var NConnection 
     */
    public $connection;

    public function __construct(NConnection $db)
    {
        $this->connection = $db;
    }

    /**
     * 
     * @return NTableSelection
     */
    public function getTable()
    {
// název tabulky odvodit z názvu třídy
        preg_match('#(\w+)Repository$#', get_class($this), $m);
        $string = $m[1];
        $string[0] = strtolower($string[0]);
        return $this->connection->table($string);
    }

    /**
     * 
     * @return NTableSelection
     */
    public function findAll()
    {
        return $this->getTable();
    }

    /**
     * 
     * @return NTableSelection
     */
    public function findBy($by)
    {
        return $this->getTable()->where($by);
    }

    public function findById($id)
    {
        return $this->getTable()->where('id', $id)->fetch();
    }
    
    protected function generovatId($len)
    {
        if ($len == 4)
        {
            $min = 1000;
            $max = 9999;
        };
        if ($len == 5)
        {
            $min = 10000;
            $max = 99999;
        };
        if ($len == 6)
        {
            $min = 100000;
            $max = 999999;
        };
        if ($len == 7)
        {
            $min = 1000000;
            $max = 9999999;
        };
        if ($len == 8)
        {
            $min = 10000000;
            $max = 99999999;
        };
       
            return mt_rand($min, $max);
        
    }

}

?>
