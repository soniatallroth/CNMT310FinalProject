<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

// Default is to POST. If you need to change to a GET, here's how:
//$client->setMethod("GET");

$_SESSION['loggedIn'] = false; 
$_SESSION['results'] = array();
$_SESSION['info'] = array();

$required = array('username', 'password');

// checks to make sure both form fields were set, displays error message if not 
foreach($required as $element) {
  if(!isset($_POST[$element])){
    $_SESSION['results'][] = "Please input a username and/or password.";
    die(header("location: " . LOGINFORM));
  }
}

// field checking (empty fields) handled by JS validation

if(count($_SESSION['results']) > 0){
  die(header("Location" . LOGINFORM)); 
}

//sanitize usernames because all lowercase internally
$username = strtolower($_POST['username']);
$password = $_POST['password'];

$data = array("username" => $username, "password" => $password);
$action = "authenticate";
$fields = array("apikey" => APIKEY,
             "apihash" => APIHASH,
              "data" => $data,
             "action" => $action,
             );
$client->setPostFields($fields);

$returnValue = $client->send();
$obj = json_decode($returnValue);
if(!property_exists($obj, "result")) {
    die(print("Error, no result property"));
}

//all checks above are passed, so below code *should* be safe to run

if($obj->result == "Success") {
    $_SESSION['loggedIn'] = true;
    $_SESSION['info'] = $obj->data;
    die(header("Location: " . BOOKMARKS));
}
else {
    $_SESSION['results'][] = "User was not found or password incorrect.";
    die(header("Location: " . LOGINFORM));
}

?>