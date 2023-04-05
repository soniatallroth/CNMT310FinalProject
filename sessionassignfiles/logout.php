<?php

//make sure to check if logged in and on index page, button should say logout, not log in
require_once('autoload.php');

//if something is going to be used in session, isset
if(isset($_SESSION['loggedIn'])) {
	$_SESSION['loggedIn'] = false;
	unset($_SESSION['loggedIn']);
}

session_destroy();

foreach($_SESSION as $key => $value) {
	unset($_SESSION[$key]);
}

session_write_close();

//home is constant fyi
die(header("Location: " . HOME));

?>