<?
/**
 * This will take care of anything that requires a database connection.
 * This should only be included on process & session scripts.
 * This class is all gimme gimme gimme.. You cant always get what you want!
 */
include("bcrypt.php");

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
				echo ('<td>YOU</td>');
			}
			else{
				echo ('<td></td>');
			}
			echo ('<td>'.$row['namefirst'].' '.$row['namelast'].'</td>');
			echo ('<td>'.$row['email'].'</td>');
			echo ('<td>'.$row['type'].'</td>');
			echo ('</tr>');
		}
		echo '</tbody>';
		echo '</table>';
	}
	function displayEvents(){
		$query = "SELECT id, name, location_arena, location_city, location_state, start_date, end_date FROM events ORDER BY start_date";
		$result = mysqli_query($this->link, $query);
		echo'<div id="eventlist">';		
        if ($result) {
            while($row = mysqli_fetch_assoc($result)){
				echo '<div>';
				echo '<a>'.$row['start_date'].' - '.$row['end_date'].' </a>';
            	echo '<b>'.$row['name'].'</b>';
				echo '<a> '.$row['location_arena'].', '.$row['location_city'].', '.$row['location_state'].'</a>';
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
	function createNewUser($team, $firstname, $lastname, $email,$password,$type){
		//Check if team exists
		$team = stripslashes(mysqli_real_escape_string($this->link, $team));
		$teamcheck = "SELECT number FROM teams WHERE number = '$team';";
		$result = mysqli_query($this->link, $teamcheck);
		if(mysqli_num_rows($result) < 1)
		{
			die ("Sorry, that team isn't in our system.");
		}
		//TODO:check password for length and illegal caracters
		//TODO:check email is an actual email address
		
		//check if email taken
		$email = stripslashes(mysqli_real_escape_string($this->link, $email));
		$emailcheck = "SELECT email FROM login WHERE email = '$email';";
		$result2 = mysqli_query($this->link, $emailcheck);
		if(mysqli_num_rows($result2) == 1) //email already registered
		{
			die ("that email already registered an account.");
		}
		$query = "INSERT INTO login (team, namefirst, namelast, email, pass, type) VALUES ('$team', '$firstname', '$lastname', '$email', '$password', '$type');";
		mysqli_real_query($this->link, $query);
	}
	#--------->Check Information<---------#
	function checkEmailExist($email){
		$email = stripslashes(mysqli_real_escape_string($this->link, $email));
		$query = "SELECT * FROM users WHERE email = '$email';";
		$result = mysqli_query($this->link, $query);
		
		if (!$result || mysqli_num_rows($result) < 1)
		{
			return false;
		}
		else{
			return true;
		}
	}
	function checkPassword($email, $password){
		//Grab the password from db
		$username = mysqli_real_escape_string($this->link, $email);
		$query = "SELECT pass FROM login WHERE email = '$email';";
		$result = mysqli_query($this->link, $query);

		//That user isnt in the db...
		if(!$result || mysqli_num_rows($result) < 1)
		{
			return 1;
		}

		//Put row into an array
		$userData = mysqli_fetch_assoc($result);
		
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


		mysqli_free_result($result);
	    mysqli_close($link);
	}
};

$database = new Database;

?>