<?php
include('database_connection.php');
$id=$_SESSION['did'];
$query = "SELECT * FROM appointment WHERE `doctor_id`='".$id."' ";
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
  if($row['date']!='0000-00-00'||$row['time']!='00:00:00')
  {
    if($date1>=$date)
    {
      if($row['cancel']!='0')
      {
        $text="Canceled";
        $textclass="text-danger";
      }
      else
      {
        $text="Pending";
        $textclass="text-primary";
      }
    }
    else
    {
      if($row['status']==1)
      {
        $text="Completed";
        $textclass="text-success";
      }
      else
      {
        $text="Missed";
        $textclass="text-danger";
      }
    }
    $sub_array = array();
    $sub_array[] = $row['appointment_id'];
    $sub_array[] = $row['appointment_name'];
    $sub_array[] = $row['associated_dieases'];
    $sub_array[] = $row['date'];
    $sub_array[] = $row['time'];
    $sub_array[] = "<h6 class='$textclass'>$text</h6>";
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