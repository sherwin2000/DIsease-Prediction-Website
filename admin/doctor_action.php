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
  $tablename='doctor';
  $action='<a class="btn btn-primary btn-sm" href="toview.php?id=$id">
  <i class="fas fa-folder">
  </i>
  View
</a><span> | </span>
<a class="btn btn-info btn-sm" href="toedit.php?id=$id">
  <i class="fas fa-pencil-alt">
  </i>
  Edit
</a><span> | </span>
<a class="btn btn-danger btn-sm" href="todelete.php?id=$id">
  <i class="fas fa-trash">
  </i>
  Delete
</a>';
  if($row['status']==1)
  {
    $text="<a href='todeactive.php?id=$id&tablename=$tablename' class='badge badge-success'>Active</a>";
  }
  else
  {
    $text="<p class='badge badge-danger'>Inactive</p>";
  }
  $images="../". $row['doctor_photo'];
  $sub_array = array();
  $sub_array[] = $row['doctor_id'];
  $sub_array[] = $row['doctor_name'];
  $sub_array[] = "<img class='img-thumbnail rounded mx-auto d-block' style='width:15vh; height:15vh;' src='$images'>";  
  $sub_array[] = $row['doctor_specialization'];
  $sub_array[] = "$text";
  $sub_array[] = "$action";
  $data[] = $sub_array;
}

$output = array(
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_records($conn, 'doctor'),
 "data"    => $data
);
echo json_encode($output);
?>