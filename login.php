<?php

require_once("Page.class.php");

$page = new Page("Home Page");

$page->addHeadElement("<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ\" crossorigin=\"anonymous\">");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"css/style.css\">");

print $page->getTopSection();

print "<!-- Navigation-->";
print "<nav class=\"navbar navbar-expand-lg navbar-light bg-light fixed-top\">";
print      "<div class=\"container\">";
print      "<a class=\"navbar-brand\" href=\"index.php\">Home</a>";
print           "<div id=\"navbarResponsive\">";
print               "<ul class=\"navbar-nav ms-auto\">";
print               "<li class=\"nav-item active\">";
print               "</li>";
print               "</ul>";
print           "</div>";
print      "</div>";
print "</nav>";
print "<!--Content-->";
print "<main>";
print '     <h1>Login</h1>';
print '     <form id="form_login" action="action-login.php" method="POST">';
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

$page->addBottomElement("<script src=\"https://code.jquery.com/jquery-3.2.1.slim.min.js\" integrity=\"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN\" crossorigin=\"anonymous\"></script>");
$page->addBottomElement("<script src=\"https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js\" integrity=\"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q\" crossorigin=\"anonymous\"></script>");
$page->addBottomElement("<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>");

print $page->getBottomSection();

?>