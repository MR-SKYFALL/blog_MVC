<?php

require_once MODEL_PATH . 'post.php';

class postController extends Controller
{
    public function __construct()
    {


        // return $result;


    }


    public function showAllPosts()
    {
        $post = new Post();

        $query = "SELECT p.Id,p.PostAddTime, p.Title,p.Content,p.UserId,u.Name,u.Surname,u.Email,u.Age,u.Phone,u.Login,u.Password 
                FROM posts p INNER JOIN users u ON u.Id=p.UserId 
                
                ORDER BY p.Title asc";

        $result = $post->Query($query);



        // var_dump($result);


        $this->render("posts/listViewPost", [$result, 0]); // jesli 1 to renderuje całą tresc
    }

    public function getAuthor($Id)
    {
        require_once MODEL_PATH . 'user.php';
        $user = new User();
        $user->get($Id);
        // var_dump($user);
        return $user->Name . " " . $user->Surname;
    }

    public function giveSinglePost($Id)
    {
        $post = new Post();
        $post->get($Id);
        $author = $this->getAuthor($post->UserId);
        $this->render("posts/singlePost", [$post, $author]);
    }
    public function deletePost($Id)
    {
        require_once MODEL_PATH . 'user.php';
        $post = new Post();
        $post->get($Id);
        $user = new User();
        $user->get($post->UserId);

       if($_SESSION['user'] !=NULL)
       {
            if($_SESSION['user']->Login == 'Admin')
            {
                $post->get($Id);
                // var_dump($post);
                echo "<script>alert('Admin usunol post')</script>";
                $post->delete();
                $this->showAllPosts();
            }
            else if($_SESSION['user']->Login == $user->Login)
            {
                $post->get($Id);
                // var_dump($post);
                $post->delete();
                $this->showAllPosts();
                echo "<script>alert('user usunol post')</script>";

            }
            else
            {
                echo "<script>alert('nie masz uprawnien')</script>";
            }
       }
       else
       {
        $this->showAllPosts();
       }
        
      
    }
    public function editPost($Id)
    {



        $post = new Post();

        $post->get($Id);

        


        //!--------------------------------------------


        $errors_input = array(); // tablica budowana dynamicznie przychowujaca errory które powsały na w skutek nie wpisnaia przez usera poprawych dnaychw inputy


        $misstake_info_empty_input = array(
            "title" => "Nie podano tytułu",
            "content" => "Nie podano tresci"
        );

        //"/^[A-z0-9 \!\@\#\$\%\^\&\*\(\)<>\-\=\+`~\/,.?';]{1,5000}$/" poprzednia wersja przed add  new line
        //"/^[A-z0-9 \!\@\#\$\%\^\&\*\(\)<>\-\=\+`~\/,.?\'\"\n;]{1,5000}$/" wersja z add new line char
        $misstake_info_wrong_type_of_data_RegExp = array(
            "title" => ["Podano nie prawidowy bądź za długi tytuł ", "/^[A-z0-9 \!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,50}$/"],
            "content" => ["Treść zawiera nie prawidłowe znaki bądz jest za długa", "/.*/"]
        );



        if (sizeof($_POST) != 0) {

            $new_post_data = array(
                "title" => $_POST['title'],
                "content" => $_POST['editor1']
            );







            foreach ($new_post_data as $key => $value) {

                if (!preg_match($misstake_info_wrong_type_of_data_RegExp[$key][1], $value)) {
                    $errors_input[$key] = $misstake_info_wrong_type_of_data_RegExp[$key][0];
                }

                if ($value == '') {
                    $errors_input[$key] = $misstake_info_empty_input[$key];
                }
            }


            if (sizeof($errors_input) == 0) {

                require_once MODEL_PATH . 'user.php';
                require_once MODEL_PATH . "post.php";
                $post = new Post();
                $post->get($Id);
                $user = new User();
                $user->get($post->UserId);

                if($_SESSION['user'] !=NULL)
                {
                     if($_SESSION['user']->Login == 'Admin')
                     {
                        $post = new Post();
                        $post->Id = $Id;
                        $post->UserId = $_SESSION["user"]->Id;
                        $post->Title = $new_post_data['title'];
                        $post->Content = $new_post_data['content'];
                        $post->update();
        
                        echo "<script>alert('Adminie  Post został zapisany')</script>";
        
                        require_once CONTROLLER_PATH . 'post.php';
                        $obj = new postController();
                        $obj->showAllPosts();
                     }
                     else if($_SESSION['user']->Login == $user->Login)
                     {
                        $post = new Post();
                        $post->Id = $Id;
                        $post->UserId = $_SESSION["user"]->Id;
                        $post->Title = $new_post_data['title'];
                        $post->Content = $new_post_data['content'];
                        $post->update();
        
                        echo "<script>alert('Userze Post został zapisany')</script>";
        
                        require_once CONTROLLER_PATH . 'post.php';
                        $obj = new postController();
                        $obj->showAllPosts();
         
                     }
                     else
                     {
                         echo "<script>alert('nie masz uprawnien')</script>";
                         require_once CONTROLLER_PATH . 'post.php';
                         $obj = new postController();
                         $obj->showAllPosts();
                     }
                }
                else
                {
                 $this->showAllPosts();
                }




              
               
            } else {
                $this->render('posts/editPost', [$errors_input, $new_post_data, $post]);
            }
        } else {
            $this->render('posts/editPost', ['', '', $post]);
        }
    }

