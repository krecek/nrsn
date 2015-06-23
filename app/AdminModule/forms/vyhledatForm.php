<?php
class VyhledatForm extends NAppForm
{
 /**
  * 
  * @param str Text před vyhledávacím polem
  * @param str třída vyhledávacího pole
  */
    public function __construct($text, $class=null, $focus=TRUE) {
        parent::__construct();
        $focus=$focus?'focus':'';
        $this->addText('popis', $text)->setAttribute('class', $focus.' '.$class);
        $this->addHidden('id', '');
        $this->addSubmit('send', 'Vyhledat');
        $this->getElementPrototype()->addAttributes(array('class'=>'vyhledat_form'));
    }

}
?>
