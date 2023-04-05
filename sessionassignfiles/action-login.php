<?php

require_once('autoload.php');
require_once('User.class.php');

$_SESSION['loggedIn'] = false; 
$_SESSION['userid'];
$_SESSION['errors'] = array();

$required = array('username', 'password');
$userObject = new User();

// checks to make sure both form fields were set, displays error message if not 
foreach($required as $element) {
  if(!isset($_POST[$element])){
    $_SESSION['errors'][] = "Please input a username and/or password.";
    die(header("location: " . LOGINFORM));
  }
}

// checks if username or password field is empty, displays error message if so 
foreach($required as $element) {
  if(empty($_POST[$element])) {
    $_SESSION['errors'][] = "Please input a " .ucfirst($element);
    die(header("location: " . LOGINFORM));
  }
}

// checks if any error messages were added to array, if so redirects to form again and displays them
if(count($_SESSION['errors']) > 0) {
  die(header("location: " . LOGINFORM));
}

//no need for any overarching if statement, all checks above are passed so below code safe to run

//sanitizes username as all usernames are lowercased internally
$username = strtolower($_POST['username']);
$result = $userObject -> authUser($username, $_POST['password']);

if ($result["authResult"] === true) {
  $_SESSION['loggedIn'] = true;
  $_SESSION['userid'] = $result['details']['userid'];
  die(header("location: " . BOOKMARKS));
} 
else {
  $_SESSION['errors'] = $result;
  die(header("location: " . LOGINFORM));
}

?>