<?php 
require('simple_html_dom.php');

//add 250 to skip_teams to go to next page.
$url='https://my.usfirst.org/myarea/index.lasso?page=teamlist&event_type=FRC&sort_teams=number&year=2013&event=flor';

$table = array();
$teamlist = file_get_html($url);
foreach($teamlist->find('tr') as $row) {
    $location = $row->find('td',0)->plaintext;
    $name = $row->find('td',1)->plaintext;
    $number = $row->find('td',2)->plaintext;

	$table[] = array('number' => $number,'name' => $name, 'location' => $location);
}
echo '<pre>';
print_r($table);
echo '</pre>';

?>