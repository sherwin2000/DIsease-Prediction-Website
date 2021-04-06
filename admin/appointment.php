<?php include("header.php") ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Appointment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Appointment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
     
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-9">All Appointment's</div>
                  <?php
                    if(isset($_SESSION['ERROR']))
                    {
                      ?>
                      <p class="text-danger"><?php echo $_SESSION['ERROR']?></p>
                      <?php
                      unset($_SESSION['ERROR']);
                    }
                  ?>
                  <?php
                    if(isset($_SESSION['SUCCESS']))
                    {
                      ?>
                      <p class="text-success"><?php echo $_SESSION['SUCCESS']?></p>
                      <?php
                      unset($_SESSION['SUCCESS']);
                    }
                  ?>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <span id="message_operation"></span>
                <table id="grade-table" class="text-center table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th style="width: 20%">
                        Appoinment Number
                      </th>
                      <th style="width: 30%">
                        Appoinment Name
                      </th>
                      <th style="width: 29%">
                        Associated Doctor
                      </th>
                      <th style="width: 21%">
                        Associated Dieases
                      </th>
                      <th style="width: 21%">
                        Date
                      </th>
                      <th style="width: 21%">
                        Time
                      </th>
                      <th style="width: 21%">
                        Status
                      </th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
<?php include("footer.php")?>
<script>
$(document).ready(function()
{
   var dataTable=$('#grade-table').DataTable({
     "processing": true,
     "severSide":true,
     "order":[],
     "ajax":{
       url:"appo_action.php",
       type:"POST"
     },
  "columnDefs":[
   {
    "targets":[6],
    "orderable":false,
   },
  ],
   });
});
</script>