<?php if (isset($_SESSION["user"])) : ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto"><!-- form card login -->
                    <div class="register_header">
                        <h3 class="header-1">Rejstracja</h3>
                    </div>
                    <div class="card rounded-0">
                   
                        <div class="card-body">
                            
                            <form class="form" role="form" autocomplete="off" id="registerForm" novalidate="" action="<?= SITE_PATH . "user/restartPassword/"; ?>" method="POST">
                                
                                <div class="form-group">
                                    <label>Podaj bieżące hasło:</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['pass'] ?>" name="pass" id="pwd1" required="" autocomplete="new-password">
                                    <div class="wrong-input-data"><?php echo $data[0]['pass'] ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Hasło</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['newPass1'] ?>" name="newPass1" id="pwd1" required="" autocomplete="new-password">
                                    <div class="wrong-input-data"><?php echo $data[0]['newPass1'] ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Powtórz hasło</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['newPass2'] ?>" name="newPass2" id="pwd1" required="" autocomplete="new-password">
                                    <div class="wrong-input-data"><?php echo $data[0]['newPass2'] ?></div>
                                </div>

                               
                                <button type="submit" class="btn btn-success btn-small float-right" id="btnLogin">Zmień hasło</button>
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