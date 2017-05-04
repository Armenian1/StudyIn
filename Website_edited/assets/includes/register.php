<?php
#remove
if(basename($_SERVER["PHP_SELF"]) == "register.php") {
	die("403 - Access Forbidden");
}

#	Register page for a website which provides a common base to find study groups at CU Boulder
session_start();
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
				Register now and connect with your Identikey for your information to be filled out automatically. <br />
				No grades or personal information will be used or stored, only class info.
			</p>

			<form id="register_form" action="/../handlers/register.php" method="post">
				<div><input name="name" type="text" size="32" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="32" /> <strong>Password</strong></div>
				<div><input name="password2" type="password" size="32" required/> <strong>Repeat Password</strong></div>				
				<div><input name="birthday" type="text" size="8" /> <strong>Password</strong></div>
				<div><input name="email" type="password" size="8" /> <strong>Email</strong></div>
				<div><p>By creating an account you agree to our <a href="#">Terms & Privacy(COMMING SOON)</a>.</p></div>
				<div class="clearfix">
				  <button type="button"  class="cancelbtn">Cancel</button>
				  <button type="submit" value="register"/>Sign Up</button>
				</div>
			</form>
		</div>