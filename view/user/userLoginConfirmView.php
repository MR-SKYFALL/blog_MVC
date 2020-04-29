<?php if (isset($_SESSION["user"])) : ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-body">
                        
                            Witaj <?php echo  $_SESSION["user"]->Name;?>!
                        
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