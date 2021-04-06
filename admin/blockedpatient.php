<?php include("header.php");?>
  <div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blocked Doctors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="#">Doctors</a></li>
              <li class="breadcrumb-item active"><a href="#">Blocked Doctors</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
   </section> 
   
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-9">Doctor list<span class="text-success">(To UnBlock Doctor just click on Block Button)</span></div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <span id="message_operation"></span>
                <table id="grade-table" class="text-center table table-bordered table-striped">
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
                        Reason
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
  </div>

<?php include("footer.php");?>
<script>
$(document).ready(function()
{
   var dataTable=$('#grade-table').DataTable({
     "processing": true,
     "severSide":true,
     "order":[],
     "ajax":{
       url:"blockedpatient_action.php",
       type:"POST"
     },
  "columnDefs":[
   {
    "targets":[2],
    "orderable":false,
   },
  ],
   });
});
</script>