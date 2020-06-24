
<?php
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		#collecting form data

		$rowid=$_POST['rowid'];
		$sub=$_POST['sub'];
		$topics=$_POST['topics'];
		$ctype=$_POST['ctype'];
		$time=$_POST['time'];
		$nop=$_POST['nop'];
		$nos=$_POST['nos'];
		$remarks=$_POST['remarks'];

		#connection to localhost and db selection
		require_once("connect.php");

		$query="UPDATE logsheet SET 
				subject='$sub',
				topics='$topics',
				class_type='$ctype',
				time='$time',
				nop='$nop',
				nos='$nos',
				remarks='$remarks'
				WHERE id=$rowid";

		if(mysqli_query($conn,$query)){
			echo "log sheet updated!";
			//header('location:testviewtlogs.php');
		}
		else{
			echo "error in updating log sheet!".mysqli_error($conn);
		}

	}
	else{
		echo "something wrong happened!";
	}



 ?>
	



