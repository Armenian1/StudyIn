<?php
require_once("assets/config/database.php");

class APIKey {
		private $_api_key;

	function __construct($name){
		$this->_api_key = "5425ff73-a599-4751-8759-7e170e730717";
	}
	
	function __destruct(){
		unset($this->_user);
		unset($this->_api_key);
		unset($this->exp_time);
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
		if(get_Banned_ip($origin)){
			throw new Exception('Ip is Banned');
		}
		//check if key is correct
		if($key == $this->_api_key){
			return true;
		}
		return false;
	}
}
?>