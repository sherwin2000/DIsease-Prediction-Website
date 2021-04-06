<?php include("header.php");?>
  <main class="my-5">
    <div class="container">
      <div id="wizard">
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="fas fa-diagnoses"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title">Choose Symptoms</div>
              <div class="bd-wizard-step-subtitle">Step 1</div>
            </div>
          </div>
        </h3>
        <section>
          <div class="container">
           <div class="row">
            <div class="col-md-10">
            <?php 
             include('database_connection.php');
             $query = "SELECT * FROM symptom where `status`='1'";
             $statement = $conn->prepare($query);
             $statement->execute();
             $data = array();
             $filtered_rows = $statement->rowCount();
             if($filtered_rows>0)
             {
               $result = $statement->fetchAll();
               foreach($result as $row)
               {
                 $id=$row['symptom_id'];
                 ?>
                 <p class="btn btn-primary"><?php echo $row['symptom_name']; ?> <a href='changestatus.php?id=<?php echo $id ?>' class="fas fa-times text-light"></a></p>
            <?php
               }
               ?>
            </div>
            <div class="col-md-2">
            <a class="btn btn-outline-primary" href="clearall.php">Clear All</a>
            </div>
            <?php
             }
             ?>
           </div>
          </div>
          <div class="content-wrapper">
            <h4 class="section-heading">Enter your Symptoms </h4>
            <h5>In Which Body Region Do You Have The Symptoms?</h5>
            <div class="form-group">
            <label >Select Body Region : </label>
            <form method="POST" enctype='multipart/form-data' id="searchsymptoms">
              <fieldset>
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <select class="custom-select" id="search_body_part" name="search"> 
                      <option value="">Select Body part</option> 
                    </select> 
                  </div>
                </div>
              </fieldset>
            </form>
            <div id="searched_symptoms">
            
            </div>
          </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="fas fa-search"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title">Predict Disease</div>
              <div class="bd-wizard-step-subtitle">Step 2</div>
            </div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
            <h4 class="section-heading">Your Selected Symptoms </h4>
            <?php 
             $query = "SELECT * FROM symptom where `status`='1'";
             $statement = $conn->prepare($query);
             $statement->execute();
             $data = array();
             $filtered_rows = $statement->rowCount();
             if($filtered_rows>0)
             {
               $result = $statement->fetchAll();
               foreach($result as $row)
               {
                 $id=$row['symptom_id'];
                 ?>
                 <p class="text-primary"><?php echo $row['symptom_name']; ?></p>
            <?php
               }
              }
               ?>
               <br>
               <input type="button" class="btn btn-outline-danger col-sm-4 offset-sm-4" value="Hit To Predict" id="predict" />
               <br>
               <br>
               <h3 class="text-center">Searched Disease Is <u id="searched_disease"></u></h3>
               <br>
               <br>
               
          </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-account-check-outline"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title">Home Remedies </div>
              <div class="bd-wizard-step-subtitle">Step 3</div>
            </div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
        
           </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title">Doctor Needed ?</div>
              <div class="bd-wizard-step-subtitle">Step 4</div>
            </div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
         
          </div>  
        </section>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="jquery.steps.min.js"></script>
  <script src="bd-wizard.js"></script>
  <script>
    $(document).ready(function(){
        $.ajax({
          url:'load_bodypart.php',
          type:"POST",
          dataType:"json",
          success: function(data)
          {
             $.each(data,function(key,value){
               $("#search_body_part").append("<option value='"+value.body_part+"'>"+value.body_part+"</option>")
             })
          }
      });
      $("#search_body_part").change(function(){
        var body_part=$(this).val();
        if(body_part=="")
        {
          $("#searched_symptoms").html("");
        }
        else
        {
          var body_part=$(this).val();
          if(body_part=="")
          {
            $("#searched_symptoms").html("");
          }
          else
          {
            $.ajax({
            url:'searchsymptoms.php',
            type:"POST",
            data:{body_part:body_part},
            success: function(data)
            {
              $("#searched_symptoms").html(data);
            }
            });
          }
        }
      })

      $("#predict").click(function(){
        $("#predict").prop("value","Predicting . . .");
        $("#predict").attr('disabled','disabled');
        $.ajax({
            url:'predict.php',
            success: function(data)
            {
              $("#predict").prop("value","Hit To Predict");
              $("#searched_disease").html(data);
            }
         });
      })

    });
  </script>
</body>
</html>