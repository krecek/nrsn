<?php


class LoginForm extends NAppForm
{

    public function __construct() {
        parent::__construct();
        $this->addText('username', 'Uživatelské jméno:')
                ->setRequired('Vyplňte uživatelské jméno.')
                ->setAttribute('class', 'focus');
        $this->addPassword('password', 'Heslo:')
                ->setRequired('Vyplňte heslo.');
        $this->addSubmit('send', 'Přihlásit');
    }

}

?>
