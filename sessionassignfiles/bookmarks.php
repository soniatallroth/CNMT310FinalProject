<?php

require_once('autoload.php');
require_once('User.class.php');

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) { 
  die(header("Location:" . LOGINFORM)); 
}

print '<!DOCTYPE html>';
print '<html lang="en">';
print '<head>';
print '     <meta name="viewport" content="width=device-width, initial-scale=1.0">';
print '     <link rel="shortcut icon" href="#">';
print '     <link rel="stylesheet" href="css/style.css">';
print '     <title>Bookmarks</title>';
print '</head>';
print '<body>';
print '<nav>';
print '<a href="index.php">Home</a>';
print '<a href="bookmarks.php">Bookmarks</a>';
print '<a href="logout.php">Log Out</a>';
print '</nav>';

$userObject = new User();

if(!isset($_SESSION['userid'])) {
  $_SESSION['errors'][] = "Sorry! No User ID was found :(";
  die(header("Location : " . LOGINFORM)); 
}

$urlList = $userObject-> getBookmarks($_SESSION['userid']);

// iterates through list of bookmarks associated with userid, if none are found prints message
foreach ($urlList as $bookmark) {
  if(empty($bookmark)) {
    print '<h2>Sorry! No bookmarks were found to be displayed here :(</h2>';
  }
  else {
    $href = $bookmark['url'];
    $title = $bookmark['title'];
    print "<a href='$href' target='_blank'>$title</a>";
  }
}

print '<footer>';
print '<h5>"© Copyright UWSP 2023"</h5>';
print '</footer>';
print '</body>';
print '</html>';
?>