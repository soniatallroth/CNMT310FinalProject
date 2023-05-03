<?php

require_once("autoload.php");
require_once("Page.class.php");

$page = new Page("Delete a Bookmark");

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');

print $page->getTopSection();
print '    <!-- Navigation (for temp add bookmarks page)-->';
print '     <header>';
print '         <h1><a class="logo" href="index.php">stash</a></h1>';
print '     </header>';
print '     <!--Content-->';
print '     <main>';
print '         <div class="add-bookmark-container">';
print '             <form id="add-bookmark" action="action-deletebookmark.php" method="POST">';

if(isset($_SESSION['errors']) && is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    foreach($_SESSION['errors'] as $field => $message) {
        print '<span class=\"error\">' . $message . '</span><br>';
    }
    $_SESSION['errors'] = array();
}

print '                 <label class="text-label" for="bookmarkID">Enter the ID of the bookmark you want to delete.</label>';
print '                 <input class="text-input" id="bookmarkID" name="bookmarkID" type="text" placeholder="e.g. 15">';
print '                 <div class="button-holder">';
print '                     <input id="submit-btn" type="submit" value="Delete Bookmark">';
print '                 </div>';
print '             </form>';
print '         </div>';
print '     </main>';

print $page->getBottomSection();
