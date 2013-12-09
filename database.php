<?
/**
 * This will take care of anything that requires a database connection.
 * This should only be included on session scripts.
 * This class is all gimme gimme gimme.. You cant always get what you want!
 */

//error_reporting(0);

include("bcrypt.php");

session_start();

class Database
{
	/**
	 * Class variables.
	 */
	private $dbhost = 'localhost';
	private $dbname = 'robotics';
	private $dbuser = 'aaron';
	private $dbpass = 'password';
	private $link;
	function Database(){
		$this->link = mysqli_init();
		mysqli_real_connect($this->link, $this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
	}
	//prevent injection
    function qry($query) {
      $args  = func_get_args();
      $query = array_shift($args);
      $query = str_replace("?", "%s", $query);
      $args  = array_map('mysqli_real_escape_string', $args);
      array_unshift($args,$query);
      $query = call_user_func_array('sprintf',$args);
      $result = mysqli_query($this->link, $query) or die(mysqli_error());
          if($result){
            return $result;
          }else{
             $error = "Error";
             return $result;
          }
    }
    #--------->Login/Register/Forgot Password<---------#
    function login($email, $pass){		

		if(empty($email) || empty($pass)){
			$_SESSION['error'] = "All fields are required. ";
			return false;
		}
		else{

			$passwordcheck = $this->checkPassword($email, $pass);
			
			if($passwordcheck != 0){
				if($passwordcheck == 1){
					$_SESSION['error'] = "Sorry, that email is not registered.";
					return false;
				}else if($passwordcheck == 2){
					$_SESSION['error'] = "That password was incorrect.";
					return false;
				}else if($passwordcheck == 3){
					$_SESSION['error'] = "Your account was declined access. Please contact the lead mentor for your team if this is an error.";
					return false;
				}else if($passwordcheck == 4){
					$_SESSION['error'] = "Your account has been disabled. If this is an error please contact us at info(at)binofparts.com";
					return false;
				}else if($passwordcheck == 5){
					$_SESSION['error'] = "Your account is currently not verified. Please contact your teams lead mentor.";
					return false;
				}else{
					$_SESSION['error'] = "Something went wrong while trying to login.";
					return false;
				}
			}else{
				if(isset($_COOKIE['username'])){
				   setcookie("username", "", mktime()-300, "/");
				}
				unset($_SESSION['username']);

				//TODO:
				//check if user is verified before logging them in... add another password check in database file
				//if not verified send to an unverified page
				//handle disabled and unverified accounts on this separate page. Display message on how to fix it, ie. contact us or get lead mentor to verify them.


				$_SESSION['username'] = $email;
				
				if (isset($_POST['remember'])){
					setcookie("username", $email, mktime()+86400, "/");
				}

				return true;
			}
		}
	}
	function newpassword(){
		global $database;
		
		//compare password fields
		if ($_POST['password1'] == $_POST['password2']){
			$password = $database->createPassword($_POST['password1']);
			$database->updatePassword($password, $_SESSION['username']); 
		}
		else if(empty($_POST['password1']) == $_POST['password2']){
			
		}
		else{
			//set session variable for error message
		}
		header('Location: settings.php');
	}
	function passreset(){
		global $database, $mailer;
		
		$exist = $database->checkEmailExist($_POST['temail']);
		if($exist){
			$mailer->sendResetLink($_POST['temail']);
			$_SESSION['error'] = false;
		}
		else{
			$_SESSION['error'] = true;
		}
		$to = stripslashes($username);
        //some injection protection
        $illegals=array("%0A","%0D","%0a","%0d","bcc:","Content-Type","BCC:","Bcc:","Cc:","CC:","TO:","To:","cc:","to:");
        $to = str_replace($illegals, "", $to);
        $getemail = explode("@",$to);
 
        //send only if there is one email
        if(sizeof($getemail) > 2){
            return false;
        }else{
            //send email
            $from = $_SERVER['SERVER_NAME'];
            $subject = "Password Reset: ".$_SERVER['SERVER_NAME'];
            $msg = "
 
Your new password is: ".$newpassword."
 
";
 
            //now we need to set mail headers
            $headers = "MIME-Version: 1.0 rn" ;
            $headers .= "Content-Type: text/html; \r\n" ;
            $headers .= "From: $from  \r\n" ;
 
            //now we are ready to send mail
            $sent = mail($to, $subject, $msg, $headers);
            if($sent){
                return true;
            }else{
                return false;
            }
        }
		//header('Location: forgotpassword.php');
	}
	function register($team, $namefirst, $namelast, $email, $pass, $type){		

		$_SESSION['team'] = $team;
		$_SESSION['namefirst'] = $namefirst;
		$_SESSION['namelast'] = $namelast;
		$_SESSION['email'] = $email;

		$error = false;

		$required = array($team, $namefirst, $namelast, $email, $pass, $type);

		foreach($required as $field) {
		  	if (empty($field)) {
		    	$error = true;
		  	}
		}

		if ($error == true) {
			$_SESSION['error'] = "All fields are required.";
			return false;
		} else {
			if(strlen($pass) < 6){
				$_SESSION['error'] = 'Password must be minimum 6 characters long.';
				return false;
			}
			else{
				$password = $this->createPassword($pass);
				$this->createNewUser($team, $namefirst, $namelast, $email, $password, $type);
				if(isset($_SESSION['error'])){
					return false;
				}
				else{
					return true;
				}
			}
		}
	}
	function logout(){
		if(isset($_COOKIE['username'])){
		   setcookie("username", "", mktime()-300, "/");
		}
		unset($_SESSION['username']);
		session_destroy();
				
		header('Location: /');

	}
	#--------->Escape String<---------#
	function escape_string($string){
		$escapedstring = mysqli_real_escape_string($this->link,$value);
		return $escapedstring;
	}
	#--------->Confirm Something is in the Database<---------#
	function confirmUser($email){
		/* Add slashes if necessary (for query) */
		if(!get_magic_quotes_gpc()) {
			$email = addslashes($email);
		}

		/* Verify that user is in database */
		$q = "SELECT email FROM login WHERE email = '$email'";
		$result = mysqli_query($this->link, $q);
		if(!$result || (mysqli_num_rows($result) < 1)){
		  	return 1; //Indicates username failure
		}
		$emailarray = mysqli_fetch_assoc($result);
		$email = $emailarray['email'];
		session_start();
		if($email == $_SESSION['username']){
		  	return 0; //Success! Username matches in db
		}
		else{
			return 1;
		}
	}
	#--------->Display Information<---------#
	function displayTeam($username){
		$query = "SELECT team FROM login WHERE email = '$username';";
		$result = mysqli_query($this->link, $query);
		$team = mysqli_fetch_assoc($result);
		$teamnumber = $team['team'];
		
		//TODO: check if mentor and verified
		$query2 = "SELECT * FROM login WHERE team = '$teamnumber';";
		$result2 = mysqli_query($this->link, $query2);
		
		echo '<table align="center">';
		echo '<tbody>';
		echo '<tr>';
		echo '<th></th>';
		echo '<th>Name</th>';
		echo '<th>Email</th>';
		echo '<th>Role</th>';
		echo '</tr>';
		if (!$result2 || mysqli_num_rows($result2) < 1) {
			echo ('<tr>');
			echo("<td>None to display.</td>");
			echo ('</tr>');
		}
	
		// printing team members
		while($row = mysqli_fetch_assoc($result2))
		{
			unset($row['pass']);
		
			echo ('<tr>');
			if($username == $row['email']){
				echo ('<td class="user">You</td>');
			}
			else{
				echo ('<td></td>');
			}
			echo ('<td>'.$row['namefirst'].' '.$row['namelast'].'</td>');
			echo ('<td>'.$row['email'].'</td>');
			echo ('<td>'.ucfirst($row['type']).'</td>');
			echo ('</tr>');
		}
		echo '</tbody>';
		echo '</table>';
	}
	function displayTeamList(){
		$query = "SELECT * FROM teams ORDER BY id";
		$result = mysqli_query($this->link, $query);
		echo'<div id="teamlistview">';		
        if ($result) {
            while($row = mysqli_fetch_assoc($result)){
				if($row['name'] != null && $row['team_number'] > 0){
					echo '<div>'.
					'<a>'.$row['team_number'].'</a>'.' - '.
	            	'<a href="/team/'.$row['team_number'].'"><b>'.$row['nickname'].'</b></a>'.' - '.
					'<a> '.$row['location'].'</a>'.
					'</div><br>';
				}
			}
        }
		else{
			echo 'No Teams in database';
		}
		echo '</div>';
	}
	function displayEvents(){
		$query = "SELECT * FROM events ORDER BY start_date";
		$result = mysqli_query($this->link, $query);
		echo'<div id="listevents">';		
        if ($result) {
            while($row = mysqli_fetch_assoc($result)){
				echo '<div>';
				echo '<a>'.$row['start_date'].' - '.$row['end_date'].' </a>';
            	echo '<a href="/event/'.$row['key'].'"><b>'.$row['name'].'</b></a>';
				echo '</div>';
			}
        }
		else{
			echo 'Currently No Events';
		}
		echo '</div>';
	}
	function displayLiveFeed(){		
		$query = "SELECT * FROM trades ORDER BY id DESC limit 20";
		$result = mysqli_query($this->link, $query);
				
        if ($result) {
            while($row = mysqli_fetch_assoc($result)){
				echo '<div class="list" id="'.$row['id'].'">';
				echo $row['team1'];
				$kopyear = "kop".$row['part1_year'];
				$part1 = $row['part1'];
				$partquery = "SELECT name FROM $kopyear WHERE id = '$part1';";
				$partresult = mysqli_query($this->link, $partquery);
				if($partresult){
					$part = mysqli_fetch_assoc($partresult);
					echo '<img src="/images/kop'.$row['part1_year'].'/'.$row['part1_year'].'kop'.$row['part1'].'.jpg" width="70px">';
					echo $part['name'];
				}
				echo '</div>';
			}
        }
	}
	function displayKop($year){
		$kopyear = "kop".$year;
		$query = "SELECT * FROM $kopyear;";
		$result = mysqli_query($this->link, $query);
		
		if (!$result || mysqli_num_rows($result) < 1 || mysqli_connect_errno()){
		    echo('<div style="margin-top:25px; margin-left:50px;width:505px;">Sorry we dont have this years kit of parts in our database. Do you have a copy of this years kit of parts? Send it to us in an email, and well be sure to update our database. :)</div>');
			return;
		}
	
		echo '
			<table class="koptable">
			<tbody>
				<th></th>
				<th>Picture</th>
				<th>Name</th>
				<th>Description</th>
				<th>Part Number</th>
				<th>Quantity</th>';
		while($row = mysqli_fetch_assoc($result))
		{	
			$alt = ( ($row['id'] % 2) ? 'odd' : 'even' );	
			echo '
				<tr class="'.$alt.'">
					<td><a>'.$row['id'].'</a></td>
					<td><img src="/images/kop'.$year.'/'.$year.'kop'.$row['id'].'.jpg" width="70px"></td>
					<td><a>'.$row['name'].'</a></td>
					<td><a>'.$row['Description'].'</a></td>
					<td><a>'.$row['number'].'</a></td>
					<td><a>'.$row['qty'].'</a></td>
				</tr>';
		}
		echo '
			</tbody>
			</table>';
	}
	#--------->Update Information<---------#
	function updatePassword($newPassword, $username){
		/*ASK FOR AND CHECK OLD PASSWORD BEFORE CHANGING IT!*/
		$q = "UPDATE users SET password='$newPassword' WHERE username='$username';";
		mysqli_real_query($this->link,$q);
	}
	function updateTeam($data, $team){
		$q = "UPDATE `teams` SET $data;";		
		mysqli_real_query($this->link,$q);
	}
	function updateEvents($data){
		$q = "INSERT INTO `events` SET $data;";		
		mysqli_real_query($this->link,$q);
		echo mysqli_errno($this->link) . ": " . mysqli_error($this->link) . "\n";
	}
	function updateAllTeams($data){
		$q = "INSERT INTO `teams` SET $data;";		
		mysqli_real_query($this->link,$q);
	}
	#--------->Get Information<---------#
	function getSearchResults($search){
		$searchterm = mysqli_real_escape_string($this->link, $search);
		strtoupper($searchterm);
		$result = mysqli_query($this->link,"SELECT title FROM sales WHERE upper(title) LIKE '%$searchterm%'");
		return $result;
	}
	function getUserInfo($username){
		$q = "SELECT * FROM login WHERE email = '$username';";
		$result = mysqli_query($this->link, $q);
		
 		if(!$result || mysqli_num_rows($result) < 1){
        	return NULL;
     	}
  
		/* Return result array */
		$dbarray = mysqli_fetch_assoc($result);
		return $dbarray;

		mysqli_free_result($result);
	    mysqli_close($link);
  	}
	#--------->Create Something<---------#
	function createPassword($pass){
		//hash the password
		$bcrypt = new Bcrypt(10);

		$password = $bcrypt->hash($pass);
		return $password;
	}
	function createNewUser($team, $firstname, $lastname, $email, $password, $type){

		$team = stripslashes(mysqli_real_escape_string($this->link, $team));

		//check if team_number is only numbers
		if(ctype_digit($team)){
			//Check if team exists
			$teamcheck = "SELECT team_number FROM teams WHERE team_number = '$team';";
			$result = $this->qry($teamcheck);
			if(mysqli_num_rows($result) < 1)
			{
				$_SESSION['error'] = "Sorry, that team isn't in our system.";
				return;
			}
		}
		else{
			$_SESSION['error'] = "Your team may only contain numbers.";
			return;
		}

		//check first & last name for length and illegal caracters
		$firstname = stripslashes(mysqli_real_escape_string($this->link, $firstname));
		$lastname = stripslashes(mysqli_real_escape_string($this->link, $lastname));

		if(!ctype_alpha($firstname) || !ctype_alpha($lastname)){
			$_SESSION['error'] = "Your name may only contain letters.";
			return;
		}

		//TODO:check email is an actual email address
		if(filter_var($email,FILTER_VALIDATE_EMAIL) === false)
		{
		   $_SESSION['error'] = "Sorry, that email address is invalid.";
				return;
		}
	
		//check if email is taken
		$emailcheck = "SELECT email FROM login WHERE email = '$email';";
		$result2 = $this->qry($emailcheck);
		if(mysqli_num_rows($result2) == 1) //email already registered
		{
			$_SESSION['error'] = "That email has already registered an account.";
			return;
		}

		//create user...
		$query = "INSERT INTO login (team, namefirst, namelast, email, pass, type) VALUES ('$team', '$firstname', '$lastname', '$email', '$password', '$type');";
		$this->qry($query);
	}
	#--------->Check Information<---------#
	function checkEmailExist($email){
		$email = stripslashes(mysqli_real_escape_string($this->link, $email));
		$query = "SELECT * FROM users WHERE email = '$email';";
		$result = mysqli_query($this->link, $query);
		
		if (!$result || mysqli_num_rows($result) < 1)
		{
			mysqli_free_result($result);
	    	mysqli_close($link);
			return false;
		}
		else{
			mysqli_free_result($result);
	    	mysqli_close($link);
			return true;
		}
	}
	function checkPassword($email, $password){
		//Grab the password from db
		$username = mysqli_real_escape_string($this->link, $email);
		$query = "SELECT pass, verify FROM login WHERE email = '$email';";
		$result = $this->qry($query);

		//That user isnt in the db...
		if(!$result || mysqli_num_rows($result) < 1)
		{
			return 1;
		}

		//Put row into an array
		$userData = mysqli_fetch_assoc($result);

		//check if verified
	    if ($userData['verify'] != Y) {
	    	if ($userData['verify'] == N) {
	    		return 3;
	    	}
	    	else if ($userData['verify'] == D) {
	    		return 4;
	    	}
	    	else if ($userData['verify'] == A) {
	    		return 5;
	    	}
	    }
		
		//check the password
		$bcrypt = new Bcrypt(10);
		$isGood = $bcrypt->verify($password, $userData['pass']);

		if(!$isGood) 
		{
			return 2;
		}
		else {
			
			return 0; //Success! Username and Password match the database
		    
		}


		
	}
	function checkTeamsLastUpdated(){
		$q = "SHOW TABLE STATUS FROM robotics LIKE 'teams';";		
		$result = mysqli_query($this->link,$q);
		
		while($array = mysqli_fetch_array($result)) {
			echo $array['Update_time']; 
		}
	}
	function checkEventsLastUpdated(){
		$q = "SHOW TABLE STATUS FROM robotics LIKE 'events';";		
		$result = mysqli_query($this->link,$q);
		
		while($array = mysqli_fetch_array($result)) {
			echo $array['Update_time']; 
		}
	}
};

$database = new Database;

?>