<?php 
include('session.php');
//This is the only page that can be viewed when not logged in.
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("head.html"); ?>
</head>
<body>
	<div id="content">
			<div id="sidebar">
<?php if($session->logged_in){ ?>
				<ul>
					<li><a href="/">Home<a></li>
					<li><a href="/feed.php">Parts Feed<a></li>
					<li><a href="">Inventory</a></li>
					<li><a href="/myteam">My Team</a></li>
					<li><a href="/kop">Kit of Parts</a></li>
					<li><a href="/events.php">Teams</a></li>
					<li><a href="/events.php">Events<a></li>
					<li><a href="/settings.php">Settings<a></li>
				</ul>
				<ul id="sidebar-bottom">
					<li><a href="/process.php">Logout<a></li>
				</ul>
<?php }else{?>
				<ul>
					<li><a href="/">Login</a></li>
					<li><a href="/kop">Kit of Parts</a></li>
					<li><a href="/events.php">Events<a></li>
				</ul>
<?php }?>
			</div>
			<div id="display">
			<?php 
			if ($_GET['y']<=2012&&$_GET['y']>=1992) {
				echo '<a href="/kop"><--- Back to View Another Year.</a>';
				$database->displayKop($_GET['y']);
			}
			else{
				echo 'Please select a year to view the kit of parts from that year.</br>
				<ul>
				<li><a href="/kop/2012">2012 Kit of parts</a></li>
				<li><a href="/kop/2011">2011 Kit of parts</a></li>
				<li><a href="/kop/2010">2010 Kit of parts</a></li>
				<li><a href="/kop/2009">2009 Kit of parts</a></li>
				<li><a href="/kop/2008">2008 Kit of parts</a></li>
				<li><a href="/kop/2007">2007 Kit of parts</a></li>
				</ul>';
			} ?>
			
			</div>
	</div>
</body>
</html>