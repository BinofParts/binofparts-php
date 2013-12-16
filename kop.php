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
					    <a href="/kop/2013" class="thumbnail"><img class="kop-game" src="/images/2013-Game.jpg" />
						    <div class="caption">
						        <h3>2013 Kit of Parts</h3>
						    </div>
				      	</a>
					    <a href="/kop/2012" class="thumbnail"><img class="kop-game" src="/images/2012-Game.jpg" />
					    	<div class="caption">
						        <h2>2012 Kit of Parts</h2>
						    </div>
					    </a>
					  </div>
					  <div class="col-xs-12 col-sm-6 ">
					  	<a href="/kop/2011" class="thumbnail"><img class="kop-game" src="/images/2011-Game.jpg" />
					  		<div class="caption">
						        <h2>2011 Kit of Parts</h2>
						    </div>
					  	</a>
					  	<a href="/kop/2010" class="thumbnail"><img class="kop-game" src="/images/2010-Game.jpg" />
					  		<div class="caption">
						        <h2>2010 Kit of Parts</h2>
						    </div>
					  	</a>
						<a href="/kop/2009" class="thumbnail"><img class="kop-game" src="/images/2009-Game.jpg" />
							<div class="caption">
						        <h2>2009 Kit of Parts</h2>
						    </div>
						</a>
					  </div>
					</div>
					<?php
				} ?>
			</div>
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>