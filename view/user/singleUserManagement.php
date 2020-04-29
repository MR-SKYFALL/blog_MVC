<?php if (isset($_SESSION["user"])) : ?>
<?php 
$action_delete = SITE_PATH . "user/deleteSingleUser/".$data[0]->Id;
$delete_button = "<button type='button'  class='btn btn-danger float-right mr-2 ' > <a class='text-white' href='$action_delete' >Usuń Urzytkownika</a> </button>";
$action = SITE_PATH. "user/usersManagement";
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- form card login -->

                   

                    <div class="card rounded-0">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="readAllPost" novalidate="" action="<?php echo $action ?>" method="POST">
                                
                              <div class="">
                                  <div class="">Imie: <?php echo  $data[0]->Name ?></div>
                                  <div class="">Nazwisko: <?php echo $data[0]->Surname ?></div>
                                  <div class="">Login: <?php echo $data[0]->Login ?></div>
                                  <div class="">Email: <?php echo $data[0]->Email ?></div>
                                  <div class="">Wiek: <?php echo $data[0]->Age ?></div>
                                  <div class="">Telefon: <?php echo $data[0]->Phone ?></div>
                                  <div class="">Id: <?php echo $data[0]->Id ?></div>
                                  <div class="">Liczba zamieszczonych postów: <?php echo  $data[1]['postQuantity'] ?></div>
                                  <div class="">Data rejestracji: <?php echo $data[0]->RegisterTime ?></div>
                                  <div class="">Data publikacji ostatniego posta: <?php echo $data[1]['timeLastPost'] ?></div>
                                  
                              </div>
                                
                                <div class="post-footer">
                                  <button type="submit" class="btn btn-success btn-small  float-right" id="btnLogin">Powrót</button>
                                  <?php echo $delete_button; ?>
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
<?php else : ?>
<div class="text-center">Nie masz uprawnienien do tej czesci strony</div>
<?php endif; ?>