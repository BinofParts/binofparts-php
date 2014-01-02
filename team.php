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
			<div class="container">
				<div id="team_top">
				<div id="banner_container"><div id="banner_img" style="background-image: url(/upload/teambanners/1612.png);
					background-position: center bottom, left top;
					background-repeat: no-repeat;"></div></div>
				</div>
				<div id="team_bottom">
				<?php 	if(!isset($_GET['n'])){
								echo '<div id="team_roster">';
								$database->displayTeam($session->username);
								echo '</div>';
						} else{
							echo 'Recent posts and team profile info here.';
						}?>
				</div>
			</div><!-- End Display -->
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>