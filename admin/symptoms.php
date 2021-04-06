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
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body col-md-4 offset-md-4">
                <span id="error_status" class="text-danger"></span>
                <form method="post" id="loginform">
                  <fieldset>
                    <legend class="mainhead text-center"></legend>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      <span id="error_user_password" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">Confirm Password</label>
                      <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                      <span id="error_user_confirm__password" class="text-danger"></span>
                    </div>
                    <div style="text-align:center">
                      <button type="submit" name="submit" id="loginbtn" class="btn btn-danger text-center  col-sm-8">Change Password</button>
                    </div>
                    <a href="" class="forgot">Forgot Password?</a>
                  </fieldset>
                </form>
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