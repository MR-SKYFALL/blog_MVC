<?php
require_once MODEL_PATH . 'forgotPass.php';
class forgotPassController extends Controller
{
    public function __construct()
    {


    }
    public function inputEmail()
    {
        $this->render('resetPass/getEmail');
    }
    public function restorePass()
    {
        $email = $_POST['email'];
        // echo $email;

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        require_once MODEL_PATH . 'user.php';
        $user = new User();
        $result = $user->Query("SELECT * FROM users u WHERE u.Email='$email';");
        
        if(sizeof($result)!=0)
        {
             $expTime = date('Y-m-d H:i:s ', time()+900); //! 900 - 15 min
             

             $key = md5(2418*2+$email);
             $addKey = substr(md5(uniqid(rand(),1)),3,10);
             $key = $key . $addKey;
            //echo $key.'<br>'.$expTime;
            
            $passReset = new ForgotPass();
            $passReset->Email = $email;
            $passReset->Token = $key;
            $passReset->ExpTime = $expTime;
            $passReset->UserId = $result[0]->Id;

            $passReset->save();


          
            $link = SITE_PATH.'forgotPass/setNewPass/'.$key;
           
            
          
            $this->render('resetPass/checkMailInfo',$link);

            
        }
        else
        {
            $info_email_not_exist = "podany email nie istnieje w bazie";
            $this->render('resetPass/getEmail', [$info_email_not_exist]); 
        }

        
    }
    function setNewPass($key)
    {
        
        require_once MODEL_PATH."user.php";
       
          
        $errors_input = array(); // tablica budowana dynamicznie przychowujaca errory które powsały na w skutek nie wpisnaia przez usera poprawych dnaychw inputy


        $misstake_info_empty_input = array(
        
            "newPass1" => "Podaj nowe haslo",
            "newPass2" => "Powtórz nowe hasło"
            );
    
        $misstake_info_wrong_type_of_data_RegExp = array(
            "newPass1" => ["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
            "newPass2" => ["Hasła są za długie","/^[A-z0-9\!\@\#\$\%\^\&\*\(\)\-\=\+`~\/,.?';]{1,30}$/"],
            "pass_not_the_same" => ["Hasła różnią się od siebie",null],
            
            );

            $exp_of_link = "Czas na zmiane hasła minoł";
      
      
      
        if(sizeof($_POST)!=0)
        {

            $form_data_array = array(
                
                "newPass1" =>  $_POST['newPass1'],
                "newPass2" => $_POST['newPass2'],
                "key" => $_POST['key'],
            
                );

            
            foreach($form_data_array as $key => $value)
            {

                if($misstake_info_wrong_type_of_data_RegExp['key']!=NULL)
                {
                    if(!preg_match($misstake_info_wrong_type_of_data_RegExp[$key][1],$value))
                    {
                        $errors_input[$key] = $misstake_info_wrong_type_of_data_RegExp[$key][0];
                    }
                }
                

                if($value == '') 
                {
                    $errors_input[$key] = $misstake_info_empty_input[$key];
                }
            }

            
        
            if($form_data_array['newPass1'] != $form_data_array['newPass2'])
            {
                
                
                $errors_input['newPass2'] = $misstake_info_wrong_type_of_data_RegExp['pass_not_the_same'][0];
                // $this->render("user/userRegisterView",[$errors_input,$form_data_array]);
                    
            }
            // echo $form_data_array['key'].'124';
            if(!$this->check_is_date_expire_of_link($form_data_array['key']))
            {
                $errors_input['newPass2'] = $exp_of_link;
            }

            // var_dump($errors_input);

            if(sizeof($errors_input) == 0)//!
            {
                $userId =$this->get_user_id_via_key($form_data_array['key']);
                $u = new User();
                $u->get($userId);
                $u->Password = Tools::PasswordHash($form_data_array['newPass1']);
                $u->Id = $userId;
                $u->update();
                
                $this->render("resetPass/passHasBeenChanged");
                
                
            }
            else
            {
                $this->render("resetPass/setNewPassword",[$errors_input,$form_data_array, $form_data_array['key']]);
            }

        }
        else
        {
            
            $this->render("resetPass/setNewPassword",[$errors_input,$form_data_array,$key]);
        }

        
           
    }

    function check_is_date_expire_of_link($key)
    {
        $pass = new ForgotPass();
        $result = $pass->Query("SELECT * FROM reset_pass rp WHERE rp.Token='$key';");
        if(sizeof($result)==1)
        {
           
            if($result[0]->ExpTime>Tools::GetCurrentDate())
            {
                // echo "czas ok";
                return 1;
            }
            else
            {
                // echo "czas minoł";
                return 0;
            }
            return 1;
        }
        else
        {       
            return 0;
        }
      
    }
    function get_user_id_via_key($key)
    {
        $pass = new ForgotPass();
        $result = $pass->Query("SELECT * FROM reset_pass rp WHERE rp.Token='$key';");
        if(sizeof($result)==1)
        {
            // echo "id to:";
            return $result[0]->UserId;
           
        }
        else
        {       
            // echo "error";
            return 0;
        }
    }
    
}
?>




