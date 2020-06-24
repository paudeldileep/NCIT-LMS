<?php
#creating subjects table
	require_once("connect.php");

	$query="CREATE TABLE subjects(id INT(5) AUTO_INCREMENT PRIMARY KEY, t_id INT(5) NOT NULL,tname TEXT(150) NOT NULL,subject VARCHAR(150) NOT NULL,semester VARCHAR(50) NOT NULL,shift TEXT(50) NOT NULL,faculty TEXT(100) NOT NULL,timing TEXT(10) NOT NULL)";
	if(mysqli_query($conn,$query)){
		echo "subjects table created";
	}
	else{
		echo mysqli_error($conn);
	}

?>