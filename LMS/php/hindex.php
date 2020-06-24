<?php
#login for hods
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home-Teacher</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<!-- HOD login page that will be submitted to hloginprocess.php-->
	<div>
		<form class="form-inline" action="hloginprocess.php" method="POST">
			  <div class="input-group mb-2 mr-sm-2 ml-5">
			    <div class="input-group-prepend">
			      <div class="input-group-text">Username</div>
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

</body>
</html>