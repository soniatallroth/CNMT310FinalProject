<?php
require_once('autoload.php');

print '<!DOCTYPE html>';
print '<html lang="en">';
print '<head>';
print '     <meta name="viewport" content="width=device-width, initial-scale=1.0">';
print '     <link rel="shortcut icon" href="#">';
print '     <link rel="stylesheet" href="css/style.css">';
print '     <title>Login Form</title>';
print '</head>';
print '<body>';
print '     <nav>';
print '         <a href="index.php">Home</a>';
print '         <a href="bookmarks.php">Bookmarks</a>';
print '     </nav>';
print '     <h1>Login</h1>';
print '     <form id="form_login" action="action-login.php" method="POST">';

if(isset($_SESSION['errors']) && is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    foreach($_SESSION['errors'] as $field => $message) {
        print '<span class=\"error\">' . $message . '</span><br>';
    }
    $_SESSION['errors'] = array();
}

print '         <div id="form_login_feedback">';
print '             <label for="username">Username:</label>';
print '              <input type="text" id="username" name="username">';
print '              <br>';
print '              <label for="password">Password:</label>';
print '              <input type="password" id="password" name="password">';
print '              <br><br>';
print '              <input type="submit" id="submit-btn" value="Login">';
print '              <br>';
print '         </div>';
print '     </form>';
print '</body>';
print '</html>';
?>