<?php #admin page to delete logsheeet of all teachers or individual teachers ; delete approved and not approved logs seperatly 

	session_start();
	if(isset($_SESSION['loggedin']) && isset($_SESSION['userhod']) && isset($_SESSION['idhod'])){

?>

<!DOCTYPE html>
<html>
<head>
	<title>View Log Sheet</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	
	<script src="https://kit.fontawesome.com/164b99a598.js" crossorigin="anonymous"></script>
	<style type="text/css">
		.search{
			margin-top: 30px;
			margin-left: 50px;
		}
		caption{
			caption-side: top;
		}
	</style>
</head>
<body>
	<div class="search">
		<h3>Search Logs</h3>
		<form method="post" action="#">
	<!-- form to search log by teacher name -->		
			<div class="form-row">
				<div class="col-sm-2">
					<div class="input-group">
  					<div class="input-group-prepend">
    					<div class="input-group-text"><span class="fas fa-search"></span></div>
  					</div>
  					<input type="text" class="form-control form-control-sm" placeholder="Teacher Name" name="tname">
  					</div>
  				</div>
			
				<div class="input-group mr-2 col-sm-1">
					<input type="submit" class="form-control form-control-sm btn-primary" name="submit" value="List Logs">
				</div>
				<div class="input-group ml-3 col-sm-1">
					<span class="text-dark">OR</span>
				</div>
				<div class="input-group mr-2 col-sm-1">
					<input type="submit" class="form-control form-control-sm btn-primary" name="submit" value="All Logs">
				</div>

			</div>

			
		</form>
	</div>
</body>
</html>

	<?php
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$flag=$_POST['submit'];
		require_once("connect.php");

		if($flag=="List Logs"){
			#grab a specific teacher's log
			
			$tname=$_POST['tname'];

	
			#get logs that are not approved
			$query="SELECT * FROM logsheet where tname='$tname' and status='not approved'";

			#get logs that are approved
			$query2="SELECT * FROM logsheet where tname='$tname' and status='approved'";
	

			$result=mysqli_query($conn,$query);
			$numrows=mysqli_num_rows($result);
			if($numrows>=1){
?>		
				<div id="lognotapprovedbox" class="m-4" style="line-height: 1">
							<table class="table table-dark table-bordered table-striped w-auto">
								<caption class="text-danger ">Logs Not Approved</caption>
								<tr>
									<th>Class taken</th>
									<th>Name</th>
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
										<form method="POST" action="processarchieve.php">
										<input type="number" name="rowid" value="<?php echo $row['id'] ?>" style="visibility: hidden" readonly>	
										<td><?php echo $row['date']; ?></td>
										<td><?php echo $row['tname']; ?></td>
										<td><?php echo $row['subject']; ?></td>
										<td><?php echo $row['topics']; ?></td>
										<td><?php echo $row['class_type']; ?></td>
										<td><?php echo $row['time']; ?></td>
										<td><?php echo $row['nop']; ?></td>
										<td><?php echo $row['nos']; ?></td>
										<td><?php echo $row['remarks']; ?></td>
										<td><?php echo $row['status']; ?></td>
										<td ><button class="btn-primary">Add to Archieve</button></td>
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
?>
			<div class="alert-info">No Data to Show!</div>
<?php
			}

			#approved logs
			$result=mysqli_query($conn,$query2);
			$numrows=mysqli_num_rows($result);
			if($numrows>=1){
	
?>		
			<div id="displaybox" class="m-4" style="line-height: 1">
				<table class="table table-dark table-bordered table-striped w-auto">
					<caption class="text-success">Approved Logs</caption>
						<tr>
							<th>Class taken</th>
							<th>Name</th>
							<th>Subjects</th>
							<th>Topics</th>
							<th>Class Type</th>
							<th>Time</th>
							<th>NOP</th>
							<th>NOS</th>
							<th>Remarks</th>
							<th>Payable</th>
							<th>Status</th>
							<th>Actions</th>
							

						</tr>
<?php				
					while($row=mysqli_fetch_assoc($result)){
?>
					<tr>
						<form method="POST" action="processarchieve.php">
						<input type="number" name="rowid" value="<?php echo $row['id'] ?>" 
						style="visibility: hidden" readonly>
						<td><?php echo $row['date']; ?></td>
						<td><?php echo $row['tname']; ?></td>
						<td><?php echo $row['subject']; ?></td>
						<td><?php echo $row['topics']; ?></td>
						<td><?php echo $row['class_type']; ?></td>
						<td><?php echo $row['time']; ?></td>
						<td><?php echo $row['nop']; ?></td>
						<td><?php echo $row['nos']; ?></td>
						<td><?php echo $row['remarks']; ?></td>
						<td><?php echo $row['payable']; ?></td>
						<td><?php echo $row['status']; ?></td>
						<td ><button class="btn-primary">Add to Archieve</button></td>
						
					</tr>	
<?php 									
					}
?>
				</table>

			</div> 
<?php
			}
			else{
?>
				<div class="alert-info">No Data to Show!</div>
<?php
			}
	}
	else{

		#grab all logs
		#get ALL logs that are not approved
		$query="SELECT * FROM logsheet where status='not approved'";

		#get ALL logs that are approved
		$query2="SELECT * FROM logsheet where status='approved'";
		
		$result=mysqli_query($conn,$query);
		$numrows=mysqli_num_rows($result);
		if($numrows>=1){
?>		
			<div id="lognotapprovedbox" class="m-4" style="line-height: 1">
				<table class="table table-dark table-bordered table-striped w-auto">
					<caption class="text-danger ">Logs Not Approved</caption>
						<tr>
							<th>Class taken</th>
							<th>Name</th>
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
							<form method="POST" action="processarchieve.php">
							<input type="number" name="rowid" value="<?php echo $row['id'] ?>" style="visibility: hidden" readonly>	
							<td><?php echo $row['date']; ?></td>
							<td><?php echo $row['tname']; ?></td>
							<td><?php echo $row['subject']; ?></td>
							<td><?php echo $row['topics']; ?></td>
							<td><?php echo $row['class_type']; ?></td>
							<td><?php echo $row['time']; ?></td>
							<td><?php echo $row['nop']; ?></td>
							<td><?php echo $row['nos']; ?></td>
							<td><?php echo $row['remarks']; ?></td>
							<td><?php echo $row['status']; ?></td>
							<td ><button class="btn-primary">Add to Archieve</button></td>
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
?>
			<div class="alert-info">No Data to Show!</div>
<?php			
		}

		#approved logs
		$result=mysqli_query($conn,$query2);
		$numrows=mysqli_num_rows($result);
		if($numrows>=1){
	
?>		
			<div id="displaybox" class="m-4" style="line-height: 1">
				<table class="table table-dark table-bordered table-striped w-auto">
					<caption class="text-success">Approved Logs</caption>
						<tr>
							<th>Class taken</th>
							<th>Name</th>
							<th>Subjects</th>
							<th>Topics</th>
							<th>Class Type</th>
							<th>Time</th>
							<th>NOP</th>
							<th>NOS</th>
							<th>Remarks</th>
							<th>Payable</th>
							<th>Status</th>
							<th>Actions</th>
							

						</tr>
<?php				
						while($row=mysqli_fetch_assoc($result)){
?>
						<tr>
							<form method="POST" action="processarchieve.php">
							<input type="number" name="rowid" value="<?php echo $row['id'] ?>" style="visibility: hidden" readonly>	
							<td><?php echo $row['date']; ?></td>
							<td><?php echo $row['tname']; ?></td>
							<td><?php echo $row['subject']; ?></td>
							<td><?php echo $row['topics']; ?></td>
							<td><?php echo $row['class_type']; ?></td>
							<td><?php echo $row['time']; ?></td>
							<td><?php echo $row['nop']; ?></td>
							<td><?php echo $row['nos']; ?></td>
							<td><?php echo $row['remarks']; ?></td>
							<td><?php echo $row['payable']; ?></td>
							<td><?php echo $row['status']; ?></td>
							<td ><button class="btn-primary">Add to Archieve</button></td>
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
?>
			<div class="alert-info">No Data to Show!</div>
<?php
		}


	}

	}
	else{
?>		
		<div class="alert-info">Nothing to show here!</div>
<?php
	}
}
else{
	#authentication error!
	header('location: index.php');
}

?>

