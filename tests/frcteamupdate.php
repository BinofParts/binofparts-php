<?php 
require('simple_html_dom.php');

//add 250 to skip_teams to go to next page.
$url='https://my.usfirst.org/myarea/index.lasso?page=searchresults&programs=FRC&reports=teams&sort_teams=number&results_size=250&omit_searchform=1&season_FRC=2014';

$table = array();
$htmlfile = file_get_html($url);

$teamlist = $htmlfile->find("table", 2);

foreach($teamlist->find('tr') as $row) {
    $location = $row->find('td',0)->plaintext;
    $name = $row->find('td',1)->plaintext;
    $number = $row->find('td',2)->plaintext;

	$table[] = array('number' => $number,'name' => $name, 'location' => $location);
}

$output = array_slice($table, 3); 
echo '<pre>';
print_r($output);
echo '</pre>';

?>