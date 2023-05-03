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
//$required = array('bookID');

// checks to make sure both form fields were set, displays error message if not 
// foreach($required as $element) {
//   if(!isset($_POST[$element]) || empty($_POST[$element])){
//     $_SESSION['errors'][] = "Please enter a bookmark ID.";
//     die(header("location: " . BOOKMARKS));
//   }
// }

$id = $_SESSION['userid'];

$books->deleteBookmark($id, $client);

?>