<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("classes/Bookmarks.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

$required = array('bookmarkID');

if(count($_SESSION['errors']) > 0){
    $_SESSION['errors'][] = "Sorry! There was an error adding a visit.";
    die(header("Location:" . BOOKMARKS));
}

$books = new Bookmarks();

$id = $_SESSION['userid'];
$bookmarkID = $_POST['bookmark_id'];

$returnValue = $books ->addVisit($id, $bookmarkID, $client);
//var_dump($returnValue);

// if(isset($_SESSION['results'])){
//     $_SESSION['results'][] = $returnValue;
//     die(header("Location:" . BOOKMARKS));
// }

?>