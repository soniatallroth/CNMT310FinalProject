<?php

require_once("autoload.php");
require_once("Page.class.php");

$page = new Page("Add Bookmarks");

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');

print $page->getTopSection();
print '    <!-- Navigation (for temp add bookmarks page)-->';
print '     <header>';
print '         <h1><a class="logo" href="index.html">stash</a></h1>';
print '     </header>';
print '     <!--Content-->';
print '     <main>';
print '         <div class="add-bookmark-container">';
print '             <form id="add-bookmark" action="bookmarks.php" method="POST">';
print '                 <label class="text-label" for="link">Add the link for your bookmark</label>';
print '                 <input class="text-input" id="link" name="link" type="text" placeholder="https://www.google.com">';
print '                 <label class="text-label" for="link-name">Name your bookmark</label>';
print '                 <input class="text-input" id="link-name" name="link-name" type="text" placeholder="eg. Chili recipe">';
print '                 <div class="button-holder">';
print '                     <input id="submit-btn" type="submit" value="Add your bookmark">';
print '                 </div>';
print '             </form>';
print '         </div>';
print '     </main>';
print '     <!--Footer-->';
print '     <footer>';
print '         <p>Copyright © 2023</p>';
print '     </footer>';

print $page->getBottomSection();
