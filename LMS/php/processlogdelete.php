<?php
#process log deletion
	session_start();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$rowid=$_POST['rowid'];

		require_once("connect.php");

		$query="DELETE FROM logsheet WHERE id=$rowid";

		if(mysqli_query($conn,$query)){
				header('location:deleteownlog.php');
			
				
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