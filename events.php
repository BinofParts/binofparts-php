<?php 
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("head.html"); ?>
</head>
<body>
	<div id="content">
			<?php include_once("sidebar.html"); ?>
			<div id="display">
			<?php $database->displayEvents(); ?>
			</div>
	</div>
</body>
</html>