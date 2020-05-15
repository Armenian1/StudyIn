<?php
if(basename($_SERVER["PHP_SELF"]) == "main.php") {
	die("403 - Access Forbidden");
}
#header('Location: ../assets/handlers/login.php');
#session_start();
?>

		<div id="main">
			<center>
			<img id="banner" src="http://www1.toronto.ca/City%20Of%20Toronto/City%20Clerks/Elections/Library/Images/library_banner_1140_1140X225.jpg" alt="ban" />
			<p>
				The easiest way to start a study group. <br />
				Provided at least a couple people are using this service, anyway...
			</p>

			<p>
				Enter your class schedule and find others with similar study times. <br />
				Or enter your non-class schedule and find who is free for whatever purpose at whatever time. <br />
				Come to think of it, why has nobody added social functionality to a basic calendar?
			</p>
			<?php 
			if(isset($json)){
				if(isset($json['error'])){
					echo '<p style="color: red">'.'Error: '.$json['error'].'</p>';
					#clear error after display
					#unset($GLOBALS['error']) ;
				} else {
					$json = json_decode($json, true);
					if(isset($json['token'])){
						setcookie('token', $json['token'], $json['token_exp']);
						setcookie('timelog', $json['created']);
						header('Location: /index.php?base=schedule');
					}
				}
			}
			?>
			
			</center>
			<form id="loginform" action="../assets/handlers/login.php" method="post">
				<div> <strong>User Name</strong><input name="name" type="text" size="8" autofocus="autofocus" /></div>
				<div><strong>Password</strong><input name="password" type="password" size="8" /> </div>
				<div><input type="submit" value="Log in" /></div>
			</form>
		</div>

