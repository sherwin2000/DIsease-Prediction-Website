<?php include("header.php");?>
<div class="container">
  <h1 class="text-center">My Appointments</h1>
  <div class="row">
    <div class="col-md-3 text-center">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="appointment.php">My Appointment</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="payment.php">Pending Payment</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="approvel.php">Pending Approval</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="cancelappo.php" class="btn btn-danger">Cancel Appointment</a>
        </li>
      </ul>
    </div>
    <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-9">Appointment list</div>
          </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <span id="message_operation"></span>
              <table class="table table-striped table-bordered" id="grade-table">
                <thead>
                  <tr>
                    <th >Appointment Number</th>
                    <th >Appointment Name</th>
                    <th >Associated Doctor</th>
                    <th >Associated Dieases</th>
                    <th >Date</th>
                    <th >Time</th>
                    <th >Status</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table> 
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
$(document).ready(function()
{
   var dataTable=$('#grade-table').DataTable({
     "processing": true,
     "severSide":true,
     "order":[],
     "ajax":{
       url:"appo_action.php",
       type:"POST",
       data:{action:'fetch'}
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