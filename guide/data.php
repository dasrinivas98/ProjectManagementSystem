<?php
include('../assests/dbconnect.php');
include('../signin/login/login.php');
header('Content-Type: application/json');
$gid = $_SESSION['g_id'];
// $sqlQuery = "SELECT count(*) as 'Active' FROM projects where g_id=$gid and finalStatus = 0 ,(SELECT count(*) as 'Completed' FROM projects where g_id=$gid and finalStatus =1)";
$sqlQuery = "select sum(case when finalStatus = 0 then 1 else 0 end) As Active,sum(case when finalStatus = 1 then 1 else 0 end) As Completed from projects WHERE g_id=3";
$result = mysqli_query($link,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
echo json_encode($data);
?>