    public function addNewPost()
    {




        $errors_input = array(); // tablica budowana dynamicznie przychowujaca errory które powsały na w skutek nie wpisnaia przez usera poprawych dnaychw inputy


        $misstake_info_empty_input = array(
            "title" => "Nie podano tytułu",
            "content" => "Nie podano tresci"
        );

        //"/^[A-z0-9 \!\@\#\$\%\^\&\*\(\)<>\-\=\+`~\/,.?';]{1,5000}$/" poprzednia wersja przed add  new line
        //"/^[A-z0-9 \!\@\#\$\%\^\&\*\(\)<>\-\=\+`~\/,.?\'\"\n;]{1,5000}$/" wersja z add new line char
        $misstake_info_wrong_type_of_data_RegExp = array(
            "title" => ["Podano nie prawidowy bądź za długi tytuł ", "/^[A-z0-9 \!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,50}$/"],
            "content" => ["Treść zawiera nie prawidłowe znaki bądz jest za długa", "/.*/"]
        );



        if (sizeof($_POST) != 0) {

            $new_post_data = array(
                "title" => $_POST['title'],
                "content" => $_POST['editor1']
            );







            foreach ($new_post_data as $key => $value) {

                if (!preg_match($misstake_info_wrong_type_of_data_RegExp[$key][1], $value)) {
                    $errors_input[$key] = $misstake_info_wrong_type_of_data_RegExp[$key][0];
                }

                if ($value == '') {
                    $errors_input[$key] = $misstake_info_empty_input[$key];
                }
            }


            if (sizeof($errors_input) == 0) {
                require_once MODEL_PATH . "post.php";
                $post = new Post();
                $post->UserId = $_SESSION["user"]->Id;
                $post->Title = $new_post_data['title'];
                $post->Content = $new_post_data['content'];
                $post->PostAddTime = Tools::GetCurrentDate();
        
                if(Tools::checkIsPostExist($post) == true)//! Tools::checkIsPostExist($post) == true
                {
                    echo "<script>alert('Post nie został zapisany ponieważ identyczny post został dodany przed chwilą')</script>";
                }
                else
                {
                    $post->save();
                    echo "<script>alert('Post został dodany')</script>";
                }
                

                require_once CONTROLLER_PATH . 'post.php';
                $obj = new postController();
                $obj->showAllPosts();
            } else {
                $this->render('posts/newPost', [$errors_input, $new_post_data]);
            }
        } else {
            $this->render('posts/newPost');
        }
    }



