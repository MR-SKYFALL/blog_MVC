
<?php if (isset($_SESSION["user"])) : ?>

<?php 

for($i=0;$i<sizeof($data);$i++)
{
    $name = $data[$i]->Name;
    $surname = $data[$i]->Surname;
    $login = $data[$i]->Login;
    $Id = $data[$i]->Id;
    $action = SITE_PATH."user/singleUserInfo/".$Id;


    echo <<<html1

    <div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- form card login -->

                   

                    <div class="card rounded-0">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="readAllPost" novalidate="" action="$action" method="POST">
                                
                              <div class="">
                                  <div>Imie i Nazwisko: $name $surname</div>
                                  <div>Login: $login</div>
                                  
                              </div>
                                
                                <div class="post-footer">
                                  <button type="submit" class="btn btn-success btn-small  float-right" id="btnLogin">Zobacz więcej informacji</button>
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
<?php else : ?>
<div class="text-center">Nie masz uprawnienien do tej czesci strony</div>
<?php endif; ?>