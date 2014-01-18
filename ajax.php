<?php
	include_once('database.php');
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		
		$lastid = $_POST['last'];
        $result = $database->qry("SELECT * FROM trades WHERE id > '$lastid' ORDER BY id DESC limit 1");
        if ($result) {
            while($row = mysqli_fetch_assoc($result)){
				echo '<div class="list" id="'.$row['id'].'">';
				echo $row['team1'];
				$kopyear = "kop".$row['part1_year'];
				$part1 = $row['part1'];
				$partresult = $database->qry("SELECT name FROM $kopyear WHERE id = '$part1'");
				if($partresult){
					$part = mysqli_fetch_assoc($partresult);
					echo '<img src="/images/kop'.$row['part1_year'].'/'.$row['part1_year'].'kop'.$row['id'].'.jpg" width="70px">';
					echo $part['name'];
				}
				echo '</div>';
			}
			++$lastid;
    }
        }
?>