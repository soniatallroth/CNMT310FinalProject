<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

// Default is to POST. If you need to change to a GET, here's how:
//$client->setMethod("GET");

$_SESSION['loggedIn'] = false; 
$_SESSION['errors'] = array();
$_SESSION['userid'] = array();
$required = array('username', 'password');

// checks to make sure both form fields were set, displays error message if not 
foreach($required as $element) {
  if(!isset($_POST[$element])){
    $_SESSION['errors'][] = "Please input a username and/or password.";
    die(header("location: " . LOGINFORM));
  }
}

// field checking (empty fields) handled by JS validation

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

//For Debugging:
//var_dump($client);

$returnValue = $client->send();
$obj = json_decode($returnValue);
if(!property_exists($obj, "result")) {
    die(print("Error, no result property"));
}
//dumps JSON server response containing data + result
//var_dump($returnValue);

//all checks above are passed, so below code *should* be safe to run

if($obj->result == "Success") {
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $_POST['username'];
    $_SESSION['userid'] = $obj->data->id;
    die(header("Location: " . BOOKMARKS));
}
else {
    $_SESSION['errors'][] = "User was not found or password incorrect.";
    die(header("Location: " . LOGINFORM));
}
