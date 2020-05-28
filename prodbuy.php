<?php
session_start();
include("db.php");
$pagename="RENT YOUR CAR & ENJOY YOURSELF"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
//applied to the query string u_prod_id
//store the value in a local variable called $prodid
$prodid=$_GET['u_prod_id'];
//display the value of the product id, for debugging purposes
echo "<p>Selected product Id: ".$prodid;
//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="select carId, carName, carPicNameLarge,carDescripLong,carPrice,carQuantity from items WHERE carId =".$prodid;
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
echo "<img src=images/".$arrayp['carPicNameLarge']." height=400 width=300>";
//close the anchor
echo "</a>";
echo "</td>";
echo "<td style='border: 0px'>";
echo "<p><h5>".$arrayp['carName']."</h5>"; //display product name as contained in the array
echo "<p><h6>".$arrayp['carDescripLong']."</h6>";
echo "<p><h6>$".$arrayp['carPrice']."</h6>";
echo "<p><h6>Number left in stock: ".$arrayp['carQuantity']."</h6>";
echo "<p>Number to be purchased: ";
//create form made of one text field and one button for user to enter quantity
//the value entered in the form will be posted to the basket.php to be processed
echo "<form action=basket.php method=post>";
echo "<select name=p_quantity style='width:40px;'>";
for($x=1;$x<=$arrayp['carQuantity'];$x++){
echo "<option value= ".$x.">".$x." </option>";
}
echo "</select>";
echo "<input type=submit value='ADD TO BASKET'>";
//pass the product id to the next page basket.php as a hidden value
echo "<input type=hidden name=h_prodid value=".$prodid.">";
echo "</form>";
echo "</td>";
echo "</tr>";
}
echo "</table>";
include("footfile.html"); //include head layout
echo "</body>"; 
?>