<?php 
include_once('../session.php');
if(!$session->logged_in){
	header('Location: ../login.php');
	exit;
}

include_once("../head.php"); ?>
			<div id="display">
			
			</br></br></br>type team number to update it.
			<form method="post" action="../tests/updateteam.php">
			    <input type="text" name="team">
			    <input type="submit" value="update" name="submit"> <!-- assign a name for the button -->
			</form>
			
			<a>Team database last updated:</a> <?php $database->checkTeamsLastUpdated();?>
			</br><a>Event database last updated:</a> <?php $database->checkEventsLastUpdated();?>
			</div>
			<!-- <script src="https://code.jquery.com/jquery.js"></script>
			<script src="../js/bootstrap.min.js"></script>
			<script src="../js/bootstrap3-typeahead.min.js"></script>

			<script type="text/javascript">
			$(document).ready(function() {
			  $('input.typeahead').typeahead({
			    source: function (query, process) {
			      $.ajax({
			        url: '../search.php',
			        type: 'GET',
			        dataType: 'JSON',
			        data: 'q=' + query,
			        success: function(data) {
			          process(data);
			        }
			      });
			    }
			  });
			});
			</script> -->
			<script src="https://code.jquery.com/jquery.js"></script>
			<script src="../js/bootstrap.min.js"></script>
	</div>
</body>
</html>