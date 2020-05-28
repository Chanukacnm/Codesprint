<?php
session_start();
$pagename="RENT A CAR"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//display random text
echo "We are a 100% independently-owned website, not run by any auto rental company.<br><br>
We launched CARRentals.com in 2020 with an ambitious vision: to make booking an auto rental simple, fast and easy. We've continued to improve and invest in CARRentals.com to help you save time and money. We realized that finding the best deal on a car rental can be time consuming and confusing. So we've worked with the top online travel agencies in the world, the best car rental brokers, the most comprehensive car hire aggregators and well-known car rental companies (as well as many lesser known rental car brands for you to discover) to bring all the results to you in one search..<br><br>
All to provide you with The Perfect Car at the Best Price<br><br>
We wish you a safe and enjoyable trip, no matter where and when you plan to go.<br><br>
Thank you for your business,<br><br>
CARRentals.com

";

include("footfile.html"); //include head layout
echo "</body>";
?>