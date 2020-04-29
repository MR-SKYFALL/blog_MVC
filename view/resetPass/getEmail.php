


<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto"><!-- form card login -->
                    <div class="register_header">
                        <h3 class="header-1">Odzyskaj hasło</h3>
                    </div>
                    <div class="card rounded-0">
                   
                        <div class="card-body">
                            
                        <form class="form" role="form" autocomplete="off" id="registerForm" novalidate="" action="<?= SITE_PATH . "forgotPass/restorePass"; ?>" method="POST">
                                
                             
                                <div class="form-group">
                                    <label for="uname1">Podaj Email</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php echo $data[1]['email'] ?>" name="email" id="uname1" required="">
                                    <div class="wrong-input-data"><?php echo $data[0] ?></div>
                                </div>
                            
                            
                            
                            
                            <button type="submit" class="btn btn-success btn-small float-right" id="btnLogin">Wyślj</button>
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