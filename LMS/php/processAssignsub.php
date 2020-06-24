<?php
#inserting subject details to db

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$tid=$_POST['tid'];
		$tname=$_POST['tname'];
		$subject=$_POST['subject'];
		$sem=$_POST['sem'];
		$shift=$_POST['shift'];
		$faculty=$_POST['faculty'];
		$time=$_POST['time'];

		require_once("connect.php");

		$query="INSERT INTO subjects(id,t_id,tname,subject,semester,shift,faculty,timing) VALUES('','$tid','$tname','$subject','$sem','$shift','$faculty','$time')";
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