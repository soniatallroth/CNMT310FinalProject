<?php

require_once("autoload.php");
require_once("Page.class.php");

$page = new Page("Add a Bookmark");

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
print '             <form id="add-bookmark" action="action-addbookmark.php" method="POST">';

if(isset($_SESSION['errors']) && is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    foreach($_SESSION['errors'] as $field => $message) {
        print '<span class=\"error\">' . $message . '</span><br>';
    }
    $_SESSION['errors'] = array();
}

print '                 <label class="text-label" for="url">Add the link for your bookmark</label>';
print '                 <input class="text-input" id="url" name="url" type="text" placeholder="https://www.google.com">';
print '                 <label class="text-label" for="displayname">Name your bookmark</label>';
print '                 <input class="text-input" id="displayname" name="displayname" type="text" placeholder="e.g. Chili recipe">';
print '                 <div class="button-holder">';
print '                     <input id="submit-btn" type="submit" value="Add your bookmark">';
print '                 </div>';
print '             </form>';
print '         </div>';
print '     </main>';

print $page->getBottomSection();
