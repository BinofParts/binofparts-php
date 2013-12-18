<?php 
include('session.php');
if(!$session->logged_in || $session->admin != 'Y'){
	header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("../head.html"); ?>
</head>
<body>
	<div id="content">
			<?php include_once("../sidebar.php"); ?>
			<div id="display">
			  Welcome to the admin page!</br> 
			<?php echo $session->name;?></br>
			<?php echo $session->type;?> for <?php echo $session->team;?>
			
			</br></br></br>type team number to update it.
			<form method="post" action="../tests/updateteam.php">
			    <input type="text" name="team">
			    <input type="submit" value="click" name="submit"> <!-- assign a name for the button -->
			</form>
			
			<a>Team database last updated:</a> <?php $database->checkTeamsLastUpdated();?>
			</br><a>Event database last updated:</a> <?php $database->checkEventsLastUpdated();?>
			</div>
	</div>
</body>
</html>