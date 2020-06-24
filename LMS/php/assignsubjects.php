<?php
	
	session_start();
	if(isset($_SESSION['loggedin']) && isset($_SESSION['userhod']) && isset($_SESSION['idhod']))
	{
		require_once("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<style type="text/css">
		#teacherform{
			margin-top: 10px;
			border-right: 1px solid blue;
			padding-right: 10px;
		}
		#sublistbox{
			margin-left: 10px;
			
			padding-left: 2px;
		}
		body{
			background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
		}

	</style>
</head>
<body>
<!--assign subjects to teachers by HOD-->
	<div class="container">
		<div class="row">
			<div class="col-4">
				<div id="teacherform">
					<h3 class="text-success text-center">Assign subject</h3>
					<form id="assignsub" method="POST" >
						<div class="form-group row">
							<label for="fname" class="col-4 col-form-label"> Teacher Name</label>
							<div class="col-8">
							 	<select class="form-control" name="tname" id="tname" required>
		<!-- php to get teachers name list from db-->
								<?php
									$query="SELECT fname,lname,id,shift FROM teachers";
									$result=mysqli_query($conn,$query);
									$numrows=mysqli_num_rows($result);
									echo '<option value="-1" selected>Select Teacher</option>';
									if($numrows>0){
										while($row=mysqli_fetch_assoc($result)){
											echo "<option id='".$row['id']."'>".$row['fname'].' '.$row['lname']."</option>";
										}

									}
								?>					 		
							 	</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="tid" class="col-4 col-form-label"> Teacher Id</label>
							<div class="col-8">
							 	<input class="form-control" type="text" name="tid" id="tid" readonly>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="subject" class="col-4 col-form-label"> Subject</label>
							<div class="col-8">
							 	<input class="form-control" type="text" name="subject"  id="subject" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="sem" class="col-4 col-form-label">Semester</label>
							<div class="col-8">
							 	<select class="custom-select custom-select-sm" name="sem" required>
								  <option selected>Select semester</option>
								  <option value="first">1st</option>
								  <option value="second">2nd</option>
								  <option value="third">3rd</option>
								  <option value="fourth">4th</option>
								  <option value="fifth">5th</option>
								  <option value="sixth">6th</option>
								  <option value="seventh">7th</option>
								  <option value="eighth">8th</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="shift" class="col-4 col-form-label">Class Shift</label>
							<div class="col-8">
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
                                        <input class="form-check-input" type="radio" name="shift" id="r3" value="Mor/Day">
                                        <label class="form-check-label" for="r2">Both</label>
                                        
                                    </div>
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
							<label for="time" class="col-4 col-form-label"> Timing</label>
							<div class="col-8">
							 	<input class="form-control" type="text" name="time"  id="time">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-4 col-form-label"></label>
							<div class="col-8">
							 	<input class="form-control btn btn-info" type="submit" name="subform" value="Assign">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-8">
				<div id="sublistbox">
					
				</div>
			</div>
		</div>
		
	</div>

<!--ajax submit to get t id and shift-->
	<script type="text/javascript">
		$(document).ready(function() {
			$("#tname").change(function(){
				var id = $(this).children(":selected").attr("id");
				$.ajax({
					url: 'gettvalues.php',
					type: 'POST',
					data: {tid:id},
					success:function(data){
						var datas=data.split('|');
						$("#tid").val(datas[0]);
						//$("#shift").val(datas[1]);
					}

				});
			});
			$("#assignsub").submit(function(event){

				var sData=$("#assignsub").serialize();

				 $.ajax({
					url:'processAssignsub.php',
					type:'POST',
					data:sData,
					success: function () {
              			alert('subject assigned successfully');
              			$("#assignsub")[0].reset();
           			 }
				});
				 event.preventDefault();
		
			});
			setInterval(function(){
			$("#sublistbox").load('subjectlist.php')
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