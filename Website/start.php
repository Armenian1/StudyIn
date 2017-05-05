<?php
#	Login page for a website which provides a common base to find study groups at CU Boulder
session_start(); # added, working before
include('common.php');
ensureLoggedOut();
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>StudyIn</title>
		<link href="studyin1.css" type="text/css" rel="stylesheet" />
		<link href="http://www.colorado.edu/oit/sites/all/themes/cassowary/images/logo-highres.png" type="image/ico" rel="shortcut icon" />
	</head>

	<body>
		<div class="headfoot">
			<img id="buff" src="http://carshare.org/2016dev/wp-content/uploads/2013/10/CU-Buffs.png" alt="logo" />
			<h1>
				StudyIn<br />CU Boulder
			</h1>
		</div>

		<div id="main">
			<p>
				The easiest way to start a study group. <br />
				Provided at least a couple people are using this service, anyway...
			</p>
			<br /><br />
			<p>
				Log in with your CU Identikey for your information to be filled out automatically. <br />
				No grades or personal information will be used or stored, only class info.
			</p>
			<br />
			<form id="loginform" action="login.php" method="post">
				<div><input name="name" type="text" size="20" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="20" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>

			<p>
				<em>(last login from this computer was <?= $_COOKIE['date'] ?>)</em>
			</p>
		</div>

		<div class="headfoot">
			<br />
			<p>
				StudyIn is nice, Best thing ever invented for Students.</q> - PCWorld
			</p>
			<br />
			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php">
					<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php">
					<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div>
	</body>
</html>
