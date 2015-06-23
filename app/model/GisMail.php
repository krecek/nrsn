<?php

class GisMail extends NMail
{

    private $debugMode;
    private $prijemci;
    private $komu_test;
    private $reply_to;
    private $from;
    

    public function __construct($debugMode, $from, $komu_test, $reply_to)
    {
	$this->setFrom($from);
        $this->from = $from;
	$this->debugMode = $debugMode;
	$this->komu_test = $komu_test;
        $this->reply_to = $reply_to;
    }

    public function addTo($email, $name = NULL)
    {
	if ($this->debugMode)
	{
	    $this->prijemci[] = $email;
	    return $this;
	}
	else
	{
	    return parent::addTo($email, $name);
	}
    }

    public function addCc($email, $name = NULL)
    {
	if ($this->debugMode)
	{
	    $this->prijemci[] = $email;
	    return $this;
	}
	else
	{
	    return parent::addCc($email, $name);
	}
    }

    public function addBcc($email, $name = NULL)
    {
	if ($this->debugMode)
	{
	    $this->prijemci[] = $email;
	    return $this;
	}
	else
	{
	    return parent::addBcc($email, $name);
	}
    }
    
    public function setReplyTo($email)
    {
        $this->reply_to = $email;
        return $this;
    }

    public function send()
    {
	if ($this->debugMode)
	{
	    $subject = $this->getSubject();
	    $subject .=' (development mode) - adresy: ' . join(',', $this->prijemci);
	    $this->setSubject($subject);
	    parent::addTo($this->komu_test);
	}
        $this->addReplyTo($this->reply_to);
	$this->mailer->commandArgs = '-f '.$this->from;
	return parent::send();
    }

}
