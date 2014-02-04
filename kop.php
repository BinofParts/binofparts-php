<?php
include_once("session.php");

include_once("head.php"); ?>
			<?php 
			if ($_GET['y']<=2013 && $_GET['y']>=1992) { ?>
				<div class="container">
				<?php $database->displayKop($_GET['y']);
					$mixpanel->identify($session->useremail);
					$mixpanel->track("displayKop", array("year" => $_GET['y']));
				 ?>
					<a href="#" class="back-to-top visible-xs"><span class="glyphicon glyphicon-arrow-up"></span></a>
				</div><?php
			}
			else{ ?>
				<div class="jumbotron">
					<div class="container">
						<div class="row">
							<div class="col-sm-4 hidden-xs">
								<a target="_blank" href="http://www.usfirst.org/roboticsprograms/frc"><img class="FRCicon" src="/images/FRCicon.gif" /></a>
							</div>
							<div class="col-sm-4">
								<h2>Kickoff 2014</h2>
								<a role="button" class="btn btn-default btn-block btn-lg disabled" href="">View 2014 Kit of Parts</a>
								<p>Come back on January 4th, 2014 to view this years Kit of Parts.</p>
							</div>
							<div class="col-sm-4 tba">
								<i>Team & Event Data Provided By</i>
								<div class="tba-logo"><a target="_blank" href="http://thebluealliance.com"><img src="/images/tba_lamp.png" /> The Blue Alliance</a></div>

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
			} 
		 include_once("footer.php"); ?>
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