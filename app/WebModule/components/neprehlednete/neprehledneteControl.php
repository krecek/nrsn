<?php
class NeprehledneteControl extends BaseControl
{

    private $clanky;

    public function __construct($clanky)
    {
        parent::__construct();
        $this->clanky = $clanky;
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/neprehlednete.latte');
        $this->template->clanky = $this->clanky;
        $this->template->render();
    }

}
?>
