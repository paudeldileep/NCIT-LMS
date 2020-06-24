<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style type="text/css">
		caption{
			caption-side: top;
		}
		body{
			background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
		}
		td{
			 background-color: #6cbef5 !important;
			 color:black;
		}
		tr{
			background-color: #127ec7 !important;
		}

	</style>
</head>
<body>



<?php
session_start();
if(isset($_SESSION['loggedin']) && isset($_SESSION['usert']) && isset($_SESSION['idt'])){

	$tname=$_SESSION['usert'];
	$tid=$_SESSION['idt'];
	require_once("connect.php");
	#get logs that are not approved
	$query="SELECT * FROM logsheet where teacher_id='$tid' and status='not approved'";

	#get logs that are approved
	$query2="SELECT * FROM logsheet where teacher_id='$tid' and status='approved'";
	

	$result=mysqli_query($conn,$query);
	if($result){
?>		
		<div id="lognotapprovedbox" class="m-4" style="line-height: 1">
					<table class="table table-dark table-bordered table-striped w-auto">
						<caption class="text-danger">Logs Not Approved</caption>
						<tr>
							<th>Class taken</th>
							<th>Subjects</th>
							<th>Topics</th>
							<th>Class Type</th>
							<th>Time</th>
							<th>NOP</th>
							<th>NOS</th>
							<th>Remarks</th>
							<th>Status</th>
							<th>Actions</th>

						</tr>
<?php				
				while($row=mysqli_fetch_assoc($result)){
?>
					<tr>
						<form method="post" action="updatetlog.php">
						<input type="number" name="rowid" value="<?php echo $row['id'] ?>" style="visibility: hidden" readonly>
						<td><?php echo $row['date']; ?></td>
						<td><input type="text" class="form-control" name="sub" value="<?php echo $row['subject']; ?>"></td>
						<td><input class="form-control" type="text" name="topics" value="<?php echo $row['topics']; ?>"></td>
						<td><input class="form-control" type="text" style="width:3em " name="ctype" value="<?php echo $row['class_type']; ?>"></td>
						<td><input class="form-control" type="text" name="time" value="<?php echo $row['time']; ?>"></td>
						<td><input class="form-control" type="number" style="width:3em " name="nop" value="<?php echo $row['nop']; ?>"></td>
						<td><input class="form-control" type="number" name="nos" style="width:5em " value="<?php echo $row['nos']; ?>"></td>
						<td><input class="form-control" name="remarks" value="<?php echo $row['remarks']; ?>"></td>
						<td><?php echo $row['status']; ?></td>
						<td ><input class="form-control btn-primary" type="submit" name="subform" value="Update Log"></td>
						</form>
					</tr>	
<?php 									
				}
?>
					</table>

				</div> 
<?php
		}
		else{
			echo "no data to show";
		}

		#approved logs
		$result=mysqli_query($conn,$query2);
		if($result){
	
?>		
		<div id="displaybox" class="m-4" style="line-height: 1">
					<table class="table table-dark table-bordered table-striped w-auto">
						<caption class="text-success">Approved Logs</caption>
						<tr>
							<th>Class taken</th>
							<th>Subjects</th>
							<th>Topics</th>
							<th>Class Type</th>
							<th>Time</th>
							<th>NOP</th>
							<th>NOS</th>
							<th>Remarks</th>
							<th>Status</th>
							

						</tr>
<?php				
				while($row=mysqli_fetch_assoc($result)){
?>
					<tr>
						<td><?php echo $row['date']; ?></td>
						<td><?php echo $row['subject']; ?></td>
						<td><?php echo $row['topics']; ?></td>
						<td><?php echo $row['class_type']; ?></td>
						<td><?php echo $row['time']; ?></td>
						<td><?php echo $row['nop']; ?></td>
						<td><?php echo $row['nos']; ?></td>
						<td><?php echo $row['remarks']; ?></td>
						<td><?php echo $row['status']; ?></td>
						
					</tr>	
<?php 									
				}
?>
					</table>

				</div> 
<?php
		}
		else{
			echo "no data to show";
		}
#end of authentication check if condition
}
else{
	echo "something went wrong with authorization!";
}
?>

</body>
</html>