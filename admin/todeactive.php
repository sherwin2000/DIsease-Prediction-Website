<?php include("header.php");?>
  <div class="container">
    <div class="row">
     <div class="col-md-4 offset-md-4">
       <form method="POST" enctype='multipart/form-data' id="doctorloginform">
          <fieldset>
            <legend class="text-center mainhead"><span class="text-danger">Deactivate</span> User</legend>
            <div class="row text-center">
               <div class="col-md-12">
                  <div class="form-group">
                    <label for="reason">Reason</label>
                    <input type="text" class="form-control col-sm-12" name="reason" id="reason" placeholder="Enter Reason">
                    <span id="error_reason" class="text-danger"></span>
                  </div>
               </div>
            </div>
          </fieldset>
            <input type="hidden" name="role" value="patient">
            <div style="text-align:center">
               <button type="submit" name="submit" id="patient_login" class="btn btn-danger col-sm-8">Submit</button>
            </div>
          </fieldset>
          <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
          <input type="hidden" name="tablename" value="<?php echo $_GET['tablename']?>">
        </form>
      </div>
    </div>
  </div>
  <?php include("footer.php");?>
  <script>
    $(document).ready(function(){
      $('#doctorloginform').on('submit',function(event)
      {
        event.preventDefault();
        $.ajax({
          url:'registerreason.php',
          method:"post",
          processData: false, 
          contentType: false,
          data:new FormData(this),
          dataType:"json",
          beforesend:function()
          {
            $("patient_login").value('validate...');
            $("patient_login").attr('disabled','disabled');
          },
          success: function(data)
          {
            if(data.success)
            {
              location.href="<?php echo $_GET['tablename'].'.php';?>";
            }
            if(data.error)
            {
              $("patient_login").val('Submit');
              $("patient_login").attr('disabled',false); 
              if(data.error_reason!='')
              {
                $("#error_reason").text(data.error_reason);
              }
              else
              {
                $("#error_reason").text('');
              }
            }
          }
        });
      })
    });
  </script>