<?php
#ADD API KEY TO REQUEST
#ADD THINGS TO REQUEST

#URL FOR API
$api_url = "../../ss_administrator/index.php";
$APIKey = "5425ff73-a599-4751-8759-7e170e730717";

$tok_Header = array('alg'=>"HS256", 'typ'=> "JWT");


$json_head = json_encode($tok_Header);

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

function base64encodeURL($string){
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}

function base64decodeURL($string) { 
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

function makeToken($cliam, $secret){
	$signiture = hash_hmac("sha256",base64encodeURL($json_head)  + "." + base64encodeURL($cliam),$secret);
	return $json_head  + "." + base64UrlEncode($claim) + "." + $signiture;
}

function makeLoginToken($claim){
	return $json_head  + "." + base64UrlEncode($claim);
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
