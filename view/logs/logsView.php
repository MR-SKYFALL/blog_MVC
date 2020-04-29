<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


<?php if (isset($_SESSION["user"])&& $_SESSION["user"]->Login=='Admin') : ?>

<form action="<?php echo SITE_PATH . "log/showAllLogs";?>" method="POST">
<div class="container">
    <div class='col-md-5'>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker6'>
          <input type='text' value="<?php echo $data[1]['date1'] ?>" name="date1" class="form-control" />
          <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
    <div class='col-md-5'>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker7'>
          <input type='text' value="<?php echo $data[1]['date2'] ?>" name="date2" class="form-control" />
          
          <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        
          </span>
          
        </div>
       
      </div>
      
    </div>
    <button type="submit" class="btn btn-success btn-small " id="btnLogin">POKAŻ LOGI</button>
  </div>
  
  </form>


<div class=" py-5 mx-5 px-5 ">
    <div class="">
        <div class="">
           
                        
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Id Operacji
                      </th>
                      <th class="th-sm">Typ Operacji
                      </th>
                      <th class="th-sm">Id Urzytkownika
                      </th>
                      <th class="th-sm">Typ Obiektu
                      </th>
                      <th class="th-sm">Czas operacji
                      </th>
                      <th class="th-sm">Szczegóły
                      </th>
                    </tr>
                  </thead>


                  <tbody>
                    <?php
                    for ($i = 0; $i < sizeof($data[0]); $i++) 
                    {
                      //var_dump($data);
                      $id_operacji = $data[0][$i]->Id;
                      $typ_operacji = $data[0][$i]->Type;
                      $id_usera = $data[0][$i]->UserId;
                      $object_type = $data[0][$i]->ObjectName;
                      $time = $data[0][$i]->Time;
                      $comment = $data[0][$i]->Comment;
                      $table_row = "
                      <tr>
                      <td>$id_operacji</td>
                      <td>$typ_operacji</td>
                      <td>$id_usera</td>
                      <td>$object_type</td>
                      <td>$time</td>
                      <td>$comment</td>
                    </tr>
                    ";

                    echo $table_row;

                    }
                    ?>
                    
                    
                  </tbody>


                  <tfoot>
                    <tr>
                      <th>Id Operacji
                      </th>
                      <th>Typ Operacji
                      </th>
                      <th>Id Urzytkownika
                      </th>
                      <th>Typ Obiektu
                      </th>
                      <th>Czas operacji
                      </th>
                      <th>Szczegóły
                      </th>
                    </tr>
                  </tfoot>
                </table>
                <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
                <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>

                <script>
                $(document).ready(function () {
                  $.noConflict();
                $('#dtBasicExample').DataTable();
                $('.dataTables_length').addClass('bs-select');

                });




                </script>

                <script>
                $(document).ready(function() {
                                  $.noConflict();
                                  
                                  
                                 
                                  
                  $(function() {
                    $('#datetimepicker6').datetimepicker({
                      useCurrent: false,
                      format : 'YYYY/MM/DD HH:mm:ss'
                    });
                    $('#datetimepicker7').datetimepicker({
                      useCurrent: false, //Important! See issue #1075
                      format : 'YYYY/MM/DD HH:mm:ss'
                    });
                    $("#datetimepicker6").on("dp.change", function(e) {
                      $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                      console.log(e.date);
                    });
                    $("#datetimepicker7").on("dp.change", function(e) {
                      $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                    });
                  });
                });
                </script>

        
            
        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<?php else : ?>
    <div class="text-center">Nie masz uprawnien do zobaczenia tej czesci strony</div>
<?php endif; ?>

    
