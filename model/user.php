<?php

require_once(CORE_PATH . "TMPL.php");

class User extends TMPL
{

    public
        $Id = NULL,
        $Name = NULL,
        $Surname = NULL,
        $Email = NULL,
        $Age = NULL,
        $Phone = NULL,
        $Login = NULL,
        $Password = NULL,
        $RegisterTime = NULL;

    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'users';
    }

    function Login($user, $password)
    {

        $data = $this->Query("SELECT * FROM users WHERE Login = '{$user}' LIMIT 1");

        if (count($data)) {
            if (Tools::PasswordCheck($password, $data[0]->Password)) {
                return true;
            }
        }

        return false;
    }
}
