<?php
#processing teacher login credentials
#using session to store name and id and loggedin status

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		session_start();

		$userid=$_POST['userid'];
		//$userpass=md5($_POST['userpass']);
		$userpass=$_POST['userpass'];

		require_once("connect.php");

		#authentication based on username and password for hod
		$query="SELECT * FROM users WHERE username='$userid' and password='$userpass'";
		$result=mysqli_query($conn,$query);
		if($result){
			$num_rows=mysqli_num_rows($result);
			if($num_rows==0){
				header('location: index.php');
			}
			else if($num_rows==1){
				$row=mysqli_fetch_assoc($result);
				$username=$row['username'];
				$id=$row['id'];

				#creating three session variables name,id and loggedin status
				$_SESSION['userhod']=$username;
				$_SESSION['idhod']=$id;
				$_SESSION["loggedin"] = true;
				header('location: hhome.php');
			}
			else{
				header('location: index.php');
			}
		}
		else{
			header('location: index.php');
		}

	}
	else{
		header('location: index.php');
		#if any error redirecting to index page
	}	

?>