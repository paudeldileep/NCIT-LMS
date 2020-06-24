<?php
#for login error mesaage
?>
<!DOCTYPE html>
<html>
<head>
	<title>Error Login</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style type="text/css">
		.container{
			width:60%;
			margin: auto;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h3 class="text-danger col-md-6">Login Credentials are Wrong !</h3>
			<button class=" col-md-2 btn-sm" onclick="window.location.href = 'index.php'">Try Again!</a></button>
		</div>
	</div>

</body>
</html>