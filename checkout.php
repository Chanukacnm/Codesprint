<?php
session_start();
include("db.php");
$pagename="Order Confirmation"; 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; 
echo "<title>".$pagename."</title>"; 
echo "<body>";
include ("headfile.html"); 
include("detectlogin.php");
echo "<h4>".$pagename."</h4>"; 
$currentdatetime =date('Y-m-d H:i:s');

$SQL="INSERT into orders (userId,orderDateTime) VALUES(".$_SESSION ['userid'].",'$currentdatetime')";
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

if(mysqli_errno($conn)== 0)
{

    $SQL="SELECT MAX(orderNo) As orderNum FROM orders WHERE userId =".$_SESSION ['userid'];
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
    $arrayord=mysqli_fetch_array($exeSQL);
    $orderNum = $arrayord['orderNum'];
    echo "<b>Successful Order</b>. ORDER REFERENCE NO: ".$orderNum;
    echo "<table style='width:100%'>
    <tr >
    <th>Product Name</th>
    <th>Price</th> 
    <th>Selected Quantity</th>
	<th>Subtotal</th>
    </tr>";
    if(isset($_SESSION['basket'])){
        $total=0; 
          foreach($_SESSION['basket'] as $index => $value){
               $SQL="select carName,carPrice from items WHERE carId =".$index;
               $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
               $arrayb=mysqli_fetch_array($exeSQL);
               $subtotal=$arrayb['carPrice'] * $value;

               $SQL="INSERT into order_line (orderNo,prodId,quantityOrdered,subTotal) VALUES('$orderNum','$index','$value','$subtotal')";
               $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));


               $total+=$subtotal;
   
               echo " <tr>
                   <td>".$arrayb['carName']."</td>
                   <td>".$arrayb['carPrice']."</td>
                   <td>".$value."</td>
                   <td>".$subtotal."</td>
                   </tr>";
          }
          echo "
         <tr>
         <td colspan='3' >Order Total</td>
         <td>".$total."</td>
         </tr>";
        $SQL="Update orders SET orderTotal=$total WHERE orderNo =$orderNum";
        $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn)); 
     }else{
         echo"
         <tr>
         <td colspan='4'>
         Basket is empty
         </td>
         </tr>";
     }
     
     
   echo "</table>";
   echo "<p>To logout and leave the system <a href='logout.php'> Logout</a> </p>";
   
    }
   else
    {
    echo "There has been an ERROR with placing the order";
    }
    unset($_SESSION['basket']);

include("footfile.html"); 
echo "</body>"; 
?>