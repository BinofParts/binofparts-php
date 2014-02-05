<?php 
include_once('../session.php');
if(!$session->logged_in && $session->admin != true){
	header('Location: ../login.php');
	exit;
}

include_once("../head.php"); ?>
			<div class="container">
			<?php
			if(isset($_SESSION['error'])){
				echo '<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
				$_SESSION['error'].'</div></div>';
			}
			else if(isset($_SESSION['success'])){
				echo '<div class="col-md-12"><div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
				$_SESSION['success'].'</div></div>';
			}
			unset($_SESSION['success']);
			unset($_SESSION['error']);?>
			
			</br></br></br>type team number to update it.
			<form method="post" action="updateteam.php">
			    <input type="text" name="team">
			    <input type="submit" value="update" name="submit"> 
			</form>
			
			<a>Team database last updated:</a> <?php $database->checkTeamsLastUpdated();?>
			</br><a>Event database last updated:</a> <?php $database->checkEventsLastUpdated();?>

			<!-- TODO: add privilages for admins. -->
			<p>Add New Admin</p>
			<form method="post" action="newadmin.php">
			    <input type="text" name="email">
			    <input type="submit" value="add" name="submit"> 
			</form>

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