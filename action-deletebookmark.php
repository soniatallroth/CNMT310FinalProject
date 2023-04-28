<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

// Default is to POST. If you need to change to a GET, here's how:
//$client->setMethod("GET");

$required = array('bookID');

// checks to make sure both form fields were set, displays error message if not 
foreach($required as $element) {
  if(!isset($_POST[$element])){
    $_SESSION['errors'][] = "Please enter a bookmark ID.";
    die(header("location: " . BOOKMARKS));
  }
}

// checks if URL or label field is empty, displays error message if so 
foreach($required as $element) {
  if(empty($_POST[$element])) {
    $_SESSION['errors'][] = "Please input a " .ucfirst($element);
    die(header("location: " . BOOKMARKS));
  }
}

$bookID = $_POST['bookID'];
$id = $_SESSION['userid'];

$data = array("bookmark_id" => $bookID, "user_id" => $id);
$action = "deletebookmark";
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
   $_SESSION['errors'][] = "Sorry! There was an error deleting your bookmark.";
   die(header("Location: " . BOOKMARKS));
}
