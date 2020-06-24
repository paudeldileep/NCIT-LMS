<?php
require_once("connect.php");
$tdata=$_POST['rowid'];

/*
$content_raw = file_get_contents("php://input");
$decoded_data = json_decode($content_raw, true); // THIS IS WHAT YOU NEED
$tdata = $decoded_data['rowid']; // THIS IS WHAT YOU NEED

*/
$query="INSERT INTO testtable1(id,tid) VALUES('','$tdata')";
if(mysqli_query($conn,$query)){
	echo "succees";
	header('location:testviewtlogs.php');
}
else{
	echo mysqli_error($conn);
}

?>