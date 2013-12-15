<?
function errorJson($msg){
	print json_encode(array('error'=>$msg));
	exit();
}

//setup db connection
$link = mysqli_connect("localhost","aaron","password");
mysqli_select_db($link, "robotics");

//executes a given sql query with the params and returns an array as result
function query() {
	global $link;
	$debug = false;
	
	//get the sql query
	$args = func_get_args();
	$sql = array_shift($args);

	//secure the input
	for ($i=0;$i<count($args);$i++) {
		$args[$i] = urldecode($args[$i]);
		$args[$i] = mysqli_real_escape_string($link, $args[$i]);
	}
	
	//build the final query
	$sql = vsprintf($sql, $args);
	
	if ($debug) print $sql;
	
	//execute and fetch the results
	$result = mysqli_query($link, $sql);
	if (mysqli_errno($link)==0 && $result) {

		//return $result;
		
		$rows = array();

		if ($result!==true)
		while ($d = mysqli_fetch_assoc($result)) {
			array_push($rows,$d);
		}
		
		//return json
		return array('result'=>$rows);
		
	} else {
	
		//error
		return array('error'=>'Database error');
	}
}

//loads up the source image, resizes it and saves with -thumb in the file name
function thumb($srcFile, $sideInPx) {

  $image = imagecreatefromjpeg($srcFile);
  $width = imagesx($image);
  $height = imagesy($image);
  
  $thumb = imagecreatetruecolor($sideInPx, $sideInPx);
  
  imagecopyresized($thumb,$image,0,0,0,0,$sideInPx,$sideInPx,$width,$height);
  
  imagejpeg($thumb, str_replace(".jpg","-thumb.jpg",$srcFile), 85);
  
  imagedestroy($thumb);
  imagedestroy($image);
}

function register($user, $pass) {
	//check if username exists
	$login = query("SELECT IdUser, username FROM login WHERE username='%s' limit 1", $user);
	if (count($login['result'])>0) {
		errorJson('Username already exists');
	}
 	
	//try to register the user
	$result = query("INSERT INTO login(username, pass) VALUES('%s','%s')", $user, $pass);
	if (!$result['error']) {
		$userinfo = query("SELECT IdUser, username FROM login WHERE username='%s' limit 1", $user);
		$_SESSION['username'] = $userinfo['result'][0]['IdUser'];
		print json_encode($userinfo);
	} else {
		//error
		errorJson('Registration failed');
	}
}

function login($user, $pass) {
	$result = query("SELECT IdUser, email, pass FROM login WHERE email='%s' limit 1", $user);
		
	$bcrypt = new Bcrypt(10);
	$isGood = $bcrypt->verify($pass, $result['result'][0]['pass']);
 
	if ($isGood) {
		//authorized
		$_SESSION['username'] = $result['result'][0]['email'];
		unset($result['result'][0]['pass']);
		print json_encode($result);
	} else {
		//not authorized
		errorJson('The username or password you entered were incorrect.');
	}
}

function upload($id, $photoData, $title) {
	//check if a user ID is passed
	if (!$id) errorJson('Authorization required');
 
	//check if there was no error during the file upload
	if ($photoData['error']==0) {
		$result = query("INSERT INTO photos(IdUser,title) VALUES('%d','%s')", $id, $title);
		if (!$result['error']) {
 
			//database link
				global $link;

				//get the last automatically generated ID
				$IdPhoto = mysqli_insert_id($link);

				//move the temporarily stored file to a convenient location
				if (move_uploaded_file($photoData['tmp_name'], "../upload/".$IdPhoto.".jpg")) {
					//file moved, all good, generate thumbnail
					thumb("../upload/".$IdPhoto.".jpg", 180);
					print json_encode(array('successful'=>1));
				} else {
					errorJson('Upload on server problem');
				};
 
		} else {
			errorJson('Upload database problem.'.$result['error']);
		}
	} else {
		errorJson('Upload malfunction');
	}
}

function kop($year) {
	if ($year<=2012||$year>=2007) {
		$kop = sprintf('kop%d',$year);
		$result = query("SELECT * FROM $kop ORDER BY id");
		/*$json = array();
		while($row = mysqli_fetch_array ($result))     
		{
		    $bus = array(
		        'id' => $row['id'],
		        'name' => $row['name'],
		        'description' => $row['description'],
		        'picture' => './images/' . $year . 'kop' . $row['id'] . '.jpg'
		    );
		    array_push($json, $bus);
		}*/
		$jsonstring = json_encode($result);
		echo $jsonstring;
		
	} else {
		errorJson('Sorry we dont have this years kit of parts in our database. Do you have a copy of this years kit of parts? Send it to us in an email, and well be sure to update our database. :)');
	}
}

function feed($lastid){
	$result = query("SELECT * FROM trades WHERE id > $lastid ORDER BY id DESC");
	
	print json_encode($result);
}

function logout() {
	$_SESSION = array();
	session_destroy();
}

?>