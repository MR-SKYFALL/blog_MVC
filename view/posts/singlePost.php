


<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- form card login -->

                    <div class="register_header">
                        <h3 class="header-1"><?php echo $data[0]->Title ?></h3>
                    </div>

                    <div class="card rounded-0">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="readAllPost" novalidate="" action="<?php echo SITE_PATH ."post/showAllPosts"; ?>" method="POST">
                                
                              <div class=""> <?php echo $data[0]->Content ?></div>
                                
                                <div class="post-footer">
                                  <button type="submit" class="btn btn-success btn-small float-right" id="btnLogin">Powrót</button>
                                  <div class="float-left author">autor: <?php echo $data[1] ?><br> post dodano: <?php echo $data[0]->PostAddTime ?></div>
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
