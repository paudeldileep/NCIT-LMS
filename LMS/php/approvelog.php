<?php
#processing log approval by setting the value of status column to approved and payable column to true or false
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$rowid=$_POST['rowid'];
		$pay=$_POST['pay'];

		require_once("connect.php");

		$query="UPDATE logsheet SET status='approved',payable='$pay' WHERE id=$rowid";

		if(mysqli_query($conn,$query)){
			header('location:viewAllLogs.php');
		}
		else{
			echo "something went wrong with approval";
		}

	}
	else{
		echo "You shouldn't be here!";
	}	

?>