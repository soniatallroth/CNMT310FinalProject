<?php

require_once("autoload.php");
require_once("classes/Page.class.php");

$page = new Page("stash - Login Portal");

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) { 
    die(header("Location:" . BOOKMARKS)); 
}

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');
$page->addHeadElement('<link rel="icon" type="image/x-icon" href="images/favicon.ico">');
    
print $page->getTopSection();

print   '<!-- Navigation (specific to login)-->';
print   '<header class="login-header">';
print   '   <h1><a class="login-logo" href="index.php">stash</a></h1>';
print   '</header>';
print   '<!--Content-->';
print   '<main>';
print   '<div class="login-container">';
print   '   <div class="login">';
print   '             <div class="welcome-text">';
print   '                 <h2>Welcome!</h2>';
print   '                 <p>Please enter your credentials.</p>';
print   '            </div>';
print   '            <form id="form_login" action="action-login.php" method="POST">';
print '<span id="errorMsg" class="error">';

if(isset($_SESSION['results']) && is_array($_SESSION['results']) && count($_SESSION['results']) > 0) {
    foreach($_SESSION['results'] as $field => $message) {
        print $message;
    }
    $_SESSION['results'] = array();
}

print '</span>';
print   '                   <div id="form_login_feedback">';
print   '                        <label class="text-label" for="username">Your username:</label><br>';
print   '                        <input class="text-input" id="username" name="username" type="text" placeholder="eg. johnsmith">';
print   '                        <label class="text-label" for="password">Your password:</label><br>';
print   '                        <input class="text-input" id="password" name="password" type="password" placeholder="********">';
print   '                        <div class="button-holder">';
print   '                            <input id="submit-btn" type="submit" value="Log In">';
print   '                        </div>';
print   '                    </div>';
print   '                        </form>';
print   '                 </div>';
print   '              </div>';
print   '</main>';

print $page->addBottomElement('<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>');
print $page->addBottomElement("<script src='js/validator.js'></script>");
print $page->getBottomSection();

?>
