<?php 
include('session.php');
if(!$session->logged_in && !isset($_GET['n'])){
	header('Location: login.php');
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
			<div class="container">
				<div id="event_bottom">
				<?php 	
						echo 'Event Key-'.$_GET['n'];
						?>
				</div>
			</div><!-- End Display -->
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>