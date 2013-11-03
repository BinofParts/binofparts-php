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
			<div id="background">
			
			</div>
			<div class="login-logo"><img src="/images/bop-logo-beta-full.png" alt="BoP Logo" width="300"></div>
			<div id="loginbox">
			<form name="login" id="loginform" action="process.php" method="post">
				<?php 
					if(isset($_SESSION['error'])){
						echo '<div id="error-box">'.
						$_SESSION['error'].'</div>';
					}
					unset($_SESSION['error']);
						?>
				<label>Email:</label><input class="input" type="text" name="email" /></br>
				<label>Password:</label><input type="password" name="pass" /></br>
				<input type="checkbox" id="checkbox" name="remember"/><label for="checkbox" id="checkboxlabel">Keep me logged in.</label></br>
				<input type="hidden" name="sublogin" value="1">
				<button type="submit" id="loginbtn" value="Login"/>Login</button></br>
			</form>
			<div id="bottomboxlogin"><i>Don't have an account?</i><a id="reg-link" href="register.php"/>Register</a></div>
			</div>
	</div>
</body>
</html>