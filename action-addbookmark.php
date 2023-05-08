<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("classes/Bookmarks.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

$required = array('url', 'displayname');

if(!isset($_SESSION['loggedIn']) || !isset($_SESSION['info'])) {
  $_SESSION['results'][] = "You must be logged in to perform this action.";
  die(header("Location:" . LOGINFORM));
}

// Default is to POST. If you need to change to a GET, here's how:
//$client->setMethod("GET");

// checks to make sure both form fields were set, displays error message if not 
foreach($required as $element) {
  if(!isset($_POST[$element]) || empty($_POST[$element])){
    $_SESSION['results'][] = "Please enter a valid URL and label for your bookmark.";
    die(header("location: " . BOOKMARKS));
  }
}

if(!str_contains($_POST['url'], 'https://')) {
  $_SESSION['results'][] = "Please enter a valid URL that contains 'https://'";
  die(header("location: " . BOOKMARKS));
}

$books = Bookmarks::create()->setID($_SESSION['info']->id)->setURL($_POST['url'])->setDisplayName($_POST['displayname'])->setSharedStatus($_POST['sharingBookmarks']);

$returnVal = $books->addBookmark($client, $_SESSION);

if(isset($returnVal)){
  die(header("Location: " . BOOKMARKS));
}

?>