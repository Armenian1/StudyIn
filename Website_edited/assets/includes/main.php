<?php
if(basename($_SERVER["PHP_SELF"]) == "main.php") {
	die("403 - Access Forbidden");
}
#header('Location: ../assets/handlers/login.php');
?>

		<div id="main">
			<center>
			<img id="banner" src="http://www1.toronto.ca/City%20Of%20Toronto/City%20Clerks/Elections/Library/Images/library_banner_1140_1140X225.jpg" alt="ban" />
			<p>
				The easiest way to start a study group. <br />
				Provided at least a couple people are using this service, anyway...
			</p>

			<p>
				Log in with your CU Identikey for your information to be filled out automatically. <br />
				No grades or personal information will be used or stored, only class info.
			</p>
			</center>
			<form id="loginform" action="../assets/handlers/login.php" method="post">
				<div> <strong>User Name</strong><input name="name" type="text" size="8" autofocus="autofocus" /></div>
				<div><strong>Password</strong><input name="password" type="password" size="8" /> </div>
				<div><input type="submit" value="Log in" /></div>
			</form>
		</div>

