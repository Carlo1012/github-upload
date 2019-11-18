
<?php
//fetch.php
include '../../include/connect.php';
$columns = array('username', 'firstname', 'middlename', 'lastname', 'district_assigned', 'address', 'email', 'status');

$query = "SELECT * FROM staff_info";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE username LIKE "%'.$_POST["search"]["value"].'%" 
 OR firstname LIKE "%'.$_POST["search"]["value"].'%" 
 OR middlename LIKE "%'.$_POST["search"]["value"].'%"
 OR lastname LIKE "%'.$_POST["search"]["value"].'%"
 OR district_assigned LIKE "%'.$_POST["search"]["value"].'%"
 OR address LIKE "%'.$_POST["search"]["value"].'%"
 OR email LIKE "%'.$_POST["search"]["value"].'%"

 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
if ($row["active"] == "1") {
	$stat = "Blocked";
} else {
	$stat = "Active";

}



 $sub_array = array();
 $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="username">' . $row["username"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="firstname">' . $row["firstname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="middlename">' . $row["middlename"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="lastname">' . $row["lastname"] . '</div>';
  $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="district_assigned">' . $row["district_assigned"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="address">' . $row["address"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="email">' . $row["email"] . '</div>';
  $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="active">' . $stat . '</div>';
  $sub_array[] = '<button type="button" name="changepw" class="btn btn-warning btn-xs changepw" id="'.$row["id"].'">Reset</button> ';

 $sub_array[] = '<button type="button" name="block" class="btn btn-info btn-xs block" id="'.$row["id"].'">Blocked/Unblocked</button><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 
 // $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "SELECT * FROM staff_info";
 $result = mysqli_query($conn, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
