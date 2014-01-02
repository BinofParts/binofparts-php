<?php 
include('database.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("head.html"); ?>
</head>
<body>
	<div id="content">
			<?php include_once("sidebar.php"); ?>
			<div class="container">
				<?php 
					$database->displayParts();
				?>
				<a href="#" class="back-to-top visible-xs"><span class="glyphicon glyphicon-arrow-up"></span></a>
			</div>
			<?php include_once("footer.php"); ?>
			<script type="text/javascript">
			$(function(){
			  // get hash value
			  var hash = window.location.hash;
			  // now scroll to element with that id
			  $('html, body').animate({ scrollTop: $(hash).offset().top });
			});
			</script>
	</div>
</body>
</html>