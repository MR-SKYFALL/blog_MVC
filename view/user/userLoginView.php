

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- form card login -->
                    <div class="register_header">
                        <h3 class="header-1">Logowanie</h3>
                    </div>
                    <div class="card rounded-0">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" action="<?php echo SITE_PATH . "user/login/"; ?>" method="POST">
                                <div class="form-group">
                                    <label for="uname1">Użytkownik</label>
                                    <input type="text" value="<?php echo $data[1]['uname1'] ?>" class="form-control form-control-lg rounded-0" name="uname1" id="login" required="">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Hasło</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="pwd1" id="pwd1" required="" autocomplete="new-password">
                                    <div class="wrong-input-data"><?php echo $data[0] ?></div>
                                    <a class="text-primary" href="<?= SITE_PATH . "forgotPass/inputEmail"; ?>"> Zapomniałem hasła</a>
                                </div>
                                <div>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked name='remember_me' class="csustom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description small text-dark">Zapamiętaj mnie</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-success btn-small float-right" id="btnLogin">Login</button>
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
<script>
var login = localStorage.getItem('login');
var password = localStorage.getItem('password');

if(login != '' && password != '')
{
    document.querySelector("#login").value = login;
    document.querySelector("#pwd1").value = password;

}

</script>