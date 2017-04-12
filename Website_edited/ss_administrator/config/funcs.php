<?php
require_once("assets/config/database.php");

if(basename($_SERVER["PHP_SELF"]) == "funcs.php") {
	die("403 - Access Forbidden");
}

function getRealIpAddr() {
	//check ip from share internet
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	//to check ip is pass from proxy
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function ago($time) {
	$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60","60","24","7","4.35","12","10");
	$now = time();
	$difference  = $now - $time;
	$tense = "ago";
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}
	$difference = round($difference);
	if($difference != 1) {
		$periods[$j].= "s";
	}
	return "$difference $periods[$j] ago";
}

function login() {
	if(empty($_POST['username'])) {
		$this->HandleError("UserName is empty!");
		return false;
	}
	if(empty($_POST['password'])) {
		$this->HandleError("Password is empty!");
		return false;
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(!$this->CheckLoginInDB($username,$password))
	{
		return false;
	}
	#return token to client
	session_start();
	$_SESSION['sec_token'] = getToken($timestamp);
	return true;
}

function checkLoginInDB($username)
{
	if(!$this->DBLogin()) {
		$this->HandleError("Database login failed!");
		return false;
	}          
	$username = $this->SanitizeForSQL($username);
	$pwdsha1 = sha1($password);
	
	$qry = $mysqli->prepare("SELECT * FROM accounts WHERE accounts.user = ? AND accounts.password = ?");
	$qry->bind_param("s", $pwdsha1);

	$result = mysql_query($qry,$this->connection);
	if(!$result || mysql_num_rows($result) <= 0) {
		$this->HandleError("Error logging in. "."The username or password does not match");
		return false;
		$mysqli->close();
	}
	#generate token and add token and Creation date
	#return true;
	return getSecret();
}



function checkSigniture($head,$payload,$signiture){

	$qry = $mysqli->prepare("SELECT * FROM accounts WHERE accounts.user");
	$qry->bind_param("s", $user);
	
	$secret = $result();
	if($signiture === hash_hmac($head,$payload,$secret)){
		return true;
	}
	return false;
}

function getToken() {
	$max = ceil($len /32);
	$sec = '';
	for($i = 0; $i < $max; $i++){
		$sec .= md5(microtime(true.mt_rand(10000,90000));
	}
	$sec = substr($sec,0,$len);
	#store secret in database
	$qry = $mysqli->prepare("SELECT * FROM accounts WHERE accounts.user = ? AND sha1 = ?");
	$qry->bind_param("s", $sec);
	$mysqli->close();
    return $sec;
}

function refreshToken(){
}

function checkToken(){
	checkSigniture();
	checkIp();
	checkExpToken();
	session_start();
	if(empty($_SESSION['sec_token'])) {
		return false;
	}
	#check if token is real
	#check if token is expired
	#check ip adress that comes with token
	
	#otherwise return true
	return true;
}

$mysqli->close();
?>