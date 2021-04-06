<?php include("header.php");?>
<?php $role=$_GET['val'];
      $_SESSION['role']=$role;
?>
    <div class="container">
      <div class="row">
        <div class="col-md-5 offset-md-3">
        <span id="error_status" class="text-danger"></span>
        <form method="post" id="loginform">
          <fieldset>
            <legend class="mainhead text-center"><?php 
               if($role=='admin')
               {
                echo 'Admin';
               }
               else if($role=='doctor')
               {
                echo 'Doctor';
               }
               else if($role=='patient')
               {
                echo 'Patient';
               }
               else{}
            ?> Login</legend>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" >
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              <span id="error_user_email" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              <span id="error_user_password" class="text-danger"></span>
            </div>
            <div style="text-align:center">
               <button type="submit" name="submit" id="loginbtn" class="btn btn-danger text-center  col-sm-8">Submit</button>
            </div>
            <a href="" class="forgot">Forgot Password?</a>
          </fieldset>
        </form>
        </div>
      </div>
    </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $('#loginform').on('submit',function(event)
    {
      event.preventDefault();
      $.ajax({
        url:"loginuserfield.php",
        method:"post",
        data:$(this).serialize(),
        dataType:"json",
        beforesend:function()
        {
          $("loginbtn").value('validate...');
          $("loginbtn").attr('disabled','disabled');
        },
        success: function(data)
        {
           if(data.success)
           {
              location.href="<?php echo $role;?>/home.php";
           }
           if(data.error)
           {
            $("loginbtn").val('login');
            $("loginbtn").attr('disabled',false); 
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
           }
        }
      });
    })
  });
</script>
</body>
</html>