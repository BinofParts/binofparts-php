<?php 
include('session.php');

include_once("head.php"); ?>
			<div class="container">
				<?php $database->displayTeamList(); ?>
			</div><!-- End Display -->
			<a href="#" class="back-to-top visible-xs"><span class="glyphicon glyphicon-arrow-up"></span></a>
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>