<?php

require_once("autoload.php");
require_once("Page.class.php");

$page = new Page("Bookmarks");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) { 
    $_SESSION['errors'][] = "Please input a username and password to access the bookmarks page.";
    die(header("Location:" . LOGINFORM)); 
}

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');

print $page->getTopSection();
print  "<!-- Navigation -->";
print   '<header>';
print   '   <h1><a class="logo" href="index.php">stash</a></h1>';
print '     <a class="link" href="bookmarks.php">Bookmarks</a>';
print '     <a class="link" href="logout.php">Log Out</a>';
print   '</header>';
print  "<!--Content-->";
print  "<main>";
print       "<h1>Bookmarks page</h1>";
print       "<p>This is the bookmarks page</p>";
print       "<div class=\"list-group\">";
print            "<a href=\"https://github.com/\" class=\"list-group-item list-group-item-action\">Github</a>";
print            "<a href=\"https://canvas.uwsp.edu/\" class=\"list-group-item list-group-item-action\">Canvas</a>";
print            "<a href=\"https://uwsp.edu\" class=\"list-group-item list-group-item-action\">UWSP website</a>";
print       "</div>";
print  "</main>";
print  "<!--Footer-->";
print   "<footer>";       
print   "</footer>";       
print "<!--Bootstrap JS-->";

print $page->getBottomSection();

?>