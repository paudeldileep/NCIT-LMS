<?php
#teacher home page
#accessing page based on already created session variables
	session_start();
	if(isset($_SESSION['loggedin']) && isset($_SESSION['usert']) && isset($_SESSION['idt'])){
		$user=$_SESSION['usert'];
		$id=$_SESSION['idt'];

?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>Teacher-Home</title>
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
			<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

			<style type="text/css">
				#maindiv{
					margin-top: 80px;
					margin-left:20px;
					background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
				}
				#filllogs,#viewlogs,#deletelogs{
					margin-bottom: 20px;
					font-size: 18pt;
					  background: linear-gradient(to bottom right, #ffffff 0%, #0099ff 100%);
					  color:white;
					  text-shadow: 2px 2px 2px rgba(112, 170, 255, 1);
					  font-weight: bold;
					  border: none;
					  outline: none;
					  border-radius: 10px;
			}
			.btn:hover{
				border: 2px solid blue;
				transform: scale(1.1);

			}
				#leftcol{
					
					height:500px;
				}
				h4 a{
					color: red;
					padding-left: 6px;
					font-size: 14px;
				}
				.navbar{
		  			background: linear-gradient(to left, #0099ff 24%, #ccffff 97%);
		  			font-family: bookman;
		  			font-weight: bold;
		  		}
		  		i{
		  			vertical-align: middle;
		  			color: blue;
		  		}

			</style>

		</head>
		<body>
			<!-- header section-->
					<nav class="navbar navbar-dark fixed-top">
		  				<a class="navbar-brand" href="#">
		    			<img src="../images/logo-ncit-lms.png"  height="40" class="d-inline-block align-top" alt="">
		   			
		  				</a>
		  				<div class="navbar-nav ml-auto">
		            		<h4 class="text-dark">Welcome <?php echo $user?><a href="logout.php">log out</a></h4>
		        		</div>

					</nav>
				<!-- two columns one for displaying options as buttons and another one for displaying corresponding web page-->
					<div class="row" id="maindiv">
						<div class="col-2" id="leftcol">
							<h3 class="text-success">Actions</h3>
							<div class="btn-group btn-group-vertical btn-group-justified" style="width: 12em">
							<button type="button" class="btn btn-outline-primary " id="filllogs"><i class="zmdi zmdi-edit "></i> Fill Log</button>
							<button type="button" class="btn btn-outline-primary " id="viewlogs"><i class="zmdi zmdi-view-list-alt "></i>   View Log</button>
							<button type="button" class="btn btn-outline-primary " id="deletelogs"><i class="zmdi zmdi-delete"></i> Delete Log</button>
							</div>
						</div>
						<div class="col-9" id="rightcol">
							<iframe id="dbox"  src="frameindex.html" height="500px" width="1200px"></iframe>
						</div>

					</div>
			<!-- script to toggle content of iframe based on clicked button-->
				<script type="text/javascript">
					$(document).ready(function() {
						$("#filllogs").click(function() {
							/* Act on the event, fill own logs */
							//$("#rightcol").load("viewLog.php");
							$("#dbox").attr('src', 'fillLog.php');
						});
						$("#viewlogs").click(function() {
							/* Act on the event, edit/view own logs */
							//$("#rightcol").load("addteacher.php");
							$("#dbox").attr('src', 'viewtlogs.php');
						});
						$("#deletelogs").click(function() {
							/* Act on the event, view teacher */
							//$("#rightcol").load("addteacher.php");
							$("#dbox").attr('src', 'deleteownlog.php');
						});
					});
				</script>

		</body>
		</html>
<?php
	}
	else{
		#unauthorized access
		header('location: index.php ');
	}

?>
