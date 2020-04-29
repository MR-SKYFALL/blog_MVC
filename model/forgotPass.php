<?php

require_once(CORE_PATH . "TMPL.php");

class ForgotPass extends TMPL
{
    public 
    $Id = NULL,
    $Email = NULL,
    $UserId = NULL,
    $Token = NULL,
    $ExpTime = NULL;
    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'reset_pass';
    }
    
}
