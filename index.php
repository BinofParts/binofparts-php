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
		<?php 	if(isset($_GET['display'])){
					if($_GET['display'] == 'myteam'){
						$database->displayTeam($session->username);
					}				
				} else{
					echo 'This is the homepage.';
					//TODO: Add Homepage Here
				}?>
			</div>
	</div>
</body>
</html>