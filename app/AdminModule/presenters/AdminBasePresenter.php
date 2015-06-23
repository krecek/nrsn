<?php

class AdminBasePresenter extends BasePresenter
{

    /** @var Logger */
    public $logger;

    protected function startup()
    {
        parent::startup();
        $httpRequest = $this->context->getService('httpRequest');
        $url = $httpRequest->getUrl()->host;
        $this->logger = $this->getService('logger');
        $this->logger->setId_uzivatele('');
    }

    public function logg($text)
    {
        $this->logger->logg($text);
    }

}

?>