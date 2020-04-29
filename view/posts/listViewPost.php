<?php

$action = SITE_PATH . 'post/sort_and_search';



if(!isset($data[2]['search']))
{
    $data[2]['search'] = '';
}

if(!isset($data[2]['sort_attribute']))
{
    $data[2]['sort_attribute'] = 'title';
}
if(!isset($data[2]['sort_type']))
{
    $data[2]['sort_type'] = 'asc';
}

?>



<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                
                <!----------------------------------------------------  -->

                <div class="col-md-6 mx-auto">
                    <!-- form card login -->

                    <div class="register_header">
                        <h3 class="header-1"> Wyszukiwanie</h3>
                    </div>

                    <div class="card rounded-0">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="readAllPost" novalidate="" action="<?php echo $action ?>" method="POST">


                                <div class="row mx-0 my-3">
                                    <label for="search">Wyszukaj</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php  echo $data[2]['search'] ?>" name="search" id="search" required="">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <select name='sort_attribute'>
                                            <option <?php if($data[2]['sort_attribute']=='title'){echo 'selected';} ?>  value="title">sortuj po tytule</option>
                                            <option <?php if($data[2]['sort_attribute']=='date'){echo 'selected';} ?> value="date">sortuj po dacie dodania</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <input <?php if($data[2]['sort_type']=='asc'){echo 'checked';} ?> type="radio" value="asc" checked name='sort_type' id="rosnaco"> <label for="rosnaco">rosnaco</label>
                                    </div>
                                    <div class="col">
                                        <input <?php if($data[2]['sort_type']=='desc'){echo 'checked';} ?> type="radio" value="desc" name='sort_type' id="malejeaco"> <label for="malejeaco">malejeaco</label>
                                    </div>


                                </div>



                                <div class="post-footer">

                                    <button type="submit" class="btn btn-success btn-small  float-right" id="btnLogin">Szukaj</button>

                                </div>

                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->
                </div>



            </div>
            <!--/row-->
        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>









<?php
// var_dump($data);

if(sizeof($data[0])==0)
{
    echo '<div class="text-center">Nie znaleziono rzadnego postu.</div>';
}


for ($i = 0; $i < sizeof($data[0]); $i++) {

    $Id = $data[0][$i]->Id;
    $Title = $data[0][$i]->Title;
    $Content = $data[0][$i]->Content;
    $date = $data[0][$i]->PostAddTime;
    if ($data[1] == 0) {
        $max_length = 50;
        if (strlen($Content) > $max_length) {
            $Content = substr($Content, 0, $max_length) . " ...";
        }
    }

    $action = SITE_PATH . "post/giveSinglePost/" . $Id;
    $action_delete = SITE_PATH . "post/deletePost/" . $Id;
    $action_edit = SITE_PATH . "post/editPost/" . $Id;
    $Author = $data[0][$i]->Name . " " . $data[0][$i]->Surname;
    $delete_button = "";
    $edit_button = "";
    // echo $_SESSION['user'];
    // echo var_dump($data);
    // echo var_dump($_SESSION['user']);
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']->Id == $data[0][$i]->UserId || $_SESSION['user']->Login == 'Admin') {
            $delete_button = "<button type='button'  class='btn btn-danger float-right mr-2 ' > <a class='text-white' href='$action_delete' >Usuń Post</a> </button>";
            $edit_button = "<button type='button' class='btn btn-primary float-right mr-2'><a class='text-white' href='$action_edit' >Edytuj Post</a> </button>";
        }
    }




    echo <<<html1

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- form card login -->

                    <div class="register_header">
                        <h3  class="header-1"> $Title </h3>
                    </div>

                    <div class="card rounded-0">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="readAllPost" novalidate="" action="$action" method="POST">
                                
                              <div class="">$Content</div>
                                
                                <div class="post-footer">
                                    
                                  
                                  <button type="submit" class="btn btn-success btn-small  float-right" id="btnLogin">Czytaj więcej</button>
                                  $edit_button
                                  $delete_button
                                  
                                  <div class="float-left author">autor: $Author <br> post dodano: $date </div>
                                </div>
                                
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
html1;
}

?>