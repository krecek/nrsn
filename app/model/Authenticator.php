<?php

class Authenticator extends NObject implements IAuthenticator
{

    /** @var OsobyRepository */
    private $repository;

    public function __construct(OsobyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 
     * @param array $credentials
     * @return \NIdentity
     * @throws NAuthenticationException
     */
    public function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        $row = $this->repository->findByUsername($username);

        if (!$row)
        {
            throw new NAuthenticationException("Neplatné jméno nebo heslo.");
        }

        if ($row->password !== self::calculateHash($password, $row->password))
        {
            throw new NAuthenticationException('Neplatné jméno nebo heslo', self::INVALID_CREDENTIAL);
        }
        unset($row->password);
        return new NIdentity($row->id, NULL, $row->toArray());
    }
    /**
     * 
     * @return str
     */
    public static function generovatHeslo()
    {
        $délka = 8;
        $znaky = 'abcdefghijkmnopqrstuvwxABCDEFGHIJKLMNPQRSTUVWX23456789';
        $heslo='';
        for ($i = 0; $i < $délka; $i++)
        {
            $heslo .= substr($znaky, mt_rand(1, strlen($znaky)) - 1, 1);
        }
        return $heslo;
    }

     /**
     * Computes salted password hash.
     * @param  string
     * @return string
     */
    public static function calculateHash($password, $salt = NULL)
    {
        if ($password === NStrings::upper($password))
        { // zapnutý CAPS LOCK
            $password = NStrings::lower($password);
        }
        return md5($password);
    }

}

