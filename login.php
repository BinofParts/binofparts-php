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
			<div id="loginbox">
			<form name="login" id="loginform" action="process.php" method="post">
				<b>Login</b>
				<hr>
				<label>Email:</label><input class="input" type="text" name="email" /></br>
				<label>Password:</label><input type="password" name="pass" /></br>
				<input type="checkbox" id="checkbox" name="remember"/><label for="checkbox" id="checkboxlabel">Keep me logged in.</label></br>
				<input type="hidden" name="sublogin" value="1">
				<button type="submit" id="loginbtn" value="Login"/>Login</button></br>
			</form>
			<div id="bottomboxlogin"><a name="reg_link" href="register.php"/>Register</a></div>
			</div>
	</div>
</body>
</html>