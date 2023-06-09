<?php
require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("classes/Bookmarks.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

if(!isset($_SESSION['loggedIn']) || !isset($_SESSION['info'])){
    $_SESSION['results'][] = "You must be logged in to perform this action.";
    die(header("location: " . LOGINFORM));
}

if(!isset($_POST['bookmark_id'])) {
    $_SESSION['results'][] = "Please click on the X next to a bookmark to delete it.";
    die(header("Location:" . BOOKMARKS));
}

$books = Bookmarks::create()->setBookmarkID($_POST['bookmark_id'])->setID($_SESSION['info']->id);

$returnVal = $books->deleteBookmark($client, $_SESSION);

if(isset($returnVal)){
    die(header("Location: " . BOOKMARKS));
}

?>