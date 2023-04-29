<?php

require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("classes/Page.class.php");
require_once("classes/Bookmarks.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

$page = new Page("Bookmarks");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) { 
    $_SESSION['errors'][] = "Please input a username and password to access the bookmarks page.";
    die(header("Location:" . LOGINFORM)); 
}
$books = new Bookmarks();

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');
<<<<<<< Updated upstream
$page->addHeadElement('<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>');
=======
$page->addHeadElement('<script src="https://kit.fontawesome.com/c288a0b638.js" crossorigin="anonymous"></script>');
>>>>>>> Stashed changes

print $page->getTopSection();
print   '   <!-- Navigation (for bookmarks page)-->';
print   '   <header>';
print   '       <div class="header-left">';
print   '           <h1><a class="logo" href="index.php">stash</a></h1>';
print   '       </div>';
print   '       <div class="header-right">';
print   '           <a class="link login-link" href="logout.php">Log Out</a>';
print   '       </div>';
print   '   </header>';
print   '   <!--Content-->';
<<<<<<< Updated upstream
print   '   <main>';
print   "<h2 class='hellostatement'>Welcome back, " . $_SESSION['user'] .  ".</h2><br>";
=======
print   '   <main class="bookmarks-main">';
>>>>>>> Stashed changes
print   '   <div class="bookmark-heading">';
print   '       <h2>Bookmarks</h2>';
print   '<button class="button" id="addBtn">Add a bookmark</button>';
print   '<button class="button" id="deleteBtn">Delete a bookmark</button>';
print   '<div id="addModal" class="modal">';
print   '<div class="modal-content">';
print    '<span class="close">&times;</span>';
print '             <form id="add-bookmark" action="action-addbookmark.php" method="POST">';
print '                 <label class="text-label" for="url">Add the link for your bookmark</label>';
print '                 <input class="text-input" id="url" name="url" type="text" placeholder="https://www.google.com">';
print '                 <label class="text-label" for="displayname">Name your bookmark</label>';
print '                 <input class="text-input" id="displayname" name="displayname" type="text" placeholder="e.g. Chili recipe">';
print '                 <div class="button-holder">';
print '                     <input id="submit-btn" type="submit" value="Add your bookmark">';
print '                 </div>';
print '             </form>';
print  '</div>';
print '</div>'; 
print '</div>'; 
print '<div id="deleteModal" class="modal">';
print    '<div class="modal-content">';
print        '<span class="close">&times;</span>';
print        '<form id="delete-bookmark" action="action-deletebookmark.php" method="POST">';
print '                 <label class="text-label" for="bookID">Enter the ID of the bookmark you want to delete.</label>';
print '                 <input class="text-input" id="bookID" name="bookID" type="text" placeholder="e.g. 15">';
print '                 <div class="button-holder">';
print '                     <input id="submit-btn" type="submit" value="Delete Bookmark">';
print '                 </div>';
print '             </form>';
print '         </div>';
print   '   </div>';
print   '   <div class="tabs-wrapper">';
print   '       <div class="tabs">';
print   '           <div class="tab">';
print   '               <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">';
print   '               <label for="tab-1" class="tab-label">My bookmarks</label>';
print   '               <div class="tab-content">';
<<<<<<< Updated upstream
print	'					<input id="search" type="text" />';
print   '                   <ul class="list-group bookmark-container">';
=======
print   '                   <div class="search-container">';
print   '                       <input type="search" class="site-search" name="site-search" placeholder="Search for a bookmark here">';
print   '                       <a class="button" href="#">Search</a>';
print   '                   </div>';
print   '                   <ul class="list-group bookmark-container"><br>';
>>>>>>> Stashed changes

if(!isset($_SESSION['userid'])) {
    $_SESSION['errors'][] = "Sorry! No User ID was found :(";
    die(header("Location : " . BOOKMARKS)); 
}

$id = $_SESSION['userid'];

<<<<<<< Updated upstream
$books->getBookmarks($id, $client);
$books->autocomplete();
=======
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
    if(!is_array($urlList) || count($urlList) <= 0) {
        print '<h3>Sorry! No bookmarks were found to be displayed here :(</h3>';
    } else {
        foreach ($urlList as $bookmark) {
            $href = $bookmark->url;
            $title = $bookmark->displayname;
            $bookmarkID = $bookmark->bookmark_id;
            print '<div class="display list-group-item list-group-item-action">';
            print "    <li><a href='$href' target='_blank'>$title</a><br>ID: $bookmarkID</li>";
            print '    <a class="hide" href="#"><i class="fa-solid fa-xmark"></i></a>';
            print '</div>';
        }
    }
}
>>>>>>> Stashed changes
print   '                   </ul>';
print   '               </div>';
print   '           </div>'; // end of tab
print   '           <div class="tab">'; 
print   '               <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">';
print   '               <label for="tab-2" class="tab-label">Popular</label>';
print   '               <div class="tab-content">Hello</div>';
print   '           </div>'; // end of tab
print   '       </div>'; // end of tabs
print   '   </div>'; // end of tabs-wrapper
print   '   </main>';

print $page->addBottomElement("<script src='js/modal.js'></script>");

print $page->getBottomSection();
?>
