<?php
if(isset($_SESSION['userid'])){
	if($_SESSION['usertype']=='a'){
		echo "<p style='float:right'>".$_SESSION['userfname']." / Administrator No:".$_SESSION['userid']."</p><br>";
	}
	else{
			
		echo "<p style='float:right'>".$_SESSION['userfname']." / customer No:".$_SESSION['userid']."</p><br>";
	}

}else{
	echo "<p style='float:right'>not set</p>";
}

?>