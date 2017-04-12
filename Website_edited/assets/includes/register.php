<?php
#remove
if(basename($_SERVER["PHP_SELF"]) == "login.php") {
	die("403 - Access Forbidden");
}

#	Login page for a website which provides a common base to find study groups at CU Boulder
session_start(); # added, working before
include('common.php');
ensureLoggedOut();
?>


<!DOCTYPE html>
		<div class="headfoot">
			<img id="buff" src="http://carshare.org/2016dev/wp-content/uploads/2013/10/CU-Buffs.png" alt="logo" />
			<h1>
				StudyIn<br />CU Boulder Register
			</h1>
		</div>

		<div id="main">
			<p>
				The easiest way to start a study group. <br />
				Provided at least a couple people are using this service, anyway...
			</p>

			<p>
				Log in with your CU Identikey for your information to be filled out automatically. <br />
				No grades or personal information will be used or stored, only class info.
			</p>

			<form id="register_form" action="login.php" method="post">
				<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>

			<p>
				<em>(last login from this computer was <?= $_COOKIE['date'] ?>)</em>
			</p>
		</div>