<?php
#ADD API KEY TO REQUEST
#ADD THINGS TO REQUEST

#URL FOR API
$api_url = "../../ss_administrator/index.php";
$APIKey = "5425ff73-a599-4751-8759-7e170e730717";

#Common functionality for all pages that form the StudyIn website
# Ensures that there is an existing cookie with a valid token
# to the login page
function ensureLoggedIn() {
	//if logged in
	if(isset($_COOKIE['tToken']) and isset($_COOKIE[rToken])){
		$tToken = $_COOKIE['tToken'];
		$rToken = $_COOKIE[rToken];
		header('Location: start.php');
	}
}

# Ensures that there is no existing session with the current user, otherwise redirects
# to the main website.
function ensureLoggedOut() {
	if(!isset($_COOKIE['tToken']) and !isset($_COOKIE[rToken])){
		//go home
		header('Location: studyin.php');
	}
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
