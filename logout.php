<?php
session_start();
include("db.php");
$pagename="Log Out";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//Display thank you message
if(isset($_SESSION['userid'])){ 
echo "ThankYou, ".$_SESSION['userfname']."<br>";
}
//unset the session 
unset($_SESSION['userid']);
unset($_SESSION['userfname']);
//destroy the session 
session_destroy();
//Display a log out confirmation message 
echo "You are now Logged out";
include("footfile.html"); //include head layout
echo "</body>"; 
?>