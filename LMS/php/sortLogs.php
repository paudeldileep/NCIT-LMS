<?php
#sort logs of all teacher or a single teacher ..

	session_start();
	if(isset($_SESSION['loggedin']) && isset($_SESSION['userhod']) && isset($_SESSION['idhod'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<style type="text/css">
		caption{
			caption-side: top;
		}
		body{
			background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
		}
		input{
			border:none;
			outline: none;
		}
		input:hover{
			border-color: #117bc2;
			transform: scale(1.1);
		}
	
	</style>
</head>
<body>
<div class="mt-4 ml-3">
	<h3 class="ml-2"><i class="zmdi zmdi-search-in-file"></i> Search Logs</h3>
	<form class="form-inline mt-1" method="post" action="#">
		<div class="col-sm-3">
					<div class="input-group">
  					<div class="input-group-prepend">
    					<div class="input-group-text"><i class="zmdi zmdi-account"></i></div>
  					</div>
  					<input type="text" class="form-control form-control-sm" placeholder="Teacher Name" name="tname">
  					</div>
  		</div>
			
		<div class="form-group ml-3 mr-3">
			<label for="fromdate">From:</label>
			<input type="date" class="form-control ml-1" id="fromdate" name="fromdate">
		</div>
		<div class="form-group ml-3 mr-3">
			<label for="todate">To:</label>
			<input type="date" class="form-control ml-1" id="todate" name="todate">
		</div>
		<div class="form-group">
			<input type="submit" class="form-control btn-primary btn-sm" value="Search">
		</div>
	</form>
</div>
</body>
</html>
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
require_once("connect.php");

$from=$_POST['fromdate'];
$to=$_POST['todate'];
if(!empty($_POST['tname'])){

	#if teacher name given then fetch specific teachers logs

	$name=$_POST['tname'];
	$query="SELECT * FROM logsheet WHERE tname='$name' and date between '$from' AND '$to' ORDER BY date DESC";
}
else{
	#select all logs
	$query="SELECT * FROM logsheet WHERE date between '$from' AND '$to' ORDER BY date DESC";
}	
#for current month
#$query="SELECT * FROM logsheet WHERE date between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()";

#last 7 days
#$query="SELECT * FROM logsheet WHERE date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY date DESC";

#current week ,sunday to sunday
#$query="SELECT * FROM logsheet WHERE yearweek(DATE(date)) = yearweek(curdate()) ORDER BY date DESC";

$result=mysqli_query($conn,$query);
		if($result){
	
?>		
		<div id="displaybox" class="m-4" style="line-height: 1">
					<table class="table table-dark table-bordered table-striped w-auto">
						<caption class="text-success">Search Result</caption>
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
							

						</tr>
<?php				
				while($row=mysqli_fetch_assoc($result)){
?>
					<tr>
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
}
else{
	
}	
}else{
	header('location:index.php');
}	
?>		