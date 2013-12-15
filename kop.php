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
				if ($_GET['y']<=2013&&$_GET['y']>=1992) {
					echo '<a href="/kop"><--- Back to View Another Year.</a>';
					$database->displayKop($_GET['y']);
				}
				else{
					echo '
					<ul>
					<li><a href="/kop/2013"><img src="/images/2013-Game.jpg">2013 Kit of parts</a></li>
					<li><a href="/kop/2012"><img src="/images/2012-Game.jpg">2012 Kit of parts</a></li>
					<li><a href="/kop/2011"><img src="/images/2011-Game.jpg">2011 Kit of parts</a></li>
					<li><a href="/kop/2010"><img src="/images/2010-Game.jpg">2010 Kit of parts</a></li>
					<li><a href="/kop/2009"><img src="/images/2009-Game.jpg">2009 Kit of parts</a></li>
					</ul>';
				} ?>
			</div><!-- End Display -->
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>