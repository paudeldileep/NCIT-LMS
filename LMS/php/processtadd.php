<?php
#inserting teacher details to db

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$tid=$_POST['tid'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$ph=$_POST['ph'];
		$shift=$_POST['shift'];
		$faculty=$_POST['faculty'];
		$pass=md5($_POST['pass']);

		require_once("connect.php");

		$query="INSERT INTO teachers(id,fname,lname,phone,shift,faculty,password) VALUES('$tid','$fname','$lname','$ph','$shift','$faculty','$pass')";
		if(mysqli_query($conn,$query)){
			echo "teacher added successfully!";
			//header('location:addteacher.php');
		}
		else{
			echo mysqli_error($conn);
		}
	}
	else{
		echo "you are not supposed to be here!";
	}

?>