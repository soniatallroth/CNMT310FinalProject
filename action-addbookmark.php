<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("classes/Bookmarks.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

// Default is to POST. If you need to change to a GET, here's how:
//$client->setMethod("GET");
$books = new Bookmarks();
$required = array('url', 'displayname');

// checks to make sure both form fields were set, displays error message if not 
foreach($required as $element) {
  if(!isset($_POST[$element])){
    $_SESSION['errors'][] = "Please enter a URL/link and/or label.";
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

if(!str_contains($_POST['url'], 'https://www.')) {
    $_SESSION['errors'][] = "Please enter a valid URL that contains 'https://www.'";
    die(header("location: " . BOOKMARKS));
}

$id = $_SESSION['userid'];

$books->addBookmark($id, $client);

?>