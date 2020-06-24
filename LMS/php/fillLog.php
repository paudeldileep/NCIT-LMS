<?php
#fill individual teacher log
#name and id of teacher is accessed from session variables
session_start();
if(isset($_SESSION['loggedin']) && isset($_SESSION['usert']) && isset($_SESSION['idt'])){
	$tname=$_SESSION['usert'];
	$tid=$_SESSION['idt'];
	require_once("connect.php");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Logs Home</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<style type="text/css">
		body{
			background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
		}
		#main{
			width:30%;
			margin-top: 10px;
			float: left;
			background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
		}
        #timebutton{
            margin: 5px;
        }
        #time2{
            display: none;
        }
        input:hover{
        	transform: scale(1.1);
        	border-color: #0E6DEA ;
        }
        select:hover{
        	transform: scale(1.1);
        	border-color: #0E6DEA ;
        }
        .logimage{      	
       
        }
	</style>
</head>
<body>

	<div class="container-fluid">
		<div class="justify-content-center" id="main">
			
			<h3 class="text-success ml-5">Provide the class details</h3>
			<!-- form to collect log details of a particular day ;date,teacher id and teacher name obtained via session -->
			<form class="form col-9" id="logform" method="POST" style="padding: 2px;margin:auto">
				
				<div class="form-group mr-2 col-xs-2">
					<input type="date" class="form-control form-control-sm" size="9" name="date" id="date">
				</div>
				<div class="form-group mr-2 col-xs-2">
					
					<input type="text" class="form-control form-control-sm" size="9" name="tname" value="<?php echo $tname; ?>" readonly>
				</div>
				<div class="form-group mr-2 col-xs-2">
					<input type="number" class="form-control form-control-sm" style="width: 7em" name="tid" value="<?php echo $tid ?>" readonly>
				</div>
				<div class="form-group mr-2 col-xs-2">
					<select class="form-control" name="subject" required>
		<!-- php to get teachers subject list from db-->
								<?php
									$query="SELECT subject FROM subjects WHERE t_id='$tid'";
									$result=mysqli_query($conn,$query);
									$numrows=mysqli_num_rows($result);
									echo '<option value="-1" selected>Select Subject</option>';
									if($numrows>0){
										while($row=mysqli_fetch_assoc($result)){
											echo "<option>".$row['subject']."</option>";
										}

									}
								?>
							 	</select>
				</div>
				<div class="form-group mr-2 col-xs-2">
					<input type="text" class="form-control form-control-sm" name="topics" placeholder="Topics" required>
				</div>
				<div class="form-group mr-2 col-xs-2">
					<div class="form-check-inline">
  						<label class="form-check-label">
    						<input type="radio" class="form-check-input" name="ctype" value="L" checked="checked">Lect
  						</label>
					</div>
					<div class="form-check-inline">
  						<label class="form-check-label">
    						<input type="radio" class="form-check-input" name="ctype" value="P">Pract
  						</label>
					</div>
				</div>

				<div class="form-group mr-2 col-xs-2">
					<input type="text" class="form-control form-control-sm" name="time[]" placeholder="Time1" required>
                    <button id="timebutton" class="btn btn-secondary btn-sm">+Add another</button>
                    <input type="text" class="form-control form-control-sm" name="time[]" id="time2" placeholder="Time2">
				</div>
				<div class="form-group mr-2 col-xs-2">
					<input type="number" min="1" max="5" class="form-control form-control-sm"  name="nop" placeholder="No.of Periods" required>
				</div>
				<div class="form-group mr-2 col-xs-2">
					<input type="number" min="1" max="300" class="form-control form-control-sm"  name="nos" placeholder="No.of Students">
				</div>
				<div class="form-group mr-2 col-xs-2">
					<input type="text" class="form-control form-control-sm" name="remarks" placeholder="Remarks Any">
				</div>
				<div class="form-group mr-2 col-xs-2 mt-2">
					<input type="submit" class="form-control form-control-sm btn-primary" name="filllog" value="Submit">
				</div>

			</form>
		</div>
		<div id="rightdiv">
			<div class="logimage">
				<img src="../images/diaryfinal.png">
			</div>
		</div>
	</div>	
		<!--button to toggle teacher logs, currently not being used -->
		<!--
		<div class="justify-content-center" id="viewlogsbox">
				<div class="form-group mr-2 col-xs-2 mt-2">
					<button class="btn-sm btn-primary" id="viewlogs">View My Logs</button>
				</div>

		</div>
		-->
		<!--load here the indivial teacher log
		<div id="show_logs" class="justify-content-center" style="display: none">
		</div>

	</div>
	-->
<!--	script to load teacher log in new div -->

	<script type="text/javascript" >
		$(document).ready(function(){

		    //toggle visibility of second time slot

            $("#timebutton").click(function () {
                $("#time2").toggle('slow',function () {

                });
            });
			/*
			setInterval(function(){
				$('#show_logs').load('viewtlogs.php');

			},1000);

			//toggle visibility of logs view

			$("#viewlogs").click(function(){

				$("#show_logs").toggle("slow");

			});
			*/
			$("#logform").submit(function(event){

				var sData=$("#logform").serialize();

				 $.ajax({
					url:'processLog.php',
					type:'POST',
					data:sData,
					success: function () {
              			alert('log added successfully!');
              			$("#logform")[0].reset();
           			 }
				});
				 event.preventDefault();

			});

		});


	</script>

</body>
</html>

<?php

}
else{
	#unauthorized view
	echo "auth error!";
	header('location:index.php');
}
