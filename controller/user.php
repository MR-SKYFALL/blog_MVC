<?php

require_once MODEL_PATH . 'user.php';

class userController extends Controller
{

    public function showAll()
    {
        $u = new User();

        $data['users'] = $u->Query("SELECT * FROM users");
    }

    public function checkIsLoginAvaiable($checkLogin)
    {
        $user_check = new User();
        $result = $user_check->Query("SELECT * FROM users u WHERE u.Login='$checkLogin'");
        if( sizeof($result) == 0 )
        {
            return true;
        }
        else
        {
            if($checkLogin == $_SESSION['user']->Login)
            {
                return true;
            }
            else
            {
                return false;
            }
            
        }
    }

    public function checkIsEmailAvaiable($checkEmail)
    {
        $user_check = new User();
        $result = $user_check->Query("SELECT * FROM users u WHERE u.Email='$checkEmail'");
        if( sizeof($result) == 0 )
        {
            return true;
        }
        else
        {
            if($checkEmail == $_SESSION['user']->Email)
            {
                return true;
            }
            else
            {
                return false;
            }
           
        }
    }

    public function show($id)
    {
        $u = new User();
        $u->get($id);

        $data['user'] = $u;

        $this->render('userView', $data);
    }

    public function login()
    {

        
        if (isset($_POST['uname1']) && isset($_POST['pwd1'])) {

            $pass = $_POST['pwd1'];
            $login = $_POST['uname1'];

           

            $u = new User();

            if ($u->Login($_POST['uname1'], $_POST['pwd1'])) {

                if($_POST['remember_me']=='on')
                {
                    $js = "<script>
                    localStorage.setItem('password', '$pass');
                    localStorage.setItem('login', '$login');
                    </script>";
                    echo $js;
    
                }
                else
                {
                    $js = "<script>
                    localStorage.setItem('password', '');
                    localStorage.setItem('login', '');
                    </script>";
                    echo $js;
                }

                $data['siteTitle'] = "";
                $data['siteHeading'] = "Logowanie";
                $data['siteMeta'] = "";
                
                $data['user'] = $u->Query("SELECT * FROM users WHERE Login = '" . $_POST['uname1'] . "' LIMIT 1")[0];
                
                $_SESSION["user"] = $data['user'];
                $this->render('user/userLoginConfirmView', $data);
                return;
            }
            else //! obsługa blednego hasla
            {
                $this->render('user/userLoginView', ['Podano nieprawidłowe dane logowania',$_POST]);
            } 
        }

        
        $this->render('user/userLoginView');
    }
    
    public function logout() {

        session_unset();

       
        $this->render('user/userLoginView');
    }

    

