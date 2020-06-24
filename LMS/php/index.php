<?php
#index page for login: both teacher and HOD/Admin
if(isset($_SESSION['loggedin'])){

	if(isset($_SESSION['usert'])){
		header('location:thome.php');
	}
	else if(isset($_SESSION['userhod'])){
		header('location:hhome.php');
	}
	else{
		header('location:logout.php');
	}

}
else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home-NCIT LMS</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
  	
  </script>
  <script src="https://kit.fontawesome.com/164b99a598.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <style type="text/css">
  	.navbar{
  		background: linear-gradient(to left, #0099ff 24%, #ccffff 97%);
  	}
  	.center {
  		width: 70%;
  		border-radius: 25px;
  		margin: auto;
  		margin-top: 100px;
  		border: 2px solid blue;
  		background: linear-gradient(to top left, #33ccff 0%, #ccffff 100%);
  		height: 400px;
  	}
  	#loginbox{
  		width: 70%;
  		margin: auto;
  		margin-top: 50px;
  		position: relative;

  	}
  	#hloginbox{
  		position: absolute;
  		top:0;
  	}
  	#tloginbox,#hloginbox{
  		display: none;
  	}
  	.sbtn:hover{
  		transform: scale(1.3);
  		border-color: red;
  	}

  </style>
</head>
<body>
	
	<!-- header with logo and app name-->
		<div class="navbar">
			<nav class="navbar navbar-dark fixed-top">
  				<a class="navbar-brand" href="#">
    			<img src="../images/logo-ncit-lms.png" height="40" class="d-inline-block align-top" alt="">
   				
  				</a>
			</nav>
		</div>
		<div id="main">
		<!-- buttons that can toggle login page for teacher and HOD -->
			<div class="center text-center">
				<h1 class="text-center text-dark"><span class="fas fa-user-tie"></span></h1>
					
					<div class="btn-group mt-3" id="buttonsdiv">
						<button class="btn-light btn-outline-primary btn-lg mr-5 sbtn" id="tbtn">Teacher</button>
						<button class="btn-light btn-outline-primary btn-lg ml-5 sbtn" id="hbtn">H O D</button>
					</div>
					<div id="loginbox">
						<div id="tloginbox">
							<form class="form-inline" action="tloginprocess.php" method="POST">
								<div class="input-group mb-2 mr-sm-2 ml-5">
								    <div class="input-group-prepend">
								    	<i class="zmdi zmdi-lock zmdi-hc-2x"></i>
								      <div class="input-group-text ml-2">Teacher Id</div>
								    </div>
								    <input type="text" class="form-control" name="userid" style="width: 7em">
							  	</div>
							  	<div class="input-group mb-2 mr-sm-2 ml-4">
								    <div class="input-group-prepend">
								      	<div class="input-group-text">Password</div>
								    </div>
								   	<input type="password" class="form-control" name="userpass" style="width: 7em">
								</div>
							  	<button type="submit" class="btn btn-primary mb-2">Log In</button>
							</form>
						</div>

						<div id="hloginbox">
							<form class="form-inline" action="hloginprocess.php" method="POST">
								  <div class="input-group mb-2 mr-sm-2 ml-5">
								    <div class="input-group-prepend">
								    	<i class="zmdi zmdi-lock zmdi-hc-2x"></i>
								      <div class="input-group-text ml-2">Username</div>
								    </div>
								    <input type="text" class="form-control" name="userid" style="width: 7em">
								  </div>
								  <div class="input-group mb-2 mr-sm-2 ml-4">
								    <div class="input-group-prepend">
								      <div class="input-group-text">Password</div>
								    </div>
								    <input type="password" class="form-control" name="userpass" style="width: 7em">
								  </div>
								  <button type="submit" class="btn btn-primary mb-2">Log In</button>
							</form>
						</div>

					</div>
					
			
			</div>

		</div>

		<!-- jquery code to facilitate button toggling-->
		<script type="text/javascript">
			$(document).ready(function() {
				/*
				$("#tbtn").click(function() {
					
					$("#loginbox").load("tindex.php");
				});
				$("#hbtn").click(function() {
					
					$("#loginbox").load("hindex.php");
				});
				*/
				$("#tbtn").click(function(){
					$("#tloginbox").toggle('slow');
				
				});
				$("#hbtn").click(function(){
					$("#hloginbox").toggle('slow');
					 
				});
			});
		</script>

</body>
</html>
<?php
}
?>