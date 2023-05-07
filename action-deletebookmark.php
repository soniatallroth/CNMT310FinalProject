<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("classes/Bookmarks.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

$required = array('bookmark_id', 'userid');

// Default is to POST. If you need to change to a GET, here's how:
//$client->setMethod("GET");

if(!isset($_SESSION['loggedIn']) || !isset($_POST['bookmark_id'])){
    $_SESSION['results'][] = "Please click on the X next to a bookmark to delete it.";
    die(header("location: " . BOOKMARKS));
}

if(!isset($_SESSION['info'])) {
    die(header("Location:" . BOOKMARKS));
}

// checks to make sure both form fields were set, displays error message if not 
// foreach($required as $element) {
//     if(!isset($_POST[$element]) || empty($_POST[$element])){
//             $_SESSION['results'][] = "Please enter a bookmark ID.";
//             die(header("location: " . BOOKMARKS));
//         }
// }

$books = new Bookmarks();

$id = $_SESSION['info']->id;
$bookmarkID = $_POST['bookmark_id'];

$books->deleteBookmark($id, $bookmarkID, $client);

?>