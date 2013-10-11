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
			<div id="registerbox">
			<form name="register" id="registerform" action="/process.php" method="post">
				<b>Register</b></br>
				<i>Please fill out the information below.</i>
				<hr>
				<label>Team Number:</label><input type="text" name="team" /></br>
				<label>First Name:</label><input type="text" name="namefirst" /></br>
				<label>Last Name:</label><input type="text" name="namelast" /></br>
				<label>Email:</label><input type="text" name="email" /></br>
				<label>Password:</label><input type="password" name="pass" /></br>
				<label>I'm a:</label><select name="type">
				<option value="mentor">Mentor</option>
				<option value="student">Student</option>
				</select></br>
				<input type="hidden" name="subregister" value="1">
				<button type="submit" id="registerbtn" value="Register" />Register</button></br></br>
			</form>
			<div id="bottombox">
				<a name="reg_link" href="/"/>Already a member?</a>
			</div>
			</div>
	</div>
</body>
</html>