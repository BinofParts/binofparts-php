<?php
include_once("session.php");

include_once("head.php"); ?>
			<div class="container">
				<?php $database->displayEvents(); ?>
			</div><!-- End Display -->
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>