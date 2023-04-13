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
print  "<nav class=\"navbar navbar-light bg-light fixed-top\">";
print  "<div class=\"container\">";
print      "<a class=\"navbar-brand\" href=\"index.php\">Home</a>";
print      "<div id=\"navbarResponsive\">";
print           "<ul class=\"navbar-nav ms-auto\">";
print           "<li class=\"nav-item active\">";
print               "<a class=\"nav-link\" href=\"logout.php\">Log Out</a> <!--probably needs to be changed-->";
print           "</li>";
print           "</ul>";
print      "</div>";
print  "</div>";
print  "</nav>";
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