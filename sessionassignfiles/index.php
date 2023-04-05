<?php

require_once('autoload.php');

print '<!DOCTYPE html>';
print '<html lang="en">';
print '<head>';
print '     <meta name="viewport" content="width=device-width, initial-scale=1.0">';
print '     <link rel="shortcut icon" href="#">';
print '     <link rel="stylesheet" href="css/style.css">';
print '     <title>Home Page</title>';
print '</head>';
print '<body>';
print '     <nav>';
print '         <a href="index.php">Home</a>';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    print '     <a href="logout.php">Log Out</a>';
}
else{
    print '     <a href="form-login.php">Log In</a>';
}
print '         <a href="bookmarks.php">Bookmarks</a>';
print '     </nav>';
print '<footer>';
print '<h5>"© Copyright UWSP 2023"</h5>';
print '</footer>';
print '</body>';
print '</html>';
?>


