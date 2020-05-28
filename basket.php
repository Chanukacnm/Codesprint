<?php
session_start();
include("db.php");
$pagename="Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//if the value of the product id to be deleted (which was posted through the hidden field) is set  
if(isset($_POST['c_prodid'])){
	$delprodid=$_POST['c_prodid'];
	unset($_SESSION['basket'][$delprodid]);
	echo "<p>1 Item Removed From The Basket</p>";
}
//capture the posted product id and assign it to a local variable $delprodid  
//unset the cell of the session for this posted product id variable  
//display a "1 item removed from the basket" message 
 
//echo "<p>The doc id ".$newdocid." has been ".$_SESSION['basket'][$newdocid];


//if the posted ID of the new product is set i.e. if the user is adding a new product into the basket 
 if(isset($_POST['h_prodid'])){
$newprodid=$_POST['h_prodid']; 
$reququantity=$_POST['p_quantity']; 
echo "<p>Selected Product Id : ".$newprodid."</p>";
echo "<p>Selected Product Quantity : ".$reququantity."</p>";
$_SESSION['basket'][$newprodid]=$reququantity; 
 echo "<p>1 item added to Basket"; 
}else{
 echo "<p>Current Basket Unchanged</p>"; 
}


//Create a HTML table with a header to display the content of the shopping basket  
//i.e. the product name, the price, the selected quantity and the subtotal 
echo "<table style='width:100%'>
  <tr>
    <th>Product Name</th>
    <th>Price</th> 
    <th>Selected Quantity</th>
	<th>Subtotal</th>
	<th></th>
  </tr>";
  if(isset($_SESSION['basket'])){
	  
	 $total=0; 
	   foreach($_SESSION['basket'] as $index => $value){
		    $SQL="select carName,carPrice from items WHERE carId =".$index;
			$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
			$arrayp=mysqli_fetch_array($exeSQL);
			$subtotal=$arrayp['carPrice'] * $value;
			$total+=$subtotal;

			echo " <tr>
				<td>".$arrayp['carName']."</td>
				<td>".$arrayp['carPrice']."</td>
				<td>".$value."</td>
				<td>".$subtotal."</td>
				<td>
				<form action=basket.php method=post>
				<input type=hidden name=c_prodid value=".$index.">
				<input type=submit value='REMOVE'>
				</form>
				</td>
			</tr>";
	   }
	   echo "
	  <tr>
	  <td colspan='3' >Total</td>
	  <td>".$total."</td>
	  <td></td>
	  </tr>";
	   
  }else{
	  echo"
	  <tr>
	  <td colspan='5'>
	  Please add to basket
	  </td>
	  </tr>";
  }
  
  
echo "</table>";

 
//if the session array $_SESSION['basket'] is set { 




//loop through the basket session array for each data item inside the session using a foreach loop  
//to split the session array between the index and the content of the cell 
//for each iteration of the loop 
//store the id in a local variable $index & store the required quantity into a local variable $value {   
//SQL query to retrieve from Product table details of selected product for which id matches $index   
//execute query and create array of records $arrayp   
//create a new HTML table row   
//display product name using array of records $arrayp    
//display product price using the array of records $arrayp  
 //display selected quantity of product retrieved from the cell of session array and now in $value  
 //calculate subtotal, store it in a local variable $subtotal and display it   
//increase total by adding the subtotal to the current total } 
// Display total } 
//else {  
//Display empty basket message } 



echo"<br>";
echo "<a href=clearbasket.php>Clear Basket</a>";
	if(isset($_SESSION['userid']))
	{
		echo "<p>Done shopping? </p><a href='checkout.php'>Check Out</a>";
	}
	else
	{
		echo "<p>New to Hometeq ?  <a href='signup.php'> Sign In</a> </p>";
		echo "<p>Already a Customer ?  <a href='login.php'> Log In</a> </p>";
	}

include("footfile.html"); //include head layout
echo "</body>"; 
?>