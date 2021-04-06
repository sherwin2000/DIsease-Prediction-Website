<?php include("header.php");?>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <form method="POST" enctype='multipart/form-data' id="patientloginform">
          <fieldset>
            <legend class="text-center mainhead"><span class="text-danger">Join</span> Us</legend>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Full Name">
                    <span id="error_user_name" class="text-danger"></span>
                  </div>
               </div>
               
               <div class="col-md-6">
                  <div class="form-group">  
                    <label for="email">Email address</label>
                    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
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
                <div class="col-md-6 offset-md-3">
                  <div class="form-group">
                    <label for="exampleInputFile">patient Photo</label>
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function(){
      $('#patientloginform').on('submit',function(event)
      {
        event.preventDefault();
        $.ajax({
          url:'registerpatientfield.php',
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
              location.href="login.php";
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
            }
          }
      });
      })
    });
  </script>
</body>
</html>