    function sort_and_search()
    {

      
       
            $search_value = $_POST['search'];
            $sort_attribute = $_POST['sort_attribute'];
            $sort_type = $_POST['sort_type'];

            $query='';

            if($sort_attribute == 'title')
            {
                if($sort_type == 'desc')
                {
                    $query = "SELECT p.Id,p.PostAddTime, p.Title,p.Content,p.UserId,u.Name,u.Surname,u.Email,u.Age,u.Phone,u.Login,u.Password 
                    FROM posts p INNER JOIN users u ON u.Id=p.UserId 
                    WHERE p.Title LIKE '%$search_value%' OR p.Content LIKE '%$search_value%' OR p.PostAddTime LIKE '%$search_value%'OR 
                    u.Name LIKE '%$search_value%' OR u.Surname LIKE '%$search_value%' 
                    ORDER BY p.Title DESC";

                }
                else if($sort_type == 'asc')
                {
                    $query = "SELECT p.Id,p.PostAddTime, p.Title,p.Content,p.UserId,u.Name,u.Surname,u.Email,u.Age,u.Phone,u.Login,u.Password 
                    FROM posts p INNER JOIN users u ON u.Id=p.UserId 
                    WHERE p.Title LIKE '%$search_value%' OR p.Content LIKE '%$search_value%' OR p.PostAddTime LIKE '%$search_value%'OR 
                    u.Name LIKE '%$search_value%' OR u.Surname LIKE '%$search_value%' 
                    ORDER BY p.Title ASC";

                }
                else
                {

                    echo 'error-title';
                }
            }
        
            else if($sort_attribute == 'date')
            {
                if($sort_type == 'desc')
                {
                    $query = "SELECT p.Id,p.PostAddTime, p.Title,p.Content,p.UserId,u.Name,u.Surname,u.Email,u.Age,u.Phone,u.Login,u.Password 
                    FROM posts p INNER JOIN users u ON u.Id=p.UserId 
                    WHERE p.Title LIKE '%$search_value%' OR p.Content LIKE '%$search_value%' OR p.PostAddTime LIKE '%$search_value%'OR 
                    u.Name LIKE '%$search_value%' OR u.Surname LIKE '%$search_value%' 
                    ORDER BY p.PostAddTime DESC";
                
                    // echo "date-desc";
                }
                else if($sort_type == 'asc')
                {
                    $query = "SELECT p.Id,p.PostAddTime, p.Title,p.Content,p.UserId,u.Name,u.Surname,u.Email,u.Age,u.Phone,u.Login,u.Password 
                    FROM posts p INNER JOIN users u ON u.Id=p.UserId 
                    WHERE p.Title LIKE '%$search_value%' OR p.Content LIKE '%$search_value%' OR p.PostAddTime LIKE '%$search_value%'OR 
                    u.Name LIKE '%$search_value%' OR u.Surname LIKE '%$search_value%' 
                    ORDER BY p.PostAddTime ASC";
                    
                    // echo "date-asc";
                }
                else
                {
                    //! error
                    echo 'error-date';
                }
            }
            else
            {
                //! error
                echo "error-default";
            }

            $post_search = new Post();
            $search_result = $post_search->Query($query);

        
        
        
            $find_result_with_background_color = "<span style='background-color:yellow;' >$search_value</span>";
            for ($i = 0; $i < sizeof($search_result); $i++) {
                foreach ($search_result[$i] as $key => $value) {
                    if ($key != 'Id') {
                        $search_result[$i]->$key = str_replace($search_value, $find_result_with_background_color, $search_result[$i]->$key);
                    }
                }
            }
            $this->render("posts/listViewPost", [$search_result, 1, $_POST]); // jesli 1 to renderuje całą tresc

       
      
        


    }




}
