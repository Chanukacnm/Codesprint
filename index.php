<?php
session_start();
include ("db.php"); //include db.php file to connect to DB
$pagename="Car Rental"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file\
include("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="select carId, carName, carPicNameSmall,carDescripShort,carPrice from items";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
echo "<table style='border: 0px'>";
//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed.
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp=mysqli_fetch_array($exeSQL))
{
echo "<tr>";
echo "<td style='border: 0px'>";

//make the image into an anchor to prodbuy.php and pass the product id by URL (the id from the array)
echo "<a href=prodbuy.php?u_prod_id=".$arrayp['carId'].">";

//display the small image whose name is contained in the array
echo "<img src=images/".$arrayp['carPicNameSmall']." height=200 width=200>";
//close the anchor
echo "</a>";
echo "</td>";
echo "<td style='border: 0px'>";
echo "<p><h5>".$arrayp['carName']."</h5>"; //display product name as contained in the array
echo "<p><h6>".$arrayp['carDescripShort']."</h6>";
echo "<p><h6>$".$arrayp['carPrice']."</h6>";
echo "</td>";
echo "</tr>";
}
echo "</table>";


include("footfile.html"); //include head layout
echo "</body>";
?>