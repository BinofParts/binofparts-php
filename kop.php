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
			<div class="container">
				<?php 
				if ($_GET['y']<=2013&&$_GET['y']>=1992) {
					echo '<a href="/kop"><--- Back to View Another Year.</a>';
					$database->displayKop($_GET['y']);
				}
				else{
					?>
					<div class="row">
					  <div class="col-xs-12 col-sm-6">
					    <a href="/kop/2013" class="thumbnail"><img class="kop-game" src="/images/2013-Game.jpg" /></a>
					    <a href="/kop/2012" class="thumbnail"><img class="kop-game" src="/images/2012-Game.jpg" /></a>
					  </div>
					  <div class="col-xs-12 col-sm-6 ">
					  	<a href="/kop/2011" class="thumbnail"><img class="kop-game" src="/images/2011-Game.jpg" /></a>
					  	<a href="/kop/2010" class="thumbnail"><img class="kop-game" src="/images/2010-Game.jpg" /></a>
						<a href="/kop/2009" class="thumbnail"><img class="kop-game" src="/images/2009-Game.jpg" /></a>
					  </div>
					</div>
					<?php
				} ?>
			</div>
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>