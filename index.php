<?php 
include('session.php');
if(!$session->logged_in){
	header('Location: kop.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("head.html"); ?>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
	setInterval(function() {
		var latestid = $("#change div:first-child").attr("id");
	   	$.ajax({
		        url: 'ajax.php',
		        data: 'last=' +latestid,
				type: 'POST',
		        cache: true,
		        success: function(response) {
					if(response){
						$('#change').prepend(response);
					}
		        }
		    });
	},10000);
	</script>
</head>
<body>
	<div id="content">
		<?php include_once("sidebar.php"); ?>			
		<div class="container">
			<div id="change"><?php $database->displayLiveFeed();?></div>
		</div><!-- End Display -->
		<?php include_once("footer.php"); ?>
	</div>
</body>
</html>