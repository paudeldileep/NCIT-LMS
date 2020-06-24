<html>
	<head>
		<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
	</head>
	<body>
<div class="justify-content-center" id="viewlogsbox">
				
					<input type="text" class="form-control form-control-sm" id="teacherid" name="teacherid" value="301" style="visibility: hidden">
				
				<div class="form-group mr-2 col-xs-2 mt-2">
					<!--<button class="btn-sm btn-primary" id="viewlogs">View My Logs</button>-->
					<input type="button" name="submit" class="btn-sm btn-primary" id="submitb" value="view my logs">
				</div>
		
		</div>
		<div id="show_logs" class="justify-content-center">
		</div>
	</div>

	
	<script type="text/javascript" >
		$(document).ready(function(){

			$('#submitb').click(function(e){
				e.preventDefault();

				var tid= $('#teacherid').val();
				alert(tid);
				$.ajax({
					url:'testajax2.php',
					type:'POST',
					data:{'tdata':tid},
					//dataType:'text',
					success: function () {
              			alert('form was submitted'+tid);
           			 }
				});
			});
		});	
	</script>	

</body>
</html>		