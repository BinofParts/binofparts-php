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
			This is the settings page.	
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>