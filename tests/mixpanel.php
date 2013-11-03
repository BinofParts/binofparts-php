<?php
// import Mixpanel
require '../mixpanel-php/lib/Mixpanel.php';

// get the Mixpanel class instance, replace with your project token
$mp = Mixpanel::getInstance("217ad8649026f9b42f8df035112ab745");

// track an event
$mp->track("button clicked", array("label" => "sign-up")); // track an event

// create/update a profile for user id 12345
$mp->people->set(12345, array(
    '$first_name'       => "John",
    '$last_name'        => "Doe",
    '$email'            => "john.doe@example.com",
    '$phone'            => "5555555555",
    "Favorite Color"    => "red"
));
?>