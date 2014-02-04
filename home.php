<?php
include_once("session.php");
if(!$session->logged_in){
	header('Location: /');
}

include_once("head.php");
?>
		<div id="change"><?php $database->displayLiveFeed('0');?></div>	
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
	</div>
</body>
</html>