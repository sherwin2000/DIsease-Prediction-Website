<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		include('../database_connection.php'); 
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		if($_POST['ORDERID']!=''&&$_POST['TXNAMOUNT']!='')
		{
			$ORDER_ID=$_POST['ORDERID'];
			echo $patient_email=$_COOKIE['email'];
			echo $appo_id=$_COOKIE['appo_id'];
			echo $patient_id=$_COOKIE['id'];
			echo $doctor_id=$_COOKIE['doc_id'];
			$status=$_POST['STATUS'];
			$respag=$_POST['RESPMSG'];
			$amount=$_POST['TXNAMOUNT'];
			$date=$_POST['TXNDATE'];
			$query ="INSERT INTO payment (`payment_id`,`order_id`,`patient_email`,`appointment_id`,`status`,`respmsg`,`amount`,`order_date`,`patient_id`,`doctor_id`) 
			VALUES ('','$ORDER_ID','$patient_email','$appo_id','$status','$respag','$amount','$date','$patient_id','$doctor_id')";
	     $statement = $conn->prepare($query);
			 $result = $statement->execute();
			 if($result)
			 {
				 echo "Redirecting...";
         header('location:../paymentdone.php');
			 }
     }
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}
}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>