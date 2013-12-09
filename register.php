<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("head.html"); ?>
</head>
<body>
	<div id="content">
			<div id="background">
			    <!--<img src="102_0273.jpg" alt="" width="1600px" height="1200px"/>-->
			</div>
			<div class="register-logo"><img src="images/bop-logo-beta-full.png" alt="BoP Logo" width="300"></div>
			<div id="registerbox">
			<form name="register" id="registerform" action="process.php" method="post">
				<b>Register</b></br>
				<i>Please fill out the information below.</i>
				
				<div id="register-top"></div>
				<?php 
					if(isset($_SESSION['error'])){
						echo '<div id="error-box">'.
						$_SESSION['error'].'</div>';
					}
					unset($_SESSION['error']);
				?>
				<label>Team Number:</label><input type="text" name="team" value="<?php echo $_SESSION['team'];?>" /></br>
				<label>First Name:</label><input type="text" name="namefirst" value="<?php echo $_SESSION['namefirst'];?>" /></br>
				<label>Last Name:</label><input type="text" name="namelast" value="<?php echo $_SESSION['namelast'];?>" /></br>
				<label>Email:</label><input type="text" name="email" value="<?php echo $_SESSION['email'];?>" /></br>
				<label>Password:</label><input type="password" name="pass" /></br>
				<label>I'm a:</label><select name="type">
				<option value="student">Student</option>
				<option value="mentor">Mentor</option>
				</select></br>
				<input type="hidden" name="subregister" value="1">
				<button type="submit" id="registerbtn" value="Register" />Register</button></br></br>
			</form>
			<?php 
				unset($_SESSION['team']);
				unset($_SESSION['namefirst']);
				unset($_SESSION['namelast']);
				unset($_SESSION['email']);
			?>
			<div id="bottombox">
				<i>Already have an account?</i><a name="reg_link" href="login.php"/>Login</a>
			</div>
			</div>
	</div>
</body>
</html>