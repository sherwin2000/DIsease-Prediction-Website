<?php include("header.php") ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Doctors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="#">Doctors</a></li>
              <li class="breadcrumb-item active"><a href="#">All Doctors</a></li>
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
                  <div class="col-md-4">Doctor list<span class="text-danger">(To Block Doctor just click on Status button)</span></div>
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
                    <a href="adddoctor.php" class="btn btn-info"><i class="fas fa-user-plus"></i>  Add New Doctor</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <span id="message_operation"></span>
                <table id="example1" class="text-center table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th style="width: 9%">
                        Doctor Id
                      </th>
                      <th style="width: 20%">
                        Doctor Photo
                      </th>
                      <th style="width: 20%">
                        Doctor Name
                      </th>
                      <th style="width: 25%">
                        Doctors Specialization
                      </th>
                      <th style="width: 5%">
                        Status
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
  $(function () {

    $('#example1').DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "severSide":true,
      "ajax":{
        url:"user_action.php",
        type:"POST"
      }
    });
    $("#deactive").click(function(){
        alert("You've clicked the link.");
   });
  });
</script>
