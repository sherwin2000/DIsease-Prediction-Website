<?php
include('database_connection.php');
$query = "SELECT * FROM disease ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE disease_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY disease_id ASC ';
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
  $id=$row["disease_id"];
  $action='<a class="btn btn-primary btn-sm" href="viewdisease.php?id=$id">
  <i class="fas fa-folder">
  </i>
  View
</a><span> | </span>
<a class="btn btn-info btn-sm" href="editdisease.php?id=$id">
  <i class="fas fa-pencil-alt">
  </i>
  Edit
</a><span> | </span>
<a class="btn btn-danger btn-sm" href="deletedisease.php?id=$id">
  <i class="fas fa-trash">
  </i>
  Delete
</a>';
  $sub_array = array();
  $sub_array[] = $row['disease_name'];
  $sub_array[] = $row['disease_symptoms'];
  $sub_array[] = $row['disease_remedies'];
  $sub_array[] = $action;
  $data[] = $sub_array;
}

$output = array(
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_records($conn, 'disease'),
 "data"    => $data
);
echo json_encode($output);
?>