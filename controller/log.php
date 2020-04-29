<?php
require_once MODEL_PATH . 'log.php';
class logController extends Controller
{
    public function __construct()
    {


        // return $result;


    }

    public function showAllLogs()
    {
        
        
        
        if(sizeof($_POST)!=0)
        {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
           
            $log = new Log();
            $data = $log->Query("SELECT * FROM logs l WHERE l.Time BETWEEN '$date1' AND '$date2';");
            $this->render('logs/logsView',[$data,$_POST]);
        }
        else
        {
            $this->render('logs/logsView');
        }
    }

}
?>




