<?php
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$mysqli = new mysqli("localhost", "aaron", "password", "robotics");
		
		$lastid = $_POST['last'];
		
        $result = $mysqli->query("SELECT * FROM login WHERE IdUser > '$lastid' ORDER BY IdUser asc limit 1");
        if ($result) {
            while($row = mysqli_fetch_assoc($result)){
				echo '<div class="list" id="'.$row['IdUser'].'">';
            	echo $row['namefirst'];
				echo '</div>';
			}
			++$lastid;
        }
    }
?>