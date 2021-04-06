<?php
include('database_connection.php');
if(!isset($_SESSION['email']))
{
  header('location:logout.php');
}
else
{
  header("Pragma: no-cache");
	header("Cache-Control: no-cache");
  header("Expires: 0");
  $appo_id=$_GET['appo_id'];
  setcookie('appo_id',$appo_id,time() + (60 * 30));
  $doc_id=$_GET['to'];
  setcookie('doc_id',$doc_id,time() + (60 * 30));
  $email=$_SESSION['email'];
  setcookie('email',$email,time() + (60 * 30));
  $id=$_SESSION['id'];
  setcookie('id',$id,time() + (60 * 30)); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <title>Check Out Page</title>
  <meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-6 offset-md-3">
<form class="text-center border border-light p-5" method="post" action="./PaytmKit/pgRedirect.php">
    <p class="h4 mb-4">Welcome To Check Out Page</p>
    <p><span class="text-danger">*Note</span> :- Complete Your Payment By Clicking Checkout Button</p>
    <div class="form-group row">
       <label for="ORDER_ID" class="col-md-4 col-from-label">ORDER ID</label>
       <div class="col-md-8">
       <input class="form-control mb-4" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo  "ORDS" . rand(10000,99999999)?>" readonly>
       </div>
    </div>

    <div class="form-group row">
       <label for="CUST_ID" class="col-md-4 col-from-label">Patient Email</label>
       <div class="col-md-8">
       <input class="form-control mb-4" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" 
       value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>" readonly>
       </div>
    </div>

    <div class="form-group row">
       <label for="TXN_AMOUNT" class="col-md-4 col-from-label">Amount</label>
       <div class="col-md-8">
       <input class="form-control mb-4" title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
            value="<?php if(isset($_GET['fees'])){echo $_GET['fees'];}?>" readonly>
       </div>
    </div>

    <div class="form-group row">
       <div class="col-md-8">
       <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" readonly>
       </div>
    </div>

    <div class="form-group row">
       <div class="col-md-8">
       <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" readonly>
       </div>
    </div>

    <div class="form-group row">
       <div class="col-md-4 offset-md-2">
       <input value="CheckOut" class="btn btn-info btn-block" type="submit"	onclick="">
       </div>
       <div class="col-md-4">
       <a href="./payment.php" class="btn btn-danger">Cancel</a>
       </div>
    </div>
</form>
</div>
</div>
</div>
</body>
</html>