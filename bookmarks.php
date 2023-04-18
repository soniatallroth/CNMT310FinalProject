<?php

require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("Page.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

$page = new Page("Bookmarks");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) { 
    $_SESSION['errors'][] = "Please input a username and password to access the bookmarks page.";
    die(header("Location:" . LOGINFORM)); 
}

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');

print $page->getTopSection();
print   '    <!-- Navigation (for bookmarks page)-->';
print   '    <header>';
print   '        <h1><a class="logo" href="index.php">stash</a></h1>';
print   '        <a class="link" href="logout.php">Logout</a>';
print   '    </header>';
print   '    <!--Content-->';
print   '    <main>';
print   '        <div class="bookmark-page-container">';
print   '            <h2 class="bookmark-heading">Bookmarks</h2>';
print   '            <a class="add-mark-button" href="form-addbookmark.php">Add a bookmark</a>';
print   '            <ul class="list-group bookmark-container">';

if(!isset($_SESSION['userid'])) {
    $_SESSION['errors'][] = "Sorry! No User ID was found :(";
    die(header("Location : " . BOOKMARKS)); 
}

$id = $_SESSION['userid'];

$data = array("user_id" => $id);
$action = "getbookmarks";
$fields = array("apikey" => APIKEY,
             "apihash" => APIHASH,
              "data" => $data,
             "action" => $action,
             );
$client->setPostFields($fields);

$returnValue = $client->send();
$obj = json_decode($returnValue);
if(!property_exists($obj, "result")) {
    die(print("Error, no result property"));
}

$urlList = $obj->data;

if($obj->result == "Success") {
    foreach ($urlList as $bookmark) {
        if(!is_array($urlList) || count($urlList) <= 0) {
        print '<h2>Sorry! No bookmarks were found to be displayed here :(</h2>';
       }
        else {
        $href = $bookmark->url;
        $title = $bookmark->displayname;
        $bookmarkID = $bookmark->bookmark_id;
        print "<a href='$href' target='_blank'>$title</a> &nbsp; ID: $bookmarkID";
    }
  }
} 

print   '            </ul>';
print   '        </div>';
print   '    </main>';
print   '    <!--Footer-->';
print   '    <footer>';
print   '        <p>Copyright © 2023</p>';
print   '    </footer>';

print $page->getBottomSection();

?>
