<?php

include_once 'sql.php';

// fetching and validating the enrollment no
if(!isset($_POST['er_no']) || empty($_POST['er_no']))
{
	header("Location: index.php?err_messg_sign=The enrollment number can't be left blank"); //redirecting to the registration page with a error message
}





// Assigning the value to the Er_no
if(isset($_POST['er_no']) && !empty($_POST['er_no']) &&  strlen($_POST['er_no'])==6 && is_numeric($_POST['er_no']))
{
	$er_no=htmlentities(strtolower($_POST['er_no']));
}
else
{
	header("location: index.php?err_messg_sign=Invalid Enrollment Number");
}





// fetching and validating First Name and last name
if(!isset($_POST['f_name']) || !isset($_POST['l_name']) || empty($_POST['f_name']) || empty($_POST['l_name']))
{
	header("location: index.php?err_messg_sign=The name releated fields couldn't be left blank!");
}



// Assigning the value to First name and the last name
if(isset($_POST['f_name']) && !empty($_POST['f_name']) && isset($_POST['l_name'])&& !empty($_POST['l_name']) && strlen($_POST['f_name'])<=20 && strlen($_POST['f_name'])<=20 )
{
	$f_name=htmlentities(strtoupper($_POST['f_name']));
	$l_name=htmlentities(strtoupper($_POST['l_name']));
}
else
{
	header("Location: index.php?err_messg_sign=Invalid Name Entries!!");
}

// Fetching and validating the E-mail Address
if(!isset($_POST['e_mail']) && empty($_POST['e_mail']))
{
	header("location: index.php?err_messg_sign=E-mail Field couldnot be left blank"); //redirecting to the registration page with a error message
}
else
{
	$email=htmlentities($_POST['e_mail']);
}
 
//Assigning and fetching the Phone Number
if(!isset($_POST['ph_no']) || empty($_POST['ph_no']))
{
	header("location: index.php?err_messg_sign=Please provide with phone number"); //redirecting to the registration page with a error message
}


//Validating the Phone Number
if(isset($_POST['ph_no']) && !empty($_POST['ph_no']) && is_numeric($_POST['ph_no']) && strlen($_POST['ph_no'])==10)
{
	$ph_no=htmlentities(strtolower($_POST['ph_no']));
}
else
{
	header("location: index.php?err_messg_sign=Invalid Phone Number");
}


//Assigning and fetching the Password
if(!isset($_POST['psswd']) || empty($_POST['psswd']))
{
	header("Location: index.php?err_messg_sign=Password field could not be left blank"); //redirecting to the registration page with a error message
}
else
{
	$psswd=md5(htmlentities($_POST['psswd']));
}


//Fetching the ip address
function get_ip_address()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
					return $ip;
                }
            }
        }
    }
}
$ip_addr=get_ip_address();



//Assigning score 0 at the time of the new registaraion
$score = 0;


//Assigning the value to the timestamp to the time.
//$time=time();


//Creating the Userid
$userid='TSH'.rand(100,999).substr($er_no,-3);


//Sql Query 
if(!empty($er_no)&&!empty($f_name)&&!empty($l_name)&& !empty($email) && !empty($ph_no) && !empty($psswd))
{
	$query="INSERT INTO users(Er_no,F_name,L_name,E_mail,Ph_no,Psswd,Ip_addr,Score,User_id) VALUES ('".$er_no."','".$f_name."','".$l_name."','".$email."','".$ph_no."','".$psswd."','".$ip_addr."','".$score."','".$userid."')";
	if(mysqli_query($con,$query))
	{
		include_once 'core.inc.php';
		
		$_SESSION['er_no']=$er_no;
		header("Location: quiz/index.php");
	}
	else
	{
		header('Location: index.php?err_messg_sign=Already a player with the user id.');
	}
}
else
{
	header('Location: index.php?err_messg_sign=All fields are mandatory.');
}
?>