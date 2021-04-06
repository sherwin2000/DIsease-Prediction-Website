<?php include("header.php") ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Disease's</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Disease</li>
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
                  <div class="col-md-4">All Disease's</div>
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
                  <span>         </span>
                  <div class="col-md-2 offset-md-6">
                    <a href="adddisease.php" class="btn btn-info"><i class="fas fa-user-plus"></i>  Add New Disease</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <span id="message_operation"></span>
                <table id="grade-table" class="text-center table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th style="width: 20%">
                        Disease Name
                      </th>
                      <th style="width: 30%">
                        Disease Symptoms
                      </th>
                      <th style="width: 29%">
                        Disease Remedies
                      </th>
                      <th style="width: 21%">
                         Action
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
<!-- ./wrapper -->
<?php include("footer.php")?>
<script>
$(document).ready(function()
{
   var dataTable=$('#grade-table').DataTable({
     "processing": true,
     "severSide":true,
     "order":[],
     "ajax":{
       url:"disease_action.php",
       type:"POST"
     },
  "columnDefs":[
   {
    "targets":[1,2,3],
    "orderable":false,
   },
  ],
   });
});
</script>