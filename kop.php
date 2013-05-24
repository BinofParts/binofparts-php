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
			<?php include_once("sidebar.php"); ?>
			<div id="display">
			<?php 
			if ($_GET['y']<=2012&&$_GET['y']>=1992) {
				echo '<a href="kop"><--- Back to View Another Year.</a>';
				$database->displayKop($_GET['y']);
			}
			else{
				echo 'Please select a year to view the kit of parts from that year.</br>
				<ul>
				<li><a href="kop/2012">2012 Kit of parts</a></li>
				<li><a href="kop/2011">2011 Kit of parts</a></li>
				<li><a href="kop/2010">2010 Kit of parts</a></li>
				<li><a href="kop/2009">2009 Kit of parts</a></li>
				<li><a href="kop/2008">2008 Kit of parts</a></li>
				<li><a href="kop/2007">2007 Kit of parts</a></li>
				</ul>';
			} ?>
			
			</div>
	</div>
</body>
</html>