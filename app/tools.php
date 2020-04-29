<?php

class Tools {

    //Metoda wyświetla dane obiektu w postaci preformatowanej
    public static function showObj($data) {
        echo '<pre>';
        @print_r($data);
        echo '</pre>';
    }

    //Metoda haszująca dowolny tekst
    public static function PasswordHash($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost'=>10]);
    }

    //Metoda sprawdzająca czy hasła są takie same
    public static function PasswordCheck($password, $hash) {
        return password_verify($password, $hash);
    }

    public static function GetCurrentDate()
    {
        // date("H:i", strtotime("1:30 PM"));
        
        // echo $date.'<br>';
        $time = date('Y-m-d H:i:s ', time());
       return $time;
    }
    public static function checkIsPostExist($newPost)
    {
        require_once MODEL_PATH . 'post.php';
        $post = new post();
        $query = "SELECT p.Title, p.Content, p.UserId FROM posts p 
        WHERE p.Title='$newPost->Title' AND p.Content='$newPost->Content' AND p.UserId=$newPost->UserId ;";

        $result = $post->Query($query);

        if($result == false)
        {
            return false;
        }
        else
        {
            return true;
        }



    }
}
