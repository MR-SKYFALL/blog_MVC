<?php

require_once(CORE_PATH . "TMPL.php");

class Post extends TMPL {

    public
            $Id = NULL,
            $UserId = NULL,
            $Title = NULL,
            $Content = NULL,
            $PostAddTime = NULL;
 
           

    public function __construct() {
        parent::__construct();

        $this->table_name = 'posts';
    }
    
}
