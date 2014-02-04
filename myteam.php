<?php
include_once("session.php");

include_once("head.php"); ?>
		<div class="container">
			<div class="col-md-8 col-lg-8 col-md-offset-2">
				<?php
				echo '<div id="team_roster">';
				$database->displayTeam($session->useremail);
				echo '</div>';
			?>
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</div>
</body>
</html>