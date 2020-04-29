<?php

session_start();

//Ładowanie pliku konfiguracyjnego
require_once 'config.php';

//Ładowanie narzędzi specjalnych
require_once APP_PATH . 'tools.php';


// Tools::GetCurrentDate();


require_once CONTROLLER_PATH . 'controller.php';

$url = $_SERVER['REQUEST_URI'];

$explode_url = explode('/', $url);
$explode_url = array_slice($explode_url, 3);

if (count($explode_url) > 1) {
    $controller = $explode_url[0];
    $action = $explode_url[1];

    // echo $controller.'<br>'.$action;

    $params = array_slice($explode_url, 2);



    require_once CONTROLLER_PATH . $controller . '.php';

    $controllerName = $controller . 'Controller';

    $obj = new $controllerName();

    @call_user_func_array([$obj, $action], $params);
} else {
    require_once CONTROLLER_PATH . 'post.php';
    $obj = new postController();
    $obj->showAllPosts();
}


// require_once MODEL_PATH."user.php";

// $u = new User();
// $u->Name = "test";
// $u->Surname = "testsurname";
// $u->Email = "cos@gmail.com";
// $u->Age = "18";
// $u->Phone = "123456789";
// $u->Login = "test";
// $u->Password = Tools::PasswordHash("1234");
// $u->save();
