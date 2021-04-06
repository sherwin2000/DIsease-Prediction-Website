<?php include("header.php");?>
<?php
 if(isset($_GET['disease_id']))
 {
?>
    <div class="modal" tabindex="-1" id="formModal">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="modal_title">Disease Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                <?php
                   $conn = mysqli_connect("localhost","root","","finalproject") or die("Connection Failed");
                   $disease_id=$_GET['disease_id'];
                   $query = "SELECT * FROM disease WHERE `disease_id`='$disease_id'";
                   $result = mysqli_query($conn, $query);
                   $row = mysqli_fetch_array($result); 
                ?>
                  <p class="col-md-5 text-right text-success">Disease Name :- </p>
                    <div class="col-md-7">
                      <p class="text-info"><?php echo $row['disease_name'];?></p>
                    </div>
                  <p class="col-md-5 text-right text-success">Disease Symptoms :- </p>
                    <div class="col-md-7">
                      <p class="text-info"><?php echo $row['disease_symptoms'];?></p>
                    </div>
                  <p class="col-md-5 text-right text-success">Disease Remedies :- </p>
                    <div class="col-md-7">
                      <p class="text-info"><?php echo $row['disease_remedies'];?></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" href="cancelappo.php" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
<?php
 }
?>
<div class="container">
  <h1 class="text-center">Search Disease</h1>
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-9">Disease list</div>
          </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <span id="message_operation"></span>
              <table class="table table-striped table-bordered" id="grade-table">
                <thead>
                  <tr>
                    <th >Search Disease</th>
                    <th >view</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table> 
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
       url:"disease_action.php",
       type:"POST"
     },
  "columnDefs":[
   {
    "targets":[1],
    "orderable":false,
   },
  ],
   });
   var a=<?php 
 if(isset($_GET['disease_id']))
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
    }
});
</script>