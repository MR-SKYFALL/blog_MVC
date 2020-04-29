
<?php if (isset($_SESSION["user"])) : ?>
<?php 

$post_Id = $data[2]->Id;

$local_title = $data[2]->Title;
$local_content = $data[2]->Content;

if($data[1]!=0)
{
    $local_title = $data[1]['title'];
    $local_content = $data[1]['content'];
}

?>


<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- form card login -->

                    <div class="register_header">
                        <h3 class="header-1">Edycja twojego postu</h3>
                    </div>

                    <div class="card rounded-0">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" action="<?= SITE_PATH . "post/editPost/$post_Id"; ?>" method="POST">
                                <div class="form-group">
                                    <label for="uname1">Tytuł <span class="wrong-input-data"><?php echo  $data[0]['title'] ?></span></label>
                                    <input type="text" class="form-control form-control-lg rounded-0" value="<?php echo $local_title ?>" name="title" id="uname1" required="">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Treść <span class="wrong-input-data"><?php echo $data[0]['content'] ?></span> </label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80">
                                        <?php echo $local_content ?>
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
                                <button type="submit" class="btn btn-success btn-small float-right" id="btnLogin">ZAPISZ POST</button>
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