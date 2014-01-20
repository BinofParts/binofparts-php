<?php 
include('session.php');
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
		<div class="container">
			<div class="col-md-8 col-lg-8 col-md-offset-2">
				<?php
				echo '<div id="team_roster">';
				$database->displayTeam($session->useremail);
				echo '</div>';
			?>
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</div>
</body>
</html>