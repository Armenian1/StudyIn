<?php
#remove
#if(basename($_SERVER["PHP_SELF"]) == "register.php") {
#	die("403 - Access Forbidden");
#}
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
			<?php 
			if(isset($json)){
				#echo '<p style="color: red">'.'Error: '.$json['error'].'</p>';
				if(isset($json['error'])){
					echo '<p style="color: red">'.'Error: '.$json['error'].'</p>';
					#clear error after display
					#unset($GLOBALS['error']) ;
				} else {
					#$json = json_decode($json, true);
					if(isset($json['token'])){
						setcookie('token', $json['token'], $json['token_exp']);
						setcookie('timelog', $json['created']);
						header('Location: /index.php?base=schedule');
					} else {
						echo '<p style="color: red">'.'Error: Creating account contact web admin if problem persists.</p>';
					}
				}
			}
			?>

			<form id="register_form" action="../assets/handlers/registerh.php" method="post">
				<div> <strong>User Name</strong><input name="name" type="text" size="32" autofocus="autofocus" /></div>
				<div><strong>Password</strong><input name="password" type="password" size="32" /> </div>
				<div><strong>Repeat Password</strong><input name="password2" type="password" size="32" required/> </div>				
				<div><strong>Email</strong><input name="email" type="text" size="32" /> </div>
				<div><strong>Birthday</strong></br><input name="birthday" type="date" size="8" /> </div>
				<div><p>By creating an account you agree to our <a href="#">Terms & Privacy(COMMING SOON)</a>.</p></div>
				<div class="clearfix">
					<button type="submit" value="register"/>Sign Up</button>
					<button type="button"  class="cancelbtn">Cancel</button>
				</div>
			</form>
			
		</center>
		</div>