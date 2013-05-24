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
				<?php echo 'This is the homepage.';
					//TODO: Add Homepage Here
				?>
			</div>
			<?php include_once("/footer.php"); ?>
	</div>
</body>
</html>