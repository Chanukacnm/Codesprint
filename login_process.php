<?php
session_start();
include("db.php");
$pagename="Your Log In Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$email=$_POST['email']; 
$password=$_POST['password']; 
//if both mandatory email and password fields in the form are not empty (hint: use the empty function)
if(!(empty($email)||empty($password))){
//SQL query to retrieve the record from the users table for which the email matches $email (entered by user)
//execute the SQL query & fetch results of the execution of the SQL query and store them in $arrayu\
$SQL="SELECT * FROM users WHERE userEmail='".$email."' ";
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
$arrayu=mysqli_fetch_array($exeSQL);
//if email retrieved from the database (in arrayu) does not match $email
	if(!($arrayu['userEmail'] == $email))
	{
	echo "<b>Login Failed!</b>";
	echo "<br><br>";
	echo "Email not recognised , <a href=login.php> login again";
	}
	else if(!($arrayu['userPassword'] == $password))//if password retrieved from the database (in arrayu) does not match $password
	{
	echo "<b>Login Failed!</b>";
	echo "Password not recognised, login again";
	}
	else
	{
	echo "<b>Successful Login</b>";
	
	$_SESSION['userid']=$arrayu['userId'];
	$_SESSION['usertype']=$arrayu['userType'];
	$_SESSION['userfname']=$arrayu['userFName'];
	$_SESSION['usersname']=$arrayu['userSName'];
	
	if($arrayu['userType']== 'a'){
		echo "<h3>WELCOME! Admin ".$arrayu['userFName']."</h3>";
		echo "<a href=index.php> Home";
	}
	else{
		echo "<h3>WELCOME! User ".$arrayu['userFName']."</h3>";
		echo "<a href=index.php> Home";
	}
	
	
	}
}
else
{
	echo "Both email and password fields need to be filled in";
	echo "<a href=login.php>Return to Login</a>";
}
include("footfile.html"); //include head layout
echo "</body>"; 
?>