<?php

require_once("WebServiceClient.php");
require_once("autoload.php");
require_once("classes/Page.class.php");
require_once("classes/Bookmarks.class.php");
require_once(__DIR__ . "/../yoyoconfig.php");

$url = "https://cnmt310.classconvo.com/bookmarks/";
$client = new WebServiceClient($url);

$page = new Page("stash - Bookmarks");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) { 
    $_SESSION['results'][] = "Please input a username and password to access the bookmarks page.";
    die(header("Location:" . LOGINFORM)); 
}
$books = new Bookmarks();

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');
$page->addHeadElement('<link rel="icon" type="image/x-icon" href="images/favicon.ico">');
$page->addHeadElement('<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>');
$page->addHeadElement('<script src="https://kit.fontawesome.com/c288a0b638.js" crossorigin="anonymous"></script>');
$page->addHeadElement('<script src="js/ajaxAddVisit.js"></script>');
$page->addHeadElement('<script src="js/ajaxDeleteBookmark.js"></script>');

print $page->getTopSection();
print   '   <!-- Navigation (for bookmarks page)-->';
print   '   <header>';
print   '       <div class="header-left">';
print   '           <h1><a class="logo" href="index.php">stash</a></h1>';
print   '       </div>';
print   '       <div class="header-right">';
print   "       <p class='hellostatement'>Welcome back, " . $_SESSION['info']->name .  ".</p>";
print   '           <a class="link login-link" href="logout.php">Log Out</a>';
print   '       </div>';
print   '   </header>';
print   '   <!--Content-->';
print   '   <main class="bookmarks-main">';

if(isset($_SESSION['results']) && is_array($_SESSION['results']) && count($_SESSION['results']) > 0) {
    foreach($_SESSION['results'] as $field => $message) {
        print '<span class="error" id="errormsg">' . $message . '</span><br>';
    }
    $_SESSION['results'] = array();
}

print   '   <div class="bookmark-heading">';
print   '       <h2>Bookmarks</h2>';
print   '       <button class="button" id="addBtn">Add a bookmark</button>';
print   '       <div id="addModal" class="modal">';
print   '           <div class="modal-content">';
print   '               <form id="add-bookmark" action="action-addbookmark.php" method="POST">';
print   '                   <label class="text-label" for="url">Add the link for your bookmark:</label>';
print   '                   <input class="text-input" id="url" name="url" type="url" placeholder="https://www.google.com">';
print   '                   <label class="text-label" for="displayname">Name your bookmark:</label>';
print   '                   <input class="text-input" id="displayname" name="displayname" type="text" placeholder="e.g. Chili recipe">';
print   '                   <label class="text-label" for="radio-button-container">Do you want your bookmark to appear in the Popular tab?</label><br>';
print   '                   <div class="radio-button-container">';
print   '                       <input type="radio" id="public" name="sharingBookmarks" checked="checked" value="public">'; // public radio button
print   '                       <label for="public">Yes</label><br>'; 
print   '                       <input type="radio" id="private" name="sharingBookmarks" value="private">'; // private radio button
print   '                       <label for="private">No</label>';
print   '                   </div>';
print   '                   <div class="button-holder">';
print   '                       <span class="close close-words">Close window</span>';
print   '                       <input id="submit-btn" type="submit" value="Add your bookmark">';
print   '                   </div>';
print   '                </form>';
print   '           </div>'; // end of modal-content
print   '       </div>'; 
print   '   </div>'; 
print   '       <div class="tabs-wrapper">';
print   '           <div class="tabs">';
print   '               <div class="tab">';
print   '                   <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">';
print   '                   <label for="tab-1" class="tab-label">My bookmarks</label>';
print   '                   <div class="tab-content">';
print   '                       <div class="search-container">';
print   '                           <input id="search" type="text" class="site-search" name="site-search" placeholder="Search for a bookmark here">';
print   '                           <a class="button" href="#">Search</a>';
print   '                       </div>';
print   '                       <div class="list-group bookmark-container"><br>';

if(!isset($_SESSION['info'])) {
    $_SESSION['results'][] = "Sorry! No User ID was found :(";
    die(header("Location : " . BOOKMARKS)); 
}

//$id = $_SESSION['info']->id;

$books = Bookmarks::create()->setID($_SESSION['info']->id);
$mainBookmarks = $books->getBookmarks($client, 'main');

print $mainBookmarks;
$books->autocomplete('main');

print   '                   </div>'; // end of fake ul
print   '               </div>';
print   '           </div>'; // end of my bookmarks tab
print   '           <div class="tab">'; 
print   '               <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">';
print   '               <label for="tab-2" class="tab-label">Popular</label>';
print   '               <div class="tab-content">';
print   '                   <div class="search-container">';
print   '                       <input id="popSearch" type="text" class="site-search" name="site-search" placeholder="Search for a bookmark here">';
print   '                       <a class="button" href="#">Search</a>';
print   '                   </div>';
print   '                   <div class="list-group bookmark-container"><br>';

$popularBookmarks = $books->getBookmarks($client, 'popular');
print $popularBookmarks;
//$books->autocomplete('popular');

print   '                   </div>';
print   '               </div>';
print   '           </div>'; // end of popular tab
print   '       </div>'; // end of tabs
print   '   </div>'; // end of tabs-wrapper

print   '   </main>';

print $page->addBottomElement("<script src='js/modal.js'></script>");

print $page->getBottomSection();

?>
