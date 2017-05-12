<?php
#require_once("/../config/database.php");

class APIKey {
	#protected $_api_keys;
	#protected $_banned_ip;
	
	function __construct(){
		//SQL Information
		$host['hostname'] = 'mysql.studyin.dreamhosters.com'; // Hostname [Usually locahost]
		$host['user'] = 'jimyou5'; // Database Username [Usually root]
		$host['password'] = '4ba1-z9sd-5jgh.'; // Database Password [Leave blank if unsure]
		$host['database'] = 'studyindb'; // Database Name
		//start SQL session
		$this->conn = new MySQLi($host['hostname'],$host['user'],$host['password'],$host['database']);
		//Check connection
		if(mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		//get all API keys
		
		#$this->_banned_ip = $this->conn->query("SELECT * from blocked");
	}
	
	function __destruct(){
		$this->conn->close();
		unset($this->_api_keys);
		unset($this->_banned_ip);
	}
	
	#function get_Banned_ip($ip){
		#$qry = $mysqli->prepare("SELECT * FROM blocked WHERE ip = ?");
		#$qry->bind_param("s", $ip);
		#$result = $conn->query($qry);
		#if(!$result){
		#	die('Could not run banned query:'.mysql_error());
		#}
		#if($result < 0){
		#	return false;
		#}
		#return true;
	#}
	
	function verifyKey($key, $origin){
		//checks for banned IP
		#if(get_Banned_ip($origin)){
		#	return $this->_response("Access denied by URL authorization policy on the Web server. $origin", 401.7);
		#} 
		#if(!$result < 0){
			//ERROR API KEY doesnt EXIST
		#	return false;
		#}
		$result = $this->conn->query("SELECT api_key FROM api_keys");
		if($result->num_rows > 0){
			return true;
		}
		return false;
	}
}
?>