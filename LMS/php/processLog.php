<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		#collecting form data and processing the logs entered by teacher

		$date=$_POST['date'];
		$tid=$_POST['tid'];
		$tname=$_POST['tname'];
		$sub=$_POST['subject'];
		$topics=$_POST['topics'];
		$ctype=$_POST['ctype'];
		$time1=$_POST['time'][0];
		$time2=$_POST['time'][1];
		$nop=$_POST['nop'];
		$nos=$_POST['nos'];
		$remarks=$_POST['remarks'];

		#connection to localhost and db selection
		$conn=mysqli_connect("localhost","root","") or die("connection error");

		$db=mysqli_select_db($conn,"lms") or die("db error");
       if(!empty($time2)) {
           $query = "INSERT INTO logsheet(id,date,tname,teacher_id,subject,topics,class_type,time,nop,nos,remarks,status) VALUES('','$date','$tname','$tid','$sub','$topics','$ctype','$time1','1','$nos','$remarks','not approved'),('','$date','$tname','$tid','$sub','$topics','$ctype','$time2','1','$nos','$remarks','not approved')";
       }
       else{
           $query = "INSERT INTO logsheet(id,date,tname,teacher_id,subject,topics,class_type,time,nop,nos,remarks,status) VALUES('','$date','$tname','$tid','$sub','$topics','$ctype','$time1','$nop','$nos','$remarks','not approved')";
       }
		if(mysqli_query($conn,$query)){
			echo $time2;
		}
		else{
			echo "error in updating log sheet!".mysqli_error($conn);
		}

	}
	else{
		echo "something wrong happened!";
	}



 ?>
