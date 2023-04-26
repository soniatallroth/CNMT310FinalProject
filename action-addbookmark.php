<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

// Default is to POST. If you need to change to a GET, here's how:
//$client->setMethod("GET");

$required = array('url', 'displayname');

// checks to make sure both form fields were set, displays error message if not 
foreach($required as $element) {
  if(!isset($_POST[$element])){
    $_SESSION['errors'][] = "Please enter a URL/link and/or label.";
    die(header("location: " . ADDBOOKMARKFORM));
  }
}

// checks if URL or label field is empty, displays error message if so 
foreach($required as $element) {
  if(empty($_POST[$element])) {
    $_SESSION['errors'][] = "Please input a " .ucfirst($element);
    die(header("location: " . ADDBOOKMARKFORM));
  }
}

if(!str_contains($_POST['url'], 'https://www.')) {
    $_SESSION['errors'][] = "Please enter a valid URL that contains 'https://www.'";
    die(header("location: " . ADDBOOKMARKFORM));
}

$link = strtolower($_POST['url']);
$linkLabel = $_POST['displayname'];
$id = $_SESSION['userid'];

$data = array("url" => $link, "displayname" => $linkLabel, "user_id" => $id);
$action = "addbookmark";
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

//print $obj->result;
//all checks above are passed, so below code *should* be safe to run

if($obj->result == "Success") {
   die(header("Location: " . BOOKMARKS));
}
else {
   $_SESSION['errors'][] = "Sorry! There was an error adding your bookmark.";
   die(header("Location: " . ADDBOOKMARKFORM));
}
