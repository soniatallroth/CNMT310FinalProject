<?php

//starts the session in every page that requires it (require_once() on necessary pages)
session_start();

// defines constants for redirects 
define('HOME', 'index.php');
define('BOOKMARKS', 'bookmarks.php');
define('LOGINFORM', 'form-login.php');

?>