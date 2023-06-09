<?php

require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("classes/Bookmarks.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

if(!isset($_SESSION['loggedIn']) || !isset($_SESSION['info'])) {
    $_SESSION['results'][] = "You must be logged in to perform this action.";
    die(header("Location:" . LOGINFORM));
}

if(empty($_SERVER['HTTP_REFERER'])) {
    $_SESSION['results'][] = "Click on a bookmark to add a visit.";
    die(header("Location:" . BOOKMARKS));
}

if(count($_SESSION['results']) > 0){
    $_SESSION['results'][] = "Sorry! There was an error adding a visit.";
    die(header("Location:" . BOOKMARKS));
}

$books = Bookmarks::create()->setBookmarkID($_POST['bookmark_id'])->setID($_SESSION['info']->id);

$returnVal = $books->addVisit($client, $_SESSION);

if(isset($returnVal)){
    die(header("Location: " . BOOKMARKS));
}

?>