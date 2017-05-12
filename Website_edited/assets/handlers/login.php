<?php
#	Intermediary page which logs the user in if provided existing account info,
#	returns the user to the starting page if provided a known username and
#	incorrect password, or creates a new account for the user if provided entirely
#	new information.
include('common.php');
ensureLoggedOut();

#go to parent directory
$api_key = '5425ff73-a599-4751-8759-7e170e730717';

#if these values are not null
if (isset($_POST['name']) && isset($_POST['password'])) {
	$client_id = $_POST['name'];
	$client_secret = sha1($_POST['password']);
	$claim = array('user'=>'', 'request'=>'');
	
	$claim['user'] = $client_id;
	$claim['request'] = 'token';
	
	$data = json_encode($claim);
	$token = makeToken($data,$client_secret); 

	$url = '/ss_administrator/index.php?request='.$api_key.'/auth/'.$token;
	#$result = file_get_contents('/ss_administrator/index.php?request='.$api_key.'/auth/.'.$token);
	$result = curl_request($url);
	$result = json_decode($result,true);
	if(isset($result['error'])){
		#Error in Loggin in Display on page
		$GLOBALS['error'] = $result['error'];
		echo $result['error'];
	}
	$result = json_decode($result,true);
	#if(isset(!$result['token'])){
		#echo $result['token'];
	setcookie('token',$result['token'],date()+3600);
	#setcookie('logTime',$result['created']);
	setDate();
	#if(isset($_COOKIE['cookie']) && isset($_COOKIE['logTime'])){
	header('Location: /index.php?base=schedule');
	#} else {
	#	$GLOBALS['error'] = 'Unable to retrive token.';
	#}
		#setcookie('Token',$result['token'],time()+$result['exptToken']);
		#setcookie('rToken',$json['rToken'],time()+$json['exprToken']);
	#} else {
		#Error
		#header('Location: /index.php');
	#	echo $result['token'];
	#	header('Location: /assets/handlers/test.php');
	#}
}


# Kills the page if provided improper input, else gives detailed description of what went wrong
function checkProperInput($name, $password) {
	# check if username is alphanumeric, lowercase, and 3-20 characters long
	if (preg_match('/^[a-z0-9]{3,20}$/', $name) == 0 ||
		# check if password begins with number, ends with special char, and is 6-12 chars long
		# ^ ignore that, just check if the password is 3-20 chars long, otherwise it's all fair game.
		// preg_match('/^[0-9].{4,10}[^a-z0-9]$/i', $password) == 0) {
		preg_match('/^.{3,20}$/i', $password) == 0) {
		die('Invalid input - username or password does not match specifications. You entered: "'
			. $name . ':' . $password . '" What we got from that was: "'
			. preg_match('/^[a-z0-9]{3,8}$/', $name) . ':'
			. preg_match('/^[0-9].{4,10}[^a-z0-9]$/i', $password)
			. '" (1:1 would have passed)');
	}
}

# Sets a cookie touch(filename) store the exact time of a succesful login
function setDate() {
	date_default_timezone_set('America/Los_Angeles');
	$date = date("D y M d, g:i:s a");
	# set expire time to one week
	$expireTime = time() + 60*60*24*7;
	setcookie('date', $date, $expireTime);
}
?>