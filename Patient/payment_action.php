<?php
include('database_connection.php');
$id=$_SESSION['id'];
$query = "SELECT * FROM appointment WHERE `patient_id`='".$id."'";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE appointment_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY appointment_id ASC ';
}
if(isset($_POST["Length"]))
{
    if($_POST["Length"] != -1)
    {
       $query .= 'LIMIT'.$_POST['start'].','.$_POST['Length'].'';
    }
}

$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$date=strtotime(date("y-m-d"));
foreach($result as $row)
{
  $date1=strtotime($row['date']);
  if($row['payment']!='0')
  {
     $text="Pay";
     $fees=$row['fees'];
     $textclass="btn btn-primary";
     $appo_id=$row['appointment_id'];
     $doc_id=$row['doctor_id'];
    $sub_array = array();
    $sub_array[] = $row['appointment_id'];
    $sub_array[] = $row['appointment_name'];
    $sub_array[] = $row['associated_doctor'];
    $sub_array[] = $row['associated_dieases'];
    $sub_array[] = $row['date'];
    $sub_array[] = $row['time'];
    $sub_array[] = $row['fees'];
    $sub_array[] = "<a href='checkout.php?fees=$fees&&appo_id=$appo_id&&to=$doc_id' class='$textclass'>$text</a>";
    $data[] = $sub_array;
  }
 }

$output = array(
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_records($conn, 'appointment'),
 "data"    => $data
);
echo json_encode($output);
?>