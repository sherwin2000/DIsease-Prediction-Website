<?php include("header.php");?>
<div class="container">
  <h1 class="text-center"><span class="text-danger">Add</span> Disease</h1>
  <div class="row">
    <div class="col-md-3 text-center">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="disease.php">All Diseases</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <a href="adddisease.php">Add Diseases</a>
        </li>
      </ul>
    </div>
    <div class="col-md-9">
    <form method="POST" enctype='multipart/form-data' id="adddiseaseform">
          <fieldset>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Disease Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Disease Name">
                    <span id="error_name" class="text-danger"></span>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                    <label for="symptoms">Disease Symptoms</label>
                    <input type="text" class="form-control" name="symptoms" id="symptoms" placeholder="Disease Symptoms">
                    <span id="error_symptoms" class="text-danger"></span>
                  </div>
               </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="form-group">
                    <label for="remedies">Homemade Remedies</label>
                    <input type="text" class="form-control" name="remedies" id="symptoms" placeholder="Homemade remedies">
                    <span id="error_remedies" class="text-danger"></span>
                  </div>
                </div>
            </div>      
          </fieldset>
            <div style="text-align:center">
               <button type="submit" name="submit" id="add_disease" class="btn btn-danger col-sm-8">Add Disease</button>
            </div>
          </fieldset>
        </form>
    </div>
   </div>
</div>
</body>
</html>
<script>
$(document).ready(function()
{
  $('#adddiseaseform').on('submit',function(event)
      {
        event.preventDefault();
        $.ajax({
          url:'adddiseasefield.php',
          method:"post",
          enctype: 'multipart/form-data',
          processData: false, 
          contentType: false,
          cache: false,
          data:new FormData(this),
          dataType:"json",
          beforesend:function()
          {
            $("add_disease").value('validate...');
            $("add_disease").attr('disabled','disabled');
          },
          success: function(data)
          {
            if(data.success)
            {
              location.href="disease.php";
            }
            if(data.error)
            {
              $("add_disease").val('Add Disease');
              $("add_disease").attr('disabled',false); 
              if(data.error_name!='')
              {
                $("#error_name").text(data.error_name);
              }
              else
              {
                $("#error_name").text('');
              }

              if(data.error_symptoms!='')
              {
                $("#error_symptoms").text(data.error_symptoms);
              }
              else
              {
                $("#error_symptoms").text('');
              }

              if(data.error_remedies!='')
              {
                $("#error_remedies").text(data.error_remedies);
              }
              else
              {
                $("#error_remedies").text('');
              }
            }
          }
      });
      })
});
</script>