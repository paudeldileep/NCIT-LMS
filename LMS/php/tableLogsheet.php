<?php
	#creating the table logsheet
	$conn=mysqli_connect("localhost","root","") or die("connection error");

	$db=mysqli_select_db($conn,"lms") or die("db error");

	#create table

	$query="CREATE TABLE logsheet(id INT(10) PRIMARY KEY AUTO_INCREMENT,date DATE,tname TEXT(50),teacher_id INT(4),subject TEXT(100) NOT NULL,topics VARCHAR(200) NOT NULL,class_type TEXT(10) NOT NULL, time VARCHAR(100) NOT NULL,nop INT(2) NOT NULL,nos INT(3) NOT NULL,remarks VARCHAR(100),status TEXT(20),payable TEXT(6))";
	if(mysqli_query($conn,$query)){
		echo "logs table created!";
	}
	else{
		echo "error in creating table!";
	}

?>
