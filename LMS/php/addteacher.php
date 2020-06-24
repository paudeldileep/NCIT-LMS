<?php
	
	session_start();
	if(isset($_SESSION['loggedin']) && isset($_SESSION['userhod']) && isset($_SESSION['idhod']))
	{

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<style type="text/css">
		#teacherslistbox{
			margin-left: 10px;
			
		}
		#teacherform{
			border-right: 1px solid blue;
			padding-right: 10px;
		}
		body{
			background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
		}
	</style>
	
				
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-5">
				<div id="teacherform">
					<h3 class="text-success text-center">Add a new Teacher</h3>
					<form id="addt" method="POST" >
						<div class="form-group row">
							<label for="tid" class="col-4 col-form-label"> Teacher Id</label>
							<div class="col-8">
							 	<input class="form-control" type="text" name="tid" id="tid" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-4 col-form-label"> First Name</label>
							<div class="col-8">
							 	<input class="form-control" type="text" name="fname" id="fname" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-4 col-form-label"> Last Name</label>
							<div class="col-8">
							 	<input class="form-control" type="text" name="lname"  id="lname" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="ph" class="col-4 col-form-label"> Phone No.</label>
							<div class="col-8">
							 	<input class="form-control" type="tel" name="ph"  id="ph" pattern="[0-9]{10}" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="shift" class="col-4 col-form-label">Shift</label>
							<div class="col-8">
							 	<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="shift" id="r1" value="Morning">
								  <label class="form-check-label" for="r1">Mor</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="shift" id="r2" value="Day">
								  <label class="form-check-label" for="r2">Day</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="shift" id="r3" value="Part Time">
								  <label class="form-check-label" for="r3">Part Time</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="faculty" class="col-4 col-form-label"> Faculty</label>
							<div class="col-8">
							 	<select class="custom-select custom-select-sm" name="faculty" required>
								  <option selected>Select Faculty</option>
								  <option value="Department of IT Engineering">BE IT</option>
								  <option value="Department of Computer Engineering">BE CE</option>
								  <option value="Department of Civil Engineering">BE Civil</option>
								  <option value="Department of Electronics and Communications Engineering">BE Elx</option>
								  <option value="Department of Software Engineering">BE SE</option>
								  <option value="Department of Computer Applications">BCA</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="pass" class="col-4 col-form-label"> Password</label>
							<div class="col-8">
							 	<input class="form-control" type="password" name="pass"  id="pass" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-4 col-form-label"></label>
							<div class="col-8">
							 	<input class="form-control btn btn-info" type="submit" name="subform" value="Add Teacher">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-7">
				<div id="teacherslistbox">
					
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		 
		$(document).ready(function(){

			$("#addt").submit(function(event){

				//function addteacher(){

				var sData=$("#addt").serialize();

				 $.ajax({
					url:'processtadd.php',
					type:'POST',
					data:sData,
					success: function () {
              			alert('teacher added successfully');
              			$("#addt")[0].reset();
           			 }
				});
				 event.preventDefault();
		
			});
			setInterval(function(){
			$("#teacherslistbox").load('teacherlist.php')
			}, 1000);
		});	
		
	</script>

</body>
</html>

<?php
	}	
	else{
	#authentication error!
	header('location:index.php');	
}

?>
