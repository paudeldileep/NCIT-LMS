<?php
#connecting to localhost and selecting database
	$conn=mysqli_connect("localhost","root","") or die("connection error");

	$db=mysqli_select_db($conn,"lms") or die("db error");

?>