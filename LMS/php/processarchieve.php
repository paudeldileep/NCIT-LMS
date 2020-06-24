<?php
#add logs to archieve
	session_start();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$rowid=$_POST['rowid'];

		require_once("connect.php");

		$query="UPDATE logsheet SET status='archieved' WHERE id='$rowid'";

		if(mysqli_query($conn,$query)){
				header('location:ArchieveLog.php');
		}
		else{
			echo "something went wrong with approval";
		}

	}
	else{
		echo "You shouldn't be here!";
		header('location: index.php');
	}	
?>