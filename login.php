<?php
require 'sql.php';
require 'core.inc.php';


//Sql query to fetch the password of the input Enrollment No.
if(!isset($_POST['er_no']) || empty($_POST['er_no']))
{
	header("location: index.php?err_messg=Enter the Enrollment Number"); //redirecting to the registration page with a error message
}

// Assigning the value to the Er_no
if(isset($_POST['er_no']) && !empty($_POST['er_no']) &&  strlen($_POST['er_no'])==6 && is_numeric($_POST['er_no']))
{
	$er_no=htmlentities(strtolower($_POST['er_no']));
}
else
{
	header("Location: index.php?err_messg=Invalid Enrollment Number");
}

//Assigning and fetching the Password
if(!isset($_POST['psswd']) || empty($_POST['psswd']))
{
	header("Location: index.php?err_messg=Please Provide Your Password"); //redirecting to the registration page with a error message
}
else
{
	$psswd=md5(htmlentities($_POST['psswd']));
}

$query ="SELECT Er_No,Psswd from users WHERE Er_No='".$er_no."' AND Psswd='".$psswd."'";
	if($query_run = mysqli_query($con,$query))
	{
		$query_num_rows= mysqli_num_rows($query_run);
		if($query_num_rows==0)
		{
				header('Location: index.php?err_messg=Invalid username or password');
		}
		else if ($query_num_rows==1)
		{
			$_SESSION['er_no']=$er_no;
			header('Location: quiz/index.php');
		}
	}
	else
	{
		die("Could not process your login request.");
	}
?>