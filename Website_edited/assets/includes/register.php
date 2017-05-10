<?php
#remove
if(basename($_SERVER["PHP_SELF"]) == "register.php") {
	die("403 - Access Forbidden");
}
?>


<!DOCTYPE html>

		<div id="main">
		
		<center>
			<p>
				The easiest way to start a study group. <br />
				Provided at least a couple people are using this service, anyway...
			</p>

			<p>
				Register now and connect with your Identikey for your information to be filled out automatically. <br />
				No grades or personal information will be used or stored, only class info.
			</p>

			<form id="register_form" action="/../handlers/register.php" method="post">
				<div> <strong>User Name</strong><input name="name" type="text" size="32" autofocus="autofocus" /></div>
				<div><strong>Password</strong><input name="password" type="password" size="32" /> </div>
				<div><strong>Repeat Password</strong><input name="password2" type="password" size="32" required/> </div>				
				<div><strong>Email</strong><input name="email" type="password" size="8" /> </div>
				<div><strong>Birthday</strong></br><input name="birthday" type="date" size="8" /> </div>
				<div><p>By creating an account you agree to our <a href="#">Terms & Privacy(COMMING SOON)</a>.</p></div>
				<div class="clearfix">
					<button type="submit" value="register"/>Sign Up</button>
					<button type="button"  class="cancelbtn">Cancel</button>
				</div>
			</form>
			
		</center>
		</div>