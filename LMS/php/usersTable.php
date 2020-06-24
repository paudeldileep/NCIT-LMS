
	<?php
	#creating users(HOD/Admin) table 
	require_once("connect.php");

	$query="CREATE TABLE users(id INT(5) AUTO_INCREMENT PRIMARY KEY,username VARCHAR(150) NOT NULL,password VARCHAR(400) NOT NULL,fullname TEXT(100) NOT NULL,faculty VARCHAR(100) NOT NULL )";
	if(mysqli_query($conn,$query)){
		echo "users table created";
	}
	else{
		echo mysqli_error($conn);
	}


?>