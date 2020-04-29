<?php if (isset($_SESSION["user"])) : ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- form card login -->

                    <div class="register_header">
                        <h3 class="header-1">Napisz swój nowy post</h3>
                    </div>

                    <div class="card rounded-0">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" action="<?= SITE_PATH . "post/addNewPost"; ?>" method="POST">
                                <div class="form-group">
                                    <label for="uname1">Tytuł <span class="wrong-input-data"><?php echo  $data[0]['title'] ?></span></label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="title" id="uname1" required="">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Treść <span class="wrong-input-data"><?php echo $data[0]['content'] ?></span></label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80">
                                        
                                    </textarea>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.gsrdg
                                        
                                        CKEDITOR.replace( 'editor1' );
                                    </script>
                                    
                                </div>
                                <div>
                                    <label class="custom-control custom-checkbox">
                                       
                                        <span class="custom-control-indicator"></span>
                                     
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-success btn-small float-right" id="btnLogin">DODAJ POST</button>
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