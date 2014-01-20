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
			<?php include_once("navbar.php"); ?>
			This is the settings page.	<a href="/admin">Admin Panel</a>
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>