<?php

require_once("autoload.php");
require_once("Page.class.php");

$page = new Page("Login Portal");

$page->addHeadElement('<link rel="stylesheet" href="css/reset.css">');
$page->addHeadElement('<link rel="stylesheet" href="css/style.css">');
    
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
print   '                 <p>Please enter your details.</p>';
print   '            </div>';
print   '            <form id="form_login" action="action-login.php" method="POST">';

if(isset($_SESSION['errors']) && is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    foreach($_SESSION['errors'] as $field => $message) {
        print '<span class=\"error\">' . $message . '</span><br>';
    }
    $_SESSION['errors'] = array();
}

print   '                   <div id="form_login_feedback">';
print   '                        <label class="text-label" for="username">Your username</label><br>';
print   '                        <input class="text-input" id="username" name="username" type="text" placeholder="eg. johnsmith">';
print   '                        <label class="text-label" for="password">Your password</label><br>';
print   '                        <input class="text-input" id="password" name="password" type="text" placeholder="********">';
print   '                        <div class="button-holder">';
print   '                            <input id="submit-btn" type="submit" value="Login">';
print   '                        </div>';
print   '                    </div>';
print   '                </form>';

print $page->getBottomSection();

?>
