<?php
include_once("session.php");
if(!$session->logged_in){
	header('Location: /');
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("head.html"); ?>
</head>
<body>
	<div id="content">
			<?php include_once("sidebar.php"); ?>
			<div id="change"><?php $database->displayLiveFeed();?></div>	
			<?php include_once("footer.php"); ?>
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
			},5000);
			</script>
</body>
</html>