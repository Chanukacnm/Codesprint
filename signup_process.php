<?php
session_start();
include("db.php");
$pagename="Your Signup Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//Capture the 7 inputs entered in the the 7 fields of the form using the $_POST superglobal variable
//Store these details into a set of 7 new local variables
if(isset($_POST['firstname']))
{
	
	$fname=$_POST['firstname']; 
	$sname=$_POST['lastname']; 
	$address=$_POST['address']; 
	$tel=$_POST['telno']; 
	$email=$_POST['email']; 
	$password=$_POST['password']; 
	$confirmpassword=$_POST['confirmpassword']; 
}



//if(!(empty($fname)||empty($sname)||empty($address)||empty($pcode)||empty($tel)||empty($email)||empty($password)))
if(!(empty($fname)||empty($sname)||empty($address)||empty($tel)||empty($email)||empty($password)))
{
	if($password != $confirmpassword)
	{
		echo "Passwords Not Matching";
		echo "<a href=signup.php>Return to Sign Up</a>";
	}
	else
	{
		$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
		//if (preg_match($pattern, $email)
		if(preg_match($pattern, $email))
		{
			$sql_e = "SELECT * FROM users WHERE userEmail ='".$email."'";
			$res_e = mysqli_query($conn, $sql_e);
			if (mysqli_num_rows($res_e) > 0) {
				echo "Sorry... username already taken"; 
			}
			else{
				$SQL="INSERT into users (userFName,userSName,userAddress,userTelNo,userEmail,userPassword,userType)VALUES('$fname','$sname','$address','$tel','$email','$password','c')";
				$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
				$errorNo=mysqli_errno($conn);
				echo("<script>console.log('PHP: " . $errorNo . "');</script>");
				if($errorNo== 0)
				{				
					echo "Your Registration is Successful";
					echo "<br><br>";
					echo "<a href=login.php>Please Log In</a>";
				}
				else
				{
					if($errorNo==1062)
					{	
						echo "<p>Email has already been taken";
						echo "<p> Go back to <a href='signup.php'>sign up</a>";
					}
					if ($errorNo==1064) 
					{
						echo "<p>Invalid characters such as ' and \ have been entered.";
						echo "<p> Go back to <a href='signup.php'>sign up</a>";
					}
				}				
			}
						
		}
		else
		{
			echo "<p><b> Sign-up failed!</b>";
			echo "<p> Email not valid";
			echo "<p> Make sure you enter a correct email address";
			echo "<p> Go back to <a href='signup.php'>sign up</a>";
		}
		
	}
}
else
{
	//Display "all mandatory fields need to be filled in " message and link to register page
	echo "<p><b> Sign-up failed!</b>";
	echo "<p> Your signup form is incomplete and all fields are mandatory";
	echo "<p> Make sure you provide all the required details";
	echo "<p> Go back to <a href='signup.php'>sign up</a>";
}	

include("footfile.html"); //include head layout
echo "</body>"; 
?>