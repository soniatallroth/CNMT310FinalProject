<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

// Default is to POST. If you need to change to a GET, here's how:
//$client->setMethod("GET");

$username = $_POST['username'];
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

if($obj->result == "Success") {
    die(header("Location: " . BOOKMARKS));
}

print $obj->result;