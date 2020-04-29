<?php

class Controller
{
    public function NotImplemented(){
        require_once VIEW_PATH . 'tmpl/header.php';
        require_once VIEW_PATH . 'tmpl/menu.php';
        require_once VIEW_PATH . 'tmpl/pageHeader.php';
        echo '<center>Funkcja nie została jeszcze zaimplementowana</center>';
        require_once VIEW_PATH . 'tmpl/footer.php';
    }

    public function render($view, $data = [])
    {
        require_once VIEW_PATH . 'tmpl/header.php';
        require_once VIEW_PATH . 'tmpl/menu.php';
        require_once VIEW_PATH . 'tmpl/pageHeader.php';
        require_once VIEW_PATH . $view . '.php';
        require_once VIEW_PATH . 'tmpl/footer.php';
    }
}
