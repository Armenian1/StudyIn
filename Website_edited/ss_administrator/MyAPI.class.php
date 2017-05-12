<?php
require_once 'API.class.php';
require_once '/Models/APIKey.class.php';
require_once '/Models/user.class.php';
#require_once 'common.php';
class MyAPI extends API
{
    protected $User;
    public static $supported_algs = array(
        'HS256' => array('hash_hmac', 'SHA256'),
    );

    public function __construct($request, $origin) {
        parent::__construct($request);
		//SQL Information
		//SQL Information
		$host['hostname'] = 'mysql.studyin.dreamhosters.com'; // Hostname [Usually locahost]
		$host['user'] = 'jimyou5'; // Database Username [Usually root]
		$host['password'] = '4ba1-z9sd-5jgh.'; // Database Password [Leave blank if unsure]
		$host['database'] = 'studyindb'; // Database Name
		//start SQL session
		$this->mysqli = new MySQLi($host['hostname'],$host['user'],$host['password'],$host['database']);
		//Check connection
		if(mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
        // Abstracted out for example
        $APIKey = new APIKey();
		#print_r (array_values($this->args));
		#since null not working
		$this->head = '';
		$this->claim = '';
		
		#echo ($this->endpoint);
		#save ip
		$this->ip = $origin;
		#$this->jwt = $this->request[0];
		#Check API Key
        #if (!array_key_exists('apiKey', $this->request)) {
		if($this->apiKey == null){
            throw new Exception('No API Key provided');
        #} else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
		} else if (!$APIKey->verifyKey($this->apiKey, $origin)) {
            throw new Exception('Invalid API Key');
		} else if($this->token == null){
			throw new Exception('No Token Proveded');
		}
		#split Token
		$jwt = explode('.',$this->token);
		#print_r($jwt);
		#parse token into sections
		$this->head = array_shift($jwt);
		$this->claim = array_shift($jwt);
		#echo $this->claim;
		$this->check = $this->head.".".$this->claim;
		#echo $this->check;
		if($this->head == '' or $this->claim == ''){
			throw new Exception('invalid token');
		}
		
		#$this->head = json_decode(base64decodeURL($this->head),true);
		#$this->claim = json_decode(base64decodeURL($this->claim),true);
		
		#fix head and claim
		$data = str_replace(array('-','_'),array('+','/'),$this->head);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		$this->head = json_decode(base64_decode($data),true);
		
		$data = str_replace(array('-','_'),array('+','/'),$this->claim);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		$this->claim =  json_decode(base64_decode($data),true);
		
		#print_r(json_decode(base64decodeURL($this->head),true));
		#Check HEAD
		#check if token is supported by API
		#if(!isset($supported_algs[$this->head['alg']])){
			#throw new Exception('Token algorithim is not supported');
		#}
		#Check if Token type is supported ONLY JWT
		#if($this->head['typ'] != 'jwt'){
		#	throw new Exception('Token type is not supported');
		#}
		#Check sig
		$this->sig = array_shift($jwt);
		#If signiture exists
		if($this->sig == null){
			#if its not for register
			if($this->endpoint != 'user' and $this->method != 'POST'){
				throw new Exception('Signiture missing from Token');
			} else {
				#Prepare account setup
				$this->User = new User($this->claim['name'], 2);
			}
		#Authentication through token
		} else if($this->endpoint != 'auth'){
			#retrive token
			$this->User = new User($this->claim['name'], 1);
			$tok = $this->User->get('token');
			#take and hash payload with token
			$csigniture =  hash_hmac('sha256', $this->check, $tok);
			if($csigniture != $this->sig){
				throw new Exception('invalid request');
			}
		#Authentication through AUTH with Return of Token
		} else {
			#setup Auth User
			$this->User = new User($this->claim['name'], 0);
		}
    }
	
	protected function onlineUsers(){
		#require_once("assets/config/database.php");
		$online_Users = array();
		$qry = $mysqli->prepare("SELECT name,logged FROM accounts WHERE online = 1");
		$result2 = $conn->query($qry);
		#return JSON witha l
		while($r = mysqli_fetch_assoc($result2)){
			$online_Users = $r;
		}
		return $online_Users;
	}

    /**
     *Endpoints
     */
	 protected function user() {
		#If jwt exists then can get info about account
		if(isset($jwt)){
			#Register
			if($this->method == 'POST'){
				$User->make($this->claim);
			}
			
		}
	}
	
	protected function auth(){
		#get password from user
		$pass = $this->User->get('sha1');
		#take and hash payload with token
		$csigniture =  hash_hmac('sha256', $this->check, $pass);
		if($csigniture != $this->sig){
			throw new Exception('invalid username or password');
		}
		#JSON
		$reply = $this->User->getNewToken($this->ip);

		return $this->_response($reply);
	}
	
	protected function register(){
		if($this->User->make($this->claim)){
			$reply = this->User->getNewToken($this->ip);
			return $this->_response($reply);
		}
		throw new Exception('Error Creating Account');
	}

     protected function course($jwt) {
        if ($this->method == 'GET') {
			$this->_response($this->User->get('courses'));
        } else {
            $this->_response("Method Not DEFINED", 405);
        }
     }
	 
	 private function verify_Key($payload,$signiture,$type){
		list($head , $claim) =  $explode($payload);
		$list_head = json_decode(base64_decode($claim));
		$list_claim = json_decode(base64_decode($claim));
		#grab user from database
		#require_once("assets/config/database.php");
		if ($type === 'false'){
			$qry = $mysqli->prepare("SELECT sha1 FROM accounts WHERE name = ?");
			$qry->prepare("s", $list_claim['name']);
			$result = $conn->query($qry);
			if ($result->num_rows < 0){
				return false;
			}
		} else if($type === 'true'){
			$qry = $mysqli->prepare("SELECT session FROM accounts WHERE name = ?");
			$qry->prepare("s", $list_claim['name']);
			$result = $conn->query($qry);
			if ($result->num_rows < 0){
				return false;
			}
		} else {
			die("Error in Signiture Verification.");
		}
		//check depending on algorithim encrpytion type
		if($list_head['alg'] == "HS256"){
			$secret = hash_hmac($list_claim['salt'],sha1($password));
			$chk_signiture = hash_hmac('sha256',$payload,$secret);
		}
		if ($chk_signiture != $signiture){
			return false;
		}
		return true;
		
	 }
	 
 }
?>