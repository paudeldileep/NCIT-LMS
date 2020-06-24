<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <script src="https://cdn.rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script>
</head>
<body>



<?php

	require_once("connect.php");
	$query="SELECT * FROM logsheet where teacher_id=501";
	$result=mysqli_query($conn,$query);
	if($result){
?>		
		<div id="dbox" class="m-4" style="line-height: 1">
					<table class="table table-dark table-bordered table-striped w-auto" id="testtable">
						<tr>
							<th>Date</th>
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
					$formid=$row['id'];
?>
					<tr >
						<form id="<?php echo $row['id'] ?>" method="post" onsubmit="update(this.id,event)">
						<input type="number" name="rowid" value="<?php echo $row['id'] ?>" style="visibility: hidden"
						>	
						<td><?php echo $row['date']; ?></td>
						<td><input type="text" class="form-control" name="sub" value="<?php echo $row['subject']; ?>"></td>
						<td><input class="form-control" type="text" name="topics" value="<?php echo $row['topics']; ?>"></td>
						<td><input class="form-control" type="text" style="width:3em " name="ctype" value="<?php echo $row['class_type']; ?>"></td>
						<td><input class="form-control" type="text" name="time" value="<?php echo $row['time']; ?>"></td>
						<td><input class="form-control" type="number" style="width:3em " name="nop" value="<?php echo $row['nop']; ?>"></td>
						<td><input class="form-control" type="number" name="nos" style="width:5em " value="<?php echo $row['nos']; ?>"></td>
						<td><input class="form-control" name="remarks" value="<?php echo $row['remarks']; ?>"></td>
						<td><?php echo $row['status']; ?></td>
						<td ><input class="form-control btn-primary" type="submit" name="subform" value="update Log"></td>
						</form>
					</tr>	
<?php 									
				}
?>
					</table>
					<button onclick="exportTableToExcel('testtable')">Export Table Data To Excel File</button>
				</div> 
<?php
		}
		else{
			echo "no data to show";
		}

?>
<script type="text/javascript">
	

		function update(formid, event){
   
    var formid="#"+formid;
    
    var serializedData = $(formid).serialize();


    $.ajax({
					url:'testupdatelog.php',
					type:'POST',
					data:serializedData,
					//dataType:'text',
					success: function () {
              			alert('log updated');
           			 }
				});
    event.preventDefault();
    /*reload pg*/

}

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

</body>
</html>