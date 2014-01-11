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
		<div id="loginbox">
			<div id="login-logo"><img src="/images/bop-logo-beta-full.png" alt="BoP Logo" width="300"></div>
			<form name="register" id="loginform" action="form_action.php" method="post">
				<?php 
					if(isset($_SESSION['error'])){
						echo '<div class="col-md-12"><div class="alert alert-danger">'.
						$_SESSION['error'].'</div></div>';
					}
					unset($_SESSION['error']);
				?>
				<div class="form-group">
					<div class="col-md-12">
						<input type="text" name="team" value="<?php echo $_SESSION['team'];?>" placeholder="Team Number"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input type="text" name="namefirst" value="<?php echo $_SESSION['namefirst'];?>" placeholder="First Name" />
					</div>
					<div class="col-md-12">
						<input type="text" name="namelast" value="<?php echo $_SESSION['namelast'];?>" placeholder="Last Name" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input type="text" name="email" value="<?php echo $_SESSION['email'];?>" placeholder="Email" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input type="password" name="pass" placeholder="Password" />
					</div>
				</div>
				<select name="type">
				<option value="student">Student</option>
				<option value="mentor">Mentor</option>
				</select></br>
				<input name="action" id="action" value="register" type="hidden">
				<button type="submit" id="loginbtn" value="Register" />Register</button></br></br>
			</form>
			<?php 
				unset($_SESSION['team']);
				unset($_SESSION['namefirst']);
				unset($_SESSION['namelast']);
				unset($_SESSION['email']);
			?>
		</div>
	</div>
</body>
</html>