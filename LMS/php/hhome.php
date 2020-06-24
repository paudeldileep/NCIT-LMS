<?php
	#admin homepage
	#checking session values and only then display contents or redirect to index page
	session_start();
	if(isset($_SESSION['loggedin']) && isset($_SESSION['userhod']) && isset($_SESSION['idhod'])){
		$user=$_SESSION['userhod'];
		$id=$_SESSION['idhod'];

?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>HOD-Home</title>
			<script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous">
			  </script>
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
			
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
			<style type="text/css">
				#maindiv{
					margin-top: 80px;
					margin-left:20px;
					background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
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
		  		.btn{
		  			font-size: 14pt;
					  background: linear-gradient(to bottom right, #ffffff 0%, #0099ff 100%);
					  color:white;
					  text-shadow: 2px 2px 2px rgba(112, 170, 255, 1);
					  font-weight: bold;
					  margin-bottom: 10px;
		  		}
		  		#viewlogs,#editlogs,#deletelogs,#undodelete,#sortlogs,#addt,#removet,#asub{
		  			  border-radius: 10px;
		  		}
		  		.btn-group button:hover {
				  border-color: #C70039;
				  transform: scale(1.1);
				}
				i{
					vertical-align: middle;
					color:blue;
				}

			</style>

		</head>
		<body>
				<!-- header section -->
					<nav class="navbar navbar-dark fixed-top">
		  				<a class="navbar-brand" href="#">
		    			<img src="../images/logo-ncit-lms.png" height="40" class="d-inline-block align-top" alt="">
		  				</a>
		  				<div class="navbar-nav ml-auto">
		            		<h4 class="text-dark">Welcome <?php echo $user?><a href="logout.php">log out</a></h4>
		        		</div>

					</nav>
				<!--dividing into 2 rows, one for available options and other one for displaying corresponding page-->
					<div class="row" id="maindiv">
						<div class="col-2" id="leftcol">
							<h3 class="text-white ml-5">Actions</h3>
							<div class="btn-group btn-group-vertical" style="width: 12em;text-align: left;padding-left: 0px;">
							<button type="button" class="btn btn-outline-primary btn-dark" id="viewlogs"><i class="zmdi zmdi-view-list-alt "></i> View Logs</button>
							<button type="button" class="btn btn-outline-primary btn-dark" id="editlogs"><i class="zmdi zmdi-edit"></i> Edit Logs</button>
							<button type="button" class="btn btn-outline-primary btn-dark" id="sortlogs"><i class="zmdi zmdi-swap-vertical"></i> Sort Logs</button>
							<button type="button" class="btn btn-outline-primary btn-dark" id="addt"><i class="zmdi zmdi-account-add"></i> Add Teachers</button>
							<button type="button" class="btn btn-outline-primary btn-dark" id="asub"><i class="zmdi zmdi-text-format"></i> Assign Subjects</button>
							<button type="button" class="btn btn-outline-primary btn-dark" id="deletelogs"><i class="zmdi zmdi-delete"></i> Archieve Logs</button>
							<button type="button" class="btn btn-outline-primary btn-dark" id="undodelete"><i class="zmdi zmdi-undo"></i> Restore Archieves</button>
							<button type="button" class="btn btn-outline-primary btn-dark" id="removet"><i class="zmdi zmdi-delete"></i> Remove Teachers</button>
							
							</div>
						</div>
				<!-- iframe to display corresponding page on button click-->
						<div class="col-10" id="rightcol">
							<iframe id="dbox" src="frameindex.html" height="600px" width="1000px"></iframe>
						</div>

					</div>

				<!-- script to change content of iframe on clicking specific button-->
				<script type="text/javascript">
					$(document).ready(function() {
						$("#viewlogs").click(function() {
							/* Act on the event, view logs */
							//$("#rightcol").load("viewLog.php");
							$("#dbox").attr('src', 'viewAllLogs.php');
						});
						$("#editlogs").click(function() {
							/* Act on the event, edit logs */
							//$("#rightcol").load("addteacher.php");
							$("#dbox").attr('src', 'edittlogs.php');
						});
						$("#deletelogs").click(function() {
							/* Act on the event, edit logs */
							//$("#rightcol").load("addteacher.php");
							$("#dbox").attr('src', 'ArchieveLog.php');
						});
						$("#undodelete").click(function () {
                            $("#dbox").attr('src','undoArchieve.php');
                        });
						$("#sortlogs").click(function() {
							/* Act on the event, edit logs */
							//$("#rightcol").load("addteacher.php");
							$("#dbox").attr('src', 'sortLogs.php');
						});
						$("#removet").click(function() {
							/* Act on the event, view teacher */
							//$("#rightcol").load("addteacher.php");
							$("#dbox").attr('src', 'removeteacher.php');
						});
						$("#addt").click(function() {
							/* Act on the event, add teacher */
							//$("#rightcol").load("addteacher.php");
							$("#dbox").attr('src', 'addteacher.php');
						});
						$("#asub").click(function() {
							/* Act on the event , assign subjects*/
							//$("#rightcol").load("addteacher.php");
							$("#dbox").attr('src', 'assignsubjects.php');
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
