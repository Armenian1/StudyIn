<?php
require_once("../config/database.php");

class APIKey {
	protected $_api_keys;
	protected $_banned_ip;
	
	function __construct(){
		//get all API keys
		$this->_api_keys = $conn->query("SELECT api_key FROM api_keys");
		$this->_banned_ip = $conn->query("SELECT * from blocked")
		
		$conn->close();
	}
	
	function __destruct(){
		unset($this->_api_keys)
		unset($this->_banned_ip)
	}
	
	private get_Banned_ip($ip){
		$qry = $mysqli->prepare("SELECT * FROM blocked WHERE ip = ?");
		$qry->bind_param("s", $ip);
		$result = $conn->query($qry);
		if(!$result){
			die('Could not run banned query:'.mysql_error());
		}
		if($result < 0){
			return false;
		}
		return true;
	}
	
	private verifyKey($key, $origin){
		//checks for banned IP
		if(get_Banned_ip($origin)){
			return $this->_response("Access denied by URL authorization policy on the Web server. $origin", 401.7);
		} 
		if(!$result < 0){
			//ERROR API KEY doesnt EXIST
			return false;
		}
		return true;
	}
}
?>