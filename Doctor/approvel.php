<?php include("header.php");?>
<?php
 if(isset($_GET['appo_id']))
 {
?>
   <input type="hidden" name="" id="abc" value="<?php echo $_GET['appo_id']?>">
    <div class="modal" tabindex="-1" id="formModal">
      <div class="modal-dialog">
        <form method="post" id="appo_form">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="modal_title">Approve Appointment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="row">
                <div class="col-md-8 offset-md-2">
                  <p>Date: <input type="text" name="date" id="datepicker"></p>
                </div>
                <div class="col-md-8 offset-md-2">
                  <p>Time: <input type="text" name="time" id="timepicker"></p>
                </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="appo_id" id="appo_id" value="<?php echo $_GET['appo_id'];?>">
              <button type="submit" class="btn btn-success btn-sm" name="button_action" id="button_action">Confirm</button>
              <button type="button"class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>
<?php
 }
?>
<div class="container">
  <h1 class="text-center">My Appointments</h1>
  <div class="row">
    <div class="col-md-3 text-center">
      <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="appointment.php">All Appointment</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="approvel.php">Pending Approval</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="payment.php">Pending Payment</a>
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
       url:"approvel_action.php",
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
   var a=<?php 
 if(isset($_GET['appo_id']))
 {
   echo 1;
 }
 else 
 {
   echo 0;
 }
 ?>;
   if(a==1)
   {
        $('#formModal').modal('show');
        $("#datepicker" ).datepicker();
        $('#timepicker').timepicker();
        clear_field();

        function clear_field()
        {
          $('#appo_form')[0].reset();
          $('#error_reason').text('');
        }
  
          $('#appo_form').on('submit',function(event)
          {
              event.preventDefault();
              $.ajax({
                url:"confirmappo.php",
                method:"post",
                data:$(this).serialize(),
                dataType:"json",
                beforesend:function()
                {
                  $("#button_action").value('confirming...');
                  $("#button_action").attr('disabled','disabled');
                },
                success:function(data)
                {
                  $("#button_action").val("Confirm");
                  $("#button_action").attr('disabled',false); 
                  if(data.success)
                  {
                    $("#message_operation").html('<div class="alert alert-success">Appointment Confirmed</div>')
                    clear_field();
                    dataTable.ajax.reload();
                    $('#formModal').modal('hide');
                  }
              }
            });
          })
    }
});
</script>