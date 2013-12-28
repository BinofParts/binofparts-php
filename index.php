<?php 
include('database.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("head.html"); ?>
</head>
<body>
	<div id="content">
			<?php include_once("sidebar.php"); ?>
				<?php 
				if ($_GET['y']<=2013&&$_GET['y']>=1992) {
					?><div class="container"><?php
					$database->displayKop($_GET['y']);
					?></div><?php
				}
				else{
					?>
					<div class="jumbotron">
						<div class="container">
							<div class="logo-jumbo row">
							  	<div class="col-sm-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
									<img src="/images/bop-logo-beta-full.png" width="350" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 col-sm-4">
									<img src="/images/FRCicon.gif" height="200" />
								</div>
								<div class="col-xs-6 col-sm-4">
									<img src="/images/FRCicon.gif" height="200" />
								</div>
								<div class="col-xs-6 col-sm-4">
									<img class="hidden-xs" src="/images/FRCicon.gif" height="200" />
								</div>
							</div>
						</div>
					</div>
					<div class="container kop-gamelist">
						<div class="row">
						  <div class="col-xs-12 col-sm-6">
						    <a href="/kop/2013" class="kop-thumb thumbnail"><img class="kop-game" src="/images/2013-Game.jpg" /></a>
						    <a href="/kop/2012" class="kop-thumb thumbnail"><img class="kop-game" src="/images/2012-Game.jpg" /></a>
						  </div>
						  <div class="col-xs-12 col-sm-6 ">
						  	<a href="/kop/2011" class="kop-thumb thumbnail"><img class="kop-game" src="/images/2011-Game.jpg" /></a>
						  	<a href="/kop/2010" class="kop-thumb thumbnail"><img class="kop-game" src="/images/2010-Game.jpg" /></a>
							<a href="/kop/2009" class="kop-thumb thumbnail"><img class="kop-game" src="/images/2009-Game.jpg" /></a>
						  </div>
						</div>
					</div>
					<?php
				} ?>
			<?php include_once("footer.php"); ?>
			<script type="text/javascript">
			$(function(){
			  // get hash value
			  var hash = window.location.hash;
			  // now scroll to element with that id
			  $('html, body').animate({ scrollTop: $(hash).offset().top });
			});
			</script>
	</div>
</body>
</html>