<?php #admin page to view logsheeet of all teachers or individual teachers ; view approved and archieved,not approved logs seperatly 

	session_start();
	if(isset($_SESSION['loggedin']) && isset($_SESSION['userhod']) && isset($_SESSION['idhod'])){

?>

<!DOCTYPE html>
<html>
<head>
	<title>View Log Sheet</title>

	<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <script src="https://cdn.rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	
	<script type="text/javascript">
		
       function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
	</script>

	<style type="text/css">
		.search{
			margin-top: 30px;
			margin-left: 10px;
		}
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
		select:hover{
			
			transform: scale(1.1);
		}
		.zmdi-long-arrow-up{
			vertical-align: middle;
			animation: slide1 1s ease-in-out infinite;
		}
		@keyframes slide1 {
		  0%,
		  100% {
		    transform: translate(0, 0);
		  }

		  50% {
		    transform: translate(0, 10px);
		  }
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
	<div class="search">
		<h3><i class="zmdi zmdi-search-in-file"></i> Search Logs</h3>
		<form method="post" action="#">
	<!-- form to search log by teacher name -->		
			<div class="form-row">
				<div class="col-sm-2">
					<div class="input-group">
  					<div class="input-group-prepend">
    					<div class="input-group-text"><i class="zmdi zmdi-account"></i></div>
  					</div>
  					<input type="text" class="form-control form-control-sm" placeholder="Teacher Name" name="tname">
  					</div>
  				</div>
			
				<div class="input-group mr-2 col-sm-2">
					<select class="custom-select custom-select-sm" name="type" required>
						<option value="all" selected>Select Log Type</option>
			 			<option value="not approved">Not Approved</option>
						<option value="approved">Approved</option>
						<option value="archieved">Archieved</option>
						<option value="all">All</option>
					</select>
				</div>
			
				<div class="form-group ml-1 mr-2">
					<input type="date" class="form-control-sm" id="fromdate" name="fromdate">
				</div>
				<div class="form-group">
					<span>To</span>
				</div>
				<div class="form-group ml-2 mr-1">
					<input type="date" class="form-control-sm" id="todate" name="todate">
				</div>
				<div class="input-group mr-1 col-sm-1">
					<input type="submit" class="form-control form-control-sm btn-primary" name="submit" value="Search">
				</div>

			</div>

			
		</form>
	</div>
</body>
</html>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		
		$type=$_POST['type'];
		$from=$_POST['fromdate'];
		$to=$_POST['todate'];

		require_once("connect.php");

		#details of single teacher based on name
		if(!empty($_POST['tname'])){
			$name=$_POST['tname'];
			if($type=='all'){
				#all categories
				$query="SELECT * FROM logsheet WHERE tname='$name' and date between '$from' AND '$to' ORDER BY date DESC";
			}
			else{
				#other specific categories
				$query="SELECT * FROM logsheet WHERE tname='$name' and status='$type'  and date between '$from' AND '$to' ORDER BY date DESC";
			}
		}
		#or details of all teacher
		else{
			if($type=='all'){
				#all categories
				$query="SELECT * FROM logsheet WHERE date between '$from' AND '$to' ORDER BY date DESC";
			}
			else{
				#other specific categories
				$query="SELECT * FROM logsheet WHERE status='$type' and date between '$from' AND '$to' ORDER BY date DESC";
			}
		}	
		$result=mysqli_query($conn,$query);
		$numrows=mysqli_num_rows($result);
		if($numrows>=1){
?>		
				<div id="logbox" class="m-4" style="line-height: 1">
							<table class="table table-dark table-bordered table-striped w-auto" id="tlogs">
								<caption class="text-danger ">Logs-<?php echo $type ?></caption>
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
									<th>Payable</th>
<?php 
#display approval option only if the log is not approved
									if($type=='not approved'){
?>
									<th>Actions</th>	
<?php
									}									
?>									

								</tr>
<?php				
								while($row=mysqli_fetch_assoc($result)){
?>
									<tr>
										<form method="POST" action="approvelog.php">
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
<?php
										if($type=='not approved'){
?>

										<td><div class="form-check form-check-inline">
										  <input class="form-check-input" type="radio" name="pay" id="r1" value="Ontime Pay">
										  <label class="form-check-label" for="r1">ontime pay</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="radio" name="pay" id="r2" value="Offtime Pay">
										  <label class="form-check-label" for="r2">Offtime pay</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="radio" name="pay" id="r3" value="Not Applicable">
										  <label class="form-check-label" for="r3">Not Applicable</label>
										</div>
										</td>
										<td ><button class="btn-primary">Approve Log</button></td>
<?php
										}
										else{
?>
										<td><?php echo $row['payable']; ?></td>
<?php																					
										}				
?>																
										
										</form>
									</tr>	
<?php 									
								}
?>
							</table>
					<button onclick="exportTableToExcel('tlogs','tlogs')">Export Data to Excel</button>
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
?>		
		<!--echo "error in post method!";-->
		<h5 class="text-danger ml-4">Nothing to show here! Search something<i class="zmdi zmdi-long-arrow-up"></i></h5>
<?php
	}	
}
else{
?>	
	<div class="alert-info">Session Error!</div>
<?php	
}
?>	