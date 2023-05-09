<?php

require_once('autoload.php');

if(isset($_SESSION['loggedIn'])) {
	$_SESSION['loggedIn'] = false;
	unset($_SESSION['loggedIn']);
}

session_destroy();

foreach($_SESSION as $key => $value) {
	unset($_SESSION[$key]);
}

session_write_close();

die(header("Location: " . HOME));

?>