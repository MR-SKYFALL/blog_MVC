
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
                            
                            <form class="form" role="form" autocomplete="off" id="registerForm" novalidate="" action="<?= SITE_PATH . "user/register/"; ?>" method="POST">
                                
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

                                <div class="form-group">
                                    <label>Hasło</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['pass1'] ?>" name="pass1" id="pwd1" required="" autocomplete="new-password">
                                    <div class="wrong-input-data"><?php echo $data[0]['pass1'] ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Powtórz hasło</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['pass2'] ?>" name="pass2" id="pwd1" required="" autocomplete="new-password">
                                    <div class="wrong-input-data"><?php echo $data[0]['pass2'] ?></div>
                                </div>

                               
                                <button type="submit" class="btn btn-success btn-small float-right" id="btnLogin">Rejstruj</button>
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
    var test = document.querySelectorAll('input'); 
    console.log(test);
//    test[0].value = 'aaa';
//    test[1].value = 'aaa';
//    test[2].value = 'aaa27@op.pl';
//    test[3].value = '12';
//    test[4].value = '123456789';
//    test[5].value = 'aaa';
//    test[6].value = '1234';
//    test[7].value = '1234';

//    test[0].value = 'bbb';
//    test[1].value = 'bba';
//    test[2].value = 'aaa27@op.pl2';
//    test[3].value = '12';
//    test[4].value = '123456789';
//    test[5].value = 'aaa2';
//    test[6].value = '1234';
//    test[7].value = '1234';

</script>