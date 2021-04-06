<?php
include('database_connection.php');
$query = "SELECT * FROM doctor ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE doctor_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY doctor_id ASC ';
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
foreach($result as $row)
{
  $id=$row['doctor_id'];
  $sub_array = array();
  $sub_array[] = $row['doctor_name'];
  $sub_array[] = $row['doctor_specialization'];
  $sub_array[] = "<span class='font-weight-bolder'>&#8377 ".$row['fees']."</span>";
  $sub_array[] = $row['city'];
  $sub_array[] = "<a href='searchdoctor.php?id=$id' class='btn btn-success'>Book Appointment</a>";
  $data[] = $sub_array;
}

$output = array(
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_records($conn, 'doctor'),
 "data"    => $data
);
echo json_encode($output);
?>