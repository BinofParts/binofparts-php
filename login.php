<?php 
include('session.php');
if($session->logged_in){
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<?php include_once("head.html"); ?>
<body>
	<div id="content">
		<div class="container">
			<div class="row">
				<div id="loginbox">
				<div id="login-logo"><img src="images/bop-logo-beta-full.png" alt="BoP Logo" width="300"></div>
					<form name="login" id="loginform" role="form" action="form_action.php" method="post">
						<?php 
							if(isset($_SESSION['error'])){
								echo '<div id="error-box">'.
								$_SESSION['error'].'</div>';
							}
							unset($_SESSION['error']);
								?>
						<div class="form-group">
							<div class="col-md-12">
								<input type="email" class="form-control" name="email" placeholder="Email" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input type="password" class="form-control" name="pass" placeholder="Password" />
							</div>
						</div>
						<!-- <div class="form-group">
								<div class="checkbox">
								    <label>
								      <input type="checkbox" id="checkbox" name="remember"/> Keep me logged in.
								    </label>
							  	</div>
						</div> -->
						<input name="action" id="action" value="login" type="hidden">
						<button type="submit" id="loginbtn" value="Login"/>Login</button>
					</form>
					<div id="bottombox"><i>Don't have an account?</i><a id="reg-link" href="register.php"/>Register</a></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>