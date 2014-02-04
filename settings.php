<?php
include_once("session.php");
if(!$session->logged_in){
	header('Location: /');
}

include_once("head.php"); ?>
			This is the settings page.	<a href="/admin">Admin Panel</a>
			<?php include_once("footer.php"); ?>
	</div>
</body>
</html>