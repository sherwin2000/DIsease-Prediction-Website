<?php include("header.php");?>
<?php  if(isset($_GET['id']))
 {
  ?>
  <input type="hidden" name="" id="abc" value="<?php echo $_GET['appo_id']?>">
    <div class="modal" tabindex="-1" id="formModal">
      <div class="modal-dialog">
        <form method="post" id="grade_form">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="modal_title">Book An Appointment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="row">
                  <lable class="col-md-4 text-right">Dieases Name
                    <span class="text-danger">*</span></lable>
                    <div class="col-md-8">
                      <input type="text" name="dieasesname" id="dieasesname" class="form-control">
                      <span id="error_dieases_name" class="text-danger"></span>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $_GET['id'];?>">
              <button type="submit" class="btn btn-success btn-sm" name="button_action" id="button_action">Book</button>
              <button type="button" href="searchdoctor.php" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>

<?php
}
?>
<div class="container">
  <h1 class="text-center">All Doctors</h1>
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-9">Doctor list</div>
          </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <span id="message_operation"></span>
              <table class="table table-striped table-bordered" id="grade-table">
                <thead>
                  <tr>
                    <th >Doctor Name</th>
                    <th >Doctors Specialization</th>
                    <th >Doctor fees</th>
                    <th >City</th>
                    <th >Book Appointment</th>
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
</body>
</html>
<script>
$(document).ready(function()
{
   var dataTable=$('#grade-table').DataTable({
     "processing": true,
     "severSide":true,
     "ajax":{
       url:"doctor_action.php",
       type:"POST"
     }
   });
   $("#deactive").click(function(){
        alert("You've clicked the link.");
    });
    var a=<?php 
 if(isset($_GET['id']))
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
        $('#modal-title').text('Book Appointment');
        $('#formModal').modal('show');
        clear_field();

        function clear_field()
        {
          $('#grade_form')[0].reset();
          $('#error_reason').text('');
        }
  
          $('#grade_form').on('submit',function(event)
          {
              event.preventDefault();
              $.ajax({
                url:"bookapointment.php",
                method:"post",
                data:$(this).serialize(),
                dataType:"json",
                beforesend:function()
                {
                  $("#button_action").value('validate...');
                  $("#button_action").attr('disabled','disabled');
                },
                success:function(data)
                {
                  $("#button_action").val("Cancel");
                  $("#button_action").attr('disabled',false); 
                  if(data.success)
                  {
                    $("#message_operation").html('<div class="alert alert-success">Appointment Booked</div>')
                    clear_field();
                    dataTable.ajax.reload();
                    $('#formModal').modal('hide');
                  }
                  if(data.error)
                  {
                    if(data.error_dieases_name!='')
                    {
                      $("#error_reason").text(data.error_dieases_name);
                    }
                    else
                    {
                      $("#error_reason").text('');
                    }
                   }
                }
              });
           })
       }
});
</script>