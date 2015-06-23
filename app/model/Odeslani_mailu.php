<?php

class OdeslaniMailu extends NObject
{
    public $debugMode;
    public $from;
    public $komu_test;
    public $reply_to;
    
    public function __construct($from, $komu_test, $reply_to) {
        $this->komu_test = $komu_test;
        $this->from = $from;
        $this->reply_to = $reply_to;
    }
    
    public function setDebugMode($debugMode)
    {
        $this->debugMode = $debugMode;
    }
    
    public function createMail()
    {
	return new GisMail($this->debugMode, $this->from, $this->komu_test, $this->reply_to);
    }  
}
