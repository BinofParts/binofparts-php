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
			<?php include_once("sidebar.html"); ?>
			<div id="display">
				<div id="team_top">
				<div id="banner_container"><div id="banner_img"></div></div>
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
			</div>
	</div>
</body>
</html>