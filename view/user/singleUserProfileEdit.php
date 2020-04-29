<?php if (isset($_SESSION["user"])) : ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto"><!-- form card login -->
                    <div class="register_header">
                        <h3 class="header-1">Edycja twoich danych</h3>
                    </div>
                    <div class="card rounded-0">
                   
                        <div class="card-body">
                            
                            <form class="form" role="form" autocomplete="off" id="registerForm" novalidate="" action="<?= SITE_PATH . "user/managementSingleUserData/"; ?>" method="POST">
                                
                                <div class="form-group">
                                    <label for="uname1">Imię</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['name'] ?>" name="name" id="uname1" required="">
                                    <div class="wrong-input-data"><?php echo $data[0]['name'] ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="uname1">Nazwisko</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['surname'] ?>" name="surname" id="uname1" required="">
                                    <div class="wrong-input-data"><?php echo $data[0]['surname'] ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="uname1">Email</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['email'] ?>" name="email" id="uname1" required="">
                                    <div class="wrong-input-data"><?php echo $data[0]['email'] ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="uname1">Age</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['age'] ?>" name="age" id="uname1" required="">
                                   <div class="wrong-input-data"><?php echo $data[0]['age'] ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="uname1">Telefon</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['phone'] ?>" name="phone" id="uname1" required="">
                                    <div class="wrong-input-data"><?php echo $data[0]['phone'] ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="uname1">login</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['login'] ?>" name="login" id="uname1" required="">
                                    <div class="wrong-input-data"><?php echo $data[0]['login'] ?></div>
                                </div>

                               
                                <button type="submit" class="btn btn-success btn-small float-right" id="btnLogin">Zapisz Dane</button>

                                <button type='button' class='btn btn-primary float-right mr-2'><a class='text-white' href='restartPassword' >Zmień hasło</a> </button>
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