    public function register()
    {
        //! setup 

        //RegExp
        /*
        imie - /^[a-z]{1,15}$/
        nazwisko - /^[a-z]{1,15}[ ][a-z]{1,15}$|^[a-z]{1,15}$/
        email - /^[a-zA-Z0-9_\.]{1,40}[@][a-zA-Z0-9_\.]{1,40}$/
        age - /^[0-9]{1,3}$/
        phone - /^[0-9]{9}$/
        login - /^[A-z0-9]{1,15}$/
        haslo - /^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/
        */
    

        $errors_input = array(); // tablica budowana dynamicznie przychowujaca errory które powsały na w skutek nie wpisnaia przez usera poprawych dnaychw inputy

        $misstake_info_empty_input = array(
            "name" => "Nie podano imienia",
            "surname" => "Nie podano nazwiska",
            "email" => "Nie podano emial",
            "age" => "Podaj wiek",
            "phone" => "Podaj telefon",
            "login" => "Podaj login",
            "pass1" => "Podaj haslo",
            "pass2" => "Powtórz hasło"
            );
            // /^[a-zA-Z0-9_\.]{1,40}[@][a-zA-Z0-9_]{1}[a-zA-Z0-9_\.]{1,40}$/ last emial
            $misstake_info_wrong_type_of_data_RegExp = array(
                "name" => ["Podano nie poprawe imie","/^[A-z0-9]{1,15}$/"],
                "surname" => ["Podano nie poprawe nazwisko","/^[A-z]{1,15}[ ][A-z]{1,15}$|^[A-z]{1,15}$/"],
                "email" => ["Podano nie poprawny email ","/.*/"],
                "age" => ["Podano nie poprawy wiek","/^[0-9]{1,3}$/"],
                "phone" => ["Podano nie poprawy nr telefonu ","/^[0-9]{9}$/"],
                "login" => ["Podano nie poprawy login","/^[A-z0-9]{1,15}$/"],
                "pass1" => ["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
                "pass2" => ["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
                "pass_not_the_same" => ["Hasła różnią się od siebie",null]
                );

                $login_exist_info = "Podany Login juz jest urzywany";
                $email_exist_info = "Podany Email juz jest urzywany";
                
                

        //! end of setup

            $form_data_array = array(
                "name" => $_POST['name'] ,
                "surname" => $_POST['surname'],
                "email" => $_POST['email'],
                "age" => $_POST['age'],
                "phone" => $_POST['phone'],
                "login" => $_POST['login'],
                "pass1" => $_POST['pass1'],
                "pass2" => $_POST['pass2']
                );

               
        
                
                if(sizeof($_POST)!=0)
                {
                 

                    foreach($form_data_array as $key => $value)
                    {
    
                        if(!preg_match($misstake_info_wrong_type_of_data_RegExp[$key][1],$value))
                        {
                            $errors_input[$key] = $misstake_info_wrong_type_of_data_RegExp[$key][0];
                        }
    
                        if($value == '') 
                        {
                            $errors_input[$key] = $misstake_info_empty_input[$key];
                        }
                    }

                    if (!filter_var($form_data_array['email'], FILTER_VALIDATE_EMAIL)) {
                        $errors_input['email'] = $misstake_info_wrong_type_of_data_RegExp['email'][0];
                      }

                    if(!$this->checkIsLoginAvaiable($form_data_array['login']))
                    {
                        $errors_input['login'] = $login_exist_info;
                    }

                    if(!$this->checkIsEmailAvaiable($form_data_array['email']))
                    {
                        $errors_input['email'] = $email_exist_info;
                    }
    
                    if($form_data_array['pass1'] != $form_data_array['pass2'])
                    {
                        
                        $errors_input['pass1'] = $misstake_info_wrong_type_of_data_RegExp['pass_not_the_same'][0];
                        $errors_input['pass2'] = $misstake_info_wrong_type_of_data_RegExp['pass_not_the_same'][0];
                        // $this->render("user/userRegisterView",[$errors_input,$form_data_array]);
                           
                    }
                  

                    if(sizeof($errors_input) == 0)
                    {
                        require_once MODEL_PATH."user.php";

                        $u = new User();
                        $u->Name = $form_data_array['name'];
                        $u->Surname = $form_data_array['surname'];
                        $u->Email = $form_data_array['email'];
                        $u->Age = $form_data_array['age'];
                        $u->Phone = $form_data_array['phone'];
                        $u->Login = $form_data_array['login'];
                        $u->Password = Tools::PasswordHash($form_data_array['pass1']); 

                        $u->RegisterTime = Tools::GetCurrentDate();
                        $u->save();

                        $this->render("user/userCorrectRegisterView");
                    }
                    else
                    {
                        $this->render("user/userRegisterView",[$errors_input,$form_data_array]);
                    }

                   
                }
                else
                {
                    $this->render("user/userRegisterView");
                }

    }

  public function usersManagement()
  {
    $user = new User();
    $allUsersList = $user->Query("SELECT * FROM users;");


    $this->render("user/userManagementListView",$allUsersList);
  }
  public function singleUserInfo($clickUserId)
  {
    $user = new User();
    $user->get($clickUserId);
    $userId = $user->Id;
    $quantity_array = $user->Query("SELECT COUNT(*) as quantity FROM posts p WHERE p.UserId =$userId;");
    $data['postQuantity'] = $quantity_array[0]->quantity;

    require_once MODEL_PATH . 'post.php';
    $tmpPost = new Post();
    $timeLastPost = $tmpPost->Query("SELECT Max(p.PostAddTime) as last_post FROM posts p WHERE p.UserId=$userId;");
    $data['timeLastPost'] = $timeLastPost[0]->last_post;

    $this->render("user/singleUserManagement",[$user,$data]);
  }
  public function deleteSingleUser($Id)
  {
        
        $user = new User();
        $user->get($Id);

        if($user->Login=='Admin')
        {
           
            $this->render("user/singleUserManagement",[$user]);
            echo "<script> setTimeout(function(){ alert('Urzytkownika Admin nie można usunąć'); }, 100); </script>";
        }
        else
        {
            $user->delete();
            echo "<script> setTimeout(function(){ alert('Urzytkownik został poprawnie usuniety'); }, 100); </script>";
            $this->usersManagement();
        }

       
  }
  public function managementSingleUserData()
  {
      //! setup 

        //RegExp
        /*
        imie - /^[a-z]{1,15}$/
        nazwisko - /^[a-z]{1,15}[ ][a-z]{1,15}$|^[a-z]{1,15}$/
        email - /^[a-zA-Z0-9_\.]{1,40}[@][a-zA-Z0-9_\.]{1,40}$/
        age - /^[0-9]{1,3}$/
        phone - /^[0-9]{9}$/
        login - /^[A-z0-9]{1,15}$/
        haslo - /^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/
        */
    

        $errors_input = array(); // tablica budowana dynamicznie przychowujaca errory które powsały na w skutek nie wpisnaia przez usera poprawych dnaychw inputy

        $misstake_info_empty_input = array(
            "name" => "Nie podano imienia",
            "surname" => "Nie podano nazwiska",
            "email" => "Nie podano emial",
            "age" => "Podaj wiek",
            "phone" => "Podaj telefon",
            "login" => "Podaj login",
            "pass1" => "Podaj haslo",
            "pass2" => "Powtórz hasło"
            );
            // /^[a-zA-Z0-9_\.]{1,40}[@][a-zA-Z0-9_]{1}[a-zA-Z0-9_\.]{1,40}$/ last emial
            $misstake_info_wrong_type_of_data_RegExp = array(
                "name" => ["Podano nie poprawe imie","/^[A-z]{1,15}$/"],
                "surname" => ["Podano nie poprawe nazwisko","/^[A-z]{1,15}[ ][A-z]{1,15}$|^[A-z]{1,15}$/"],
                "email" => ["Podano nie poprawny email ","/.*/"],
                "age" => ["Podano nie poprawy wiek","/^[0-9]{1,3}$/"],
                "phone" => ["Podano nie poprawy nr telefonu ","/^[0-9]{9}$/"],
                "login" => ["Podano nie poprawy login","/^[A-z0-9]{1,15}$/"],
                "pass1" => ["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
                "pass2" => ["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
                "pass_not_the_same" => ["Hasła różnią się od siebie",null]
                );

               $AdminCantChangeLoginInfo = "Admin nie może zmienić loginu";
                
               $login_exist_info = "Podany Login juz jest urzywany";
               $email_exist_info = "Podany Email juz jest urzywany";

        //! end of setup

                
        
               
        
                
                if(sizeof($_POST)!=0)
                {

                    $form_data_array = array(
                        "name" => $_POST['name'] ,
                        "surname" => $_POST['surname'],
                        "email" => $_POST['email'],
                        "age" => $_POST['age'],
                        "phone" => $_POST['phone'],
                        "login" => $_POST['login']
                    
                        );

                    
                    foreach($form_data_array as $key => $value)
                    {
    
                        if(!preg_match($misstake_info_wrong_type_of_data_RegExp[$key][1],$value))
                        {
                            $errors_input[$key] = $misstake_info_wrong_type_of_data_RegExp[$key][0];
                        }
    
                        if($value == '') 
                        {
                            $errors_input[$key] = $misstake_info_empty_input[$key];
                        }
                    }

                    if (!filter_var($form_data_array['email'], FILTER_VALIDATE_EMAIL)) {
                        $errors_input['email'] = $misstake_info_wrong_type_of_data_RegExp['email'][0];
                      }

                   //! check is admin

                   if($this->checkIsAdmin($_SESSION['user']->Id))
                   {
                       $tmpUser = new User();
                       $tmpUser->get($_SESSION['user']->Id);
                       if($tmpUser->Login != $form_data_array['login'])
                       {
                           $errors_input['login'] = $AdminCantChangeLoginInfo;
                       }
                   }

                   if(!$this->checkIsLoginAvaiable($form_data_array['login']))
                   {
                       $errors_input['login'] = $login_exist_info;
                   }

                   if(!$this->checkIsEmailAvaiable($form_data_array['email']) )
                   {
                       $errors_input['email'] = $email_exist_info;
                   }
    
                  

                    if(sizeof($errors_input) == 0)
                    {
                        require_once MODEL_PATH."user.php";

                        $u = new User();
                        $u->Id = $_SESSION['user']->Id;
                        $u->Name = $form_data_array['name'];
                        $u->Surname = $form_data_array['surname'];
                        $u->Email = $form_data_array['email'];
                        $u->Age = $form_data_array['age'];
                        $u->Phone = $form_data_array['phone'];
                        $u->Login = $form_data_array['login'];
                        // $u->Password = $_SESSION['user']->Password; //! mozliwa usterka
                        //$u->Password = Tools::PasswordHash($form_data_array['pass1']); 
                 
                        $u->update();
                        $this->user_actualise_session_data();
                     
                
                        echo "<script>alert('Dane zostały zapisane')</script>";
                        require_once CONTROLLER_PATH . 'post.php';
                        $obj = new postController();
                        $obj->showAllPosts();
                        
                    }
                    else
                    {
                        $this->render("user/singleUserProfileEdit",[$errors_input,$form_data_array]);
                    }

                   
                }
                else
                {
                    $user = new User();
                    $user->get($_SESSION['user']->Id);

                    //var_dump($user);

                    $form_data_array = array(
                        "name" => $user->Name,
                        "surname" => $user->Surname,
                        "email" => $user->Email,
                        "age" => $user->Age,
                        "phone" => $user->Phone,
                        "login" => $user->Login,
                        
                        );

                    $this->render("user/singleUserProfileEdit",[$errors_input,$form_data_array]);
                }

  }

  public function checkIsAdmin($Id)
  {
    $user = new User();
    $user->get($Id);
    if($user->Login=='Admin')
    {
        return true;
    }
    else
    {
        return false;
    }
  }

  public function restartPassword()
  {
     

      $errors_input = array(); // tablica budowana dynamicznie przychowujaca errory które powsały na w skutek nie wpisnaia przez usera poprawych dnaychw inputy


      $misstake_info_empty_input = array(
        "pass" => "Podaj stare hasło",
        "newPass1" => "Podaj nowe haslo",
        "newPass2" => "Powtórz nowe hasło"
        );

        $misstake_info_wrong_type_of_data_RegExp = array(
            "pass" =>["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
            "newPass1" => ["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
            "newPass2" => ["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
            "pass_not_the_same" => ["Hasła różnią się od siebie",null]
            );

            $old_pass_is_not_correct_info = "Stare hasło nie jest poprawne";



            if(sizeof($_POST)!=0)
            {

                $form_data_array = array(
                   
                    "pass" => $_POST['pass'],
                    "newPass1" =>  $_POST['newPass1'],
                    "newPass2" => $_POST['newPass2'],
                
                    );

                
                foreach($form_data_array as $key => $value)
                {

                    if(!preg_match($misstake_info_wrong_type_of_data_RegExp[$key][1],$value))
                    {
                        $errors_input[$key] = $misstake_info_wrong_type_of_data_RegExp[$key][0];
                    }

                    if($value == '') 
                    {
                        $errors_input[$key] = $misstake_info_empty_input[$key];
                    }
                }

                
              
                if($form_data_array['newPass1'] != $form_data_array['newPass2'])
                {
                    
                    $errors_input['newPass1'] = $misstake_info_wrong_type_of_data_RegExp['pass_not_the_same'][0];
                    $errors_input['newPass2'] = $misstake_info_wrong_type_of_data_RegExp['pass_not_the_same'][0];
                    // $this->render("user/userRegisterView",[$errors_input,$form_data_array]);
                       
                }
              
                

                if(!Tools::PasswordCheck($form_data_array['pass'],$_SESSION['user']->Password))
                {
                    $errors_input['pass'] = $old_pass_is_not_correct_info;
                }


              

                if(sizeof($errors_input) == 0)
                {
                    require_once MODEL_PATH."user.php";

                    $u = new User();
                    $u->Id = $_SESSION['user']->Id;
                  
                    $u->Password = Tools::PasswordHash($form_data_array['newPass1']); 
                    $u->update();
                    $this->user_actualise_session_data();
                    echo "<script>alert('Dane zostały zapisane')</script>";
                    require_once CONTROLLER_PATH . 'post.php';
                    $obj = new postController();
                    $obj->showAllPosts();
                    
                }
                else
                {
                    $this->render("user/UserChangePassword",[$errors_input,$form_data_array]);
                }

               
            }
            else
            {
                $user = new User();
                $user->get($_SESSION['user']->Id);

                //var_dump($user);

                $form_data_array = array(
                    "name" => $user->Name,
                    "surname" => $user->Surname,
                    "email" => $user->Email,
                    "age" => $user->Age,
                    "phone" => $user->Phone,
                    "login" => $user->Login,
                    
                    );

                $this->render("user/UserChangePassword",[$errors_input,$form_data_array]);
            }

  }
  function user_actualise_session_data()
  {
    require_once MODEL_PATH."user.php";
    $u = new User();
    $Id = $_SESSION['user']->Id;
    $data['user'] = $u->Query("SELECT * FROM users WHERE Id = '".$Id."' LIMIT 1")[0];

    $_SESSION["user"] = $data['user'];
  }
 

}
