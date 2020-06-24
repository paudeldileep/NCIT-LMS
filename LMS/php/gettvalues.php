<?php
#to fetch id and shift of the teacher
	if(isset($_POST['tid'])){
		require_once("connect.php");
		$qry = "SELECT id,shift FROM teachers WHERE id=". $_POST['tid'];
    	$rec = mysqli_query($conn,$qry);
    	if (mysqli_num_rows($rec) > 0) {
        	while ($res = mysqli_fetch_array($rec)) {
       			 echo $res['id']."|".$res['shift'];
    		}
    	}
	}
	die();
?>