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
print   '    <!-- Navigation (for bookmarks page)-->';
print   '    <header>';
print   '        <h1><a class="logo" href="index.php">stash</a></h1>';
print   '        <a class="link" href="logout.php">Logout</a>';
print   '    </header>';
print   '    <!--Content-->';
print   '    <main>';
print   '        <div class="bookmark-page-container">';
print   '            <h2 class="bookmark-heading">Bookmarks</h2>';
print   '            <button class="add-mark-button" onclick = "window.location.href="add-bookmark.php";" type="button">Add a bookmark</button>';
print   '            <ul class="list-group bookmark-container">';
print   '                <a href="https://github.com/" class="list-group-item list-group-item-action">Github</a>';
print   '                <a href="https://canvas.uwsp.edu/" class="list-group-item list-group-item-action">Canvas</a>';
print   '                <a href="https://uwsp.edu" class="list-group-item list-group-item-action">UWSP website</a>';
print   '            </ul>';
print   '        </div>';
print   '    </main>';
print   '    <!--Footer-->';
print   '    <footer>';
print   '        <p>Copyright © 2023</p>';
print   '    </footer>';

print $page->getBottomSection();

?>
