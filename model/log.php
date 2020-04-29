<?php

require_once(CORE_PATH . "TMPL.php");

class Log extends TMPL
{
    const
        INSERT = 'I',
        DELETE = 'D',
        UPDATE = 'U';

    public
        $Id = NULL,
        $Type = NULL,
        $UserId = NULL,
        $ObjectName = NULL,
        $Time = NULL,
        $Comment = NULL;


    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'Logs';
    }

    static function Write($ObjectName, $Type, $UserId, $Info)
    {
        if($ObjectName == 'Log')
            return;

        $tmpl = new TMPL();

        switch ($Type) {
            case self::DELETE:
                $Comment = "Usunieto ";
                break;

            case self::INSERT:
                $Comment = "Utworzono ";
                break;

            case self::UPDATE:
                $Comment = "Zaktualizowano ";
                break;

            default:
                break;
        }

        $Comment .= " obiekt " . $ObjectName.' o Id: '.$Info.'.';

        $query2 = "INSERT INTO logs(Type, UserId, ObjectName , Time, Comment ) VALUES( '$Type', '$UserId', '$ObjectName', '" . date("Y-m-d H:i:s") . "', '$Comment');";

        $tmpl->Query($query2);
    }
}
