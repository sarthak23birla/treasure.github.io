
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
			$query4="SELECT * FROM blocked WHERE user='".$er_no."'";
			$Third_query=mysqli_query($con,$query4);
			$num_rows=mysqli_num_rows(mysqli_query($con,$query4));
			if($num_rows==0)
			{
				
				$query1="SELECT User_id,Score FROM users WHERE Er_No='".$er_no."'";
				$first_query=mysqli_query($con,$query1);
				$ro1=mysqli_fetch_assoc($first_query);
				$score=$ro1["Score"];
				$user_id=$ro1["User_id"];
				$query2="SELECT name FROM question WHERE que_id='".$score."'";
				$Seconed_query=mysqli_query($con,$query2);
				$ro2=mysqli_fetch_assoc($Seconed_query);
				$name=$ro2["name"];
				$img_path="Ques/".$name;
			}
			else
			{
				die('You have been blocked from the play');
			}
	}
?>

<!DOCTYPE HTML>

<html>
	<head>
	    <!--<link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Trade+Winds' rel='stylesheet' type='text/css'>-->
<link rel="stylesheet" href="bootstrap.css"/>	
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		
	</head>
	<body>
			<div id="bg"></div>
		<p style="position:absolute;left:50%;top:3%;"><label style="color:white;">Name:<?php echo $user_id?></label><label></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color:white;">Score:<?php echo $score?></label><label></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color:white;"><a href='logout.php' style="color:#fff;text-decoration:none;">Logout</a></label></p>
	
			<div id="wrapper" style="height:auto;">


				<!-- Main -->
					<div id="main" style="background:rgba(1,1,1,0.6);margin-top:-100px;">

						<!-- Me -->
							

						<!-- Work -->
							<article id="work" class="panel">
								<header>
									<!--h2>Hunt</h2---->
								</header>
								<center>
									<h2 style="color:white;font-family:quicksand; font-size:1.7em;">Thank you for your participation!!</h2>
								</center>
							</article>
							
								</header>
								<form action="#" method="post">
									<div>
										<div class="row">
											
										</div>
									</div>
								</form>
							</article>

					</div>

					<div id="footer">
					</div>

			</div>

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
            <script src="jquery-2.2.3.min.js" ></script>
			<script src="../right_click_disable.js" ></script>
<script src="bootstrap.js" ></script>
	</body>
</html>