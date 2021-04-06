<?php include("header.php");?>
<div class="container">
  <h1 class="text-center">Add Doctor</h1>
  <div class="row">
    <div class="col-md-12">
    <div class="col-md-12 offset-md-2">
        <form method="POST" enctype='multipart/form-data' id="doctorloginform">
          <fieldset>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
                    <span id="error_user_name" class="text-danger"></span>
                  </div>
               </div>
               
               <div class="col-md-6">
                  <div class="form-group">  
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">&nbsp*&nbspWe'll never share your email with anyone else.</small>
                    <span id="error_user_email" class="text-danger"></span>
                  </div>
               </div>
            </div>
            
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    <span id="error_user_password" class="text-danger"></span>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
                    <span id="error_user_confirm_password" class="text-danger"></span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="doctorspecialization">Doctor Specialization</label>
                    <input type="text" class="form-control" name="doctorspecialization" id="doctorspecialization" placeholder="Doctor Specialization">
                    <span id="error_doctorspecialization" class="text-danger"></span>
                  </div>
               </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Doctor Photo</label>
                    <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">&nbsp*&nbspUpload your latest Photo & Size < 1MB</small>
                  </div>
                </div>
            </div>      
          </fieldset>
            <input type="hidden" name="role" value="patient">
            <div style="text-align:center">
               <button type="submit" name="submit" id="patient_login" class="btn btn-danger col-sm-8">Submit</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
   </div>
</div>
<?php include("footer.php")?>
  <script>
    $(document).ready(function(){
      $('#doctorloginform').on('submit',function(event)
      {
        event.preventDefault();
        $.ajax({
          url:'registerdoctorfield.php',
          method:"post",
          enctype: 'multipart/form-data',
          processData: false, 
          contentType: false,
          cache: false,
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
              location.href="doctor.php";
            }
            if(data.error)
            {
              $("patient_login").val('login');
              $("patient_login").attr('disabled',false); 
              if(data.error_user_name!='')
              {
                $("#error_user_name").text(data.error_user_name);
              }
              else
              {
                $("#error_user_name").text('');
              }

              if(data.error_user_email!='')
              {
                $("#error_user_email").text(data.error_user_email);
              }
              else
              {
                $("#error_user_email").text('');
              }

              if(data.error_user_password!='')
              {
                $("#error_user_password").text(data.error_user_password);
              }
              else
              {
                $("#error_user_password").text('');
              }

              if(data.error_user_confirm_password!='')
              {
                $("#error_user_confirm_password").text(data.error_user_confirm_password);
              }
              else
              {
                $("#error_user_confirm_password").text('');
              }  
              
              if(data.error_doctorspecialization!='')
              {
                $("#error_doctorspecialization").text(data.error_doctorspecialization);
              }
              else
              {
                $("#error_doctorspecialization").text('');
              }  
            }
          }
      });
      })
    });
  </script>
</body>
</html>