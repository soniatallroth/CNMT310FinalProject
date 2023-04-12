<?php 

require_once("autoload.php");
require_once("Page.class.php");

$page = new Page("Home Page");

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">')
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">')


print $page->getTopSection();
print   '<!-- Navigation -->';
print   '<header>';
print   '   <h1><a class="logo" href="index.html">stash</a></h1>';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    print '     <a class="link" href="logout.php">Log Out</a>';
}
else {
    print '     <a class="link" href=\"login.php\">Log In</a>';
}

print   '</header>';
print   '<!--Content-->';
print   '<main>';
print   '<div class="intro-text">';
print   '   <p><span>stash</span> your bookmarks with us.</p>';
print   '</div>';
print   '</main>';
print   '<!--Footer-->';
print   '<footer>'; 
print   '   <p>Copyright © 2023</p>';
print   '</footer>';       

print $page->getBottomSection();

?>
