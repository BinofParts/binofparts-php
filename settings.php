<?php 
include('session.php');
if(!$session->logged_in){
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
			<div id="display">
			 	This will be the settings page.
				<?php if($session->admin == 'Y'){
					echo '<a href="/admin">Admin Page</a>';
				}?>
			</div><!-- End Display -->
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>