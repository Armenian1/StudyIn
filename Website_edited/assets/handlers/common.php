<?php
#ADD API KEY TO REQUEST
#ADD THINGS TO REQUEST

#URL FOR API
$api_url = "../../ss_administrator/index.php";
$APIKey = "5425ff73-a599-4751-8759-7e170e730717";

$tok_Header = array('alg'=>"HS256", 'typ'=> "JWT");


$json_head = json_encode($tok_Header);

$json = $json_head;
#Common functionality for all pages that form the StudyIn website
# Ensures that there is an existing cookie with a valid token
# to the login page
function ensureLoggedIn() {
	//if logged in
	if(isset($_COOKIE['tToken']) and isset($_COOKIE[rToken])){
		$tToken = $_COOKIE['tToken'];
		$rToken = $_COOKIE['rToken'];
		header('Location: ../../index.php');
	}
}

# Ensures that there is no existing session with the current user, otherwise redirects
# to the main website.
function ensureLoggedOut() {
	if(!isset($_COOKIE['tToken']) and !isset($_COOKIE[rToken])){
		//go home
		header('Location: ../../index.php');
	}
}

function makeToken($cliam, $secret){
	$claim ->apiKey = $APIKey;
	$signiture = hash_hmac("sha256",$json_head  + "." + base64UrlEncode($cliam),$secret);
	return $json_head  + "." + base64UrlEncode($claim) + "." + $signiture;
}

#checks if token is expired
#function checkTokenLife(type){
#	if(type == 'refresh'){
#		$_COOKIE['tTMake']
#	}else{
		
#	}
	
#	if(isset($_COOKIE['t']

#}
?>
