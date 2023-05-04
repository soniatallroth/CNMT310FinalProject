<?php 

require_once("autoload.php");
require_once("classes/Page.class.php");

$page = new Page("stash - Home");

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');
$page->addHeadElement('<link rel="icon" type="image/x-icon" href="images/favicon.ico">');

print $page->getTopSection();
print   '   <!-- Navigation -->';
print   '   <header>';
print   '       <div class="header-left">';
print   '           <h1><a class="logo" href="index.php">stash</a></h1>';
print   '       </div>';
print   '       <div class="header-right">';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    print '         <a class="link" href="bookmarks.php">Bookmarks</a>';
    print '         <a class="link login-link" href="logout.php">Log Out</a>';
}
else {
    print '         <a class="link login-link" href="login.php">Log In</a>';
}

print   '       </div>';
print   '   </header>';
print   '<!--Content-->';
print   '<div class="main-container">';
print   '   <div class="main-left">';
print   '       <p class="heading"><span>stash</span> your bookmarks with us.</p>';
print   '       <p>Keep your bookmarks in one centralized location with our storage solution.</p>';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    print '         <a class="button" href="bookmarks.php">View Bookmarks</a>';
}
else {
    print '         <a class="button" href="login.php">Log In</a>';
}

print   '   </div>';
print   '   <div class="main-right">';
print   '       <ul></ul>';
print   '           <li><span>Add</span>, <span>delete</span>, and <span>access</span> your bookmarks all from the same place</li>';
print   '           <li>View <span>popular bookmarks</span> from users across the site</li>';
print   '       </ul>';
print   '   </div>';
print   '   <!--Footer-->';
print   '</div>';
print   '   <div class="footer">'; 
print   '       <p>Copyright © 2023 stash</p>';
print   '   </div>'; 

print $page->getBottomSection();

?>
