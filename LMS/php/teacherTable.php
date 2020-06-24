<?php
#creating table teachers
	require_once("connect.php");

	$query="CREATE TABLE teachers(id INT(5) PRIMARY KEY NOT NULL,fname TEXT(50) NOT NULL,lname TEXT(50),phone INT(15) NOT NULL,shift TEXT(10) NOT NULL,faculty TEXT(100) NOT NULL, password VARCHAR(400))";
	if(mysqli_query($conn,$query)){
		echo "teachers table created";
	}
	else{
		echo mysqli_error($conn);
	}
?>