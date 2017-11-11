<?php
	require 'core.inc.php';
	require 'sql.php';
	$er_no=$_SESSION['er_no'];
	if(!isset($_SESSION['er_no'])&& empty($_SESSION['er_no']))
	{
		header("location: ../index.php?err_messg=You are not logged in.");
	}
	else
	{
			$query1="SELECT Score FROM users WHERE Er_No='".$er_no."'";
			$first_query=mysqli_query($con,$query1);
			$ro1=mysqli_fetch_assoc($first_query);
			$score=$ro1["Score"];
			$query2="SELECT answer1,answer2,answer3,answer4,answer5 FROM question WHERE que_id='".$score."'";
			$Seconed_query=mysqli_query($con,$query2);
			$ro2=mysqli_fetch_assoc($Seconed_query);
			$ans1=$ro2["answer1"];
			$ans2=$ro2["answer2"];
			$ans3=$ro2["answer3"];
			$ans4=$ro2["answer4"];
			$ans5=$ro2["answer5"];
			if(!isset($_POST['answer']) || empty($_POST['answer']))
			{
				header('Location: index.php');
			}
			else
			{
				$ans=htmlentities(strtolower($_POST['answer']));
				function get_ip_address()
				{
					foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)
					{
					if (array_key_exists($key, $_SERVER) === true)
					{
						foreach (explode(',', $_SERVER[$key]) as $ip)
						{
						$ip = trim($ip); // just to be safe
						if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
							{
									return $ip;
							}
						}
					}
					}
				}
				$ip=get_ip_address();
				$query4="INSERT INTO submission (er_no,que_id,ans,ip) VALUES ('".$er_no."','".$score."','".$ans."','".$ip."')";
				mysqli_query($con,$query4);
				if($ans == $ans1 || $ans==$ans2 || $ans == $ans3 || $ans==$ans4 || $ans==$ans5)
				{
					$time=time()+12780;
					$score=$score+1;
					$actual_time=date('Y-m-d H:i:s',$time);
					$query3="UPDATE users SET Score='".$score."',Time='".$actual_time."' WHERE er_no='".$er_no."'";
					mysqli_query($con,$query3);
					header("Location: index.php");
				}
				else
				{
					header('Location: index.php');
				}
			}
	}
?>