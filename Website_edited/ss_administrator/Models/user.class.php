<?php

class User {
		protected $_name;
		protected $_id;
		protected $_exist;

		
	//flag 0 = with name
	//flag 1 = with token
	//flag 2 = new account
	function __construct($name,$flag){
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

		$this->_user = $name;
		#Check if account exists
		#Token AUth
		if($flag == 1){
			if($this->exists == True){
				$this->_id = getID();
			} else {
				throw new Exception('User does not exist');
			}
		#Creation Request
		} else {
			if($this->exists() == False){
				$this->_id = 0;
			} else {
				throw new Exception('Account Already Exists.');
			}
		}
	}
	
	
	function __destruct(){
		$this->mysqli->close();
		unset($this->_user);
		unset($this->_id);
		unset($this->_exist);
	}
	
	function make($list_claim){
		if($this->_id != 0){
			throw new Exception('Account Already Exists');
		}
		$this->mysqli = new MySQLi($host['hostname'],$host['user'],$host['password'],$host['database']);
		//create account
		$qry = ("INSERT INTO accounts  (name,sha1,email,birthday) VALUES (?,?,?,?)");
		if ($stmt = $this->mysqli->prepare($qry)) {
			$stmt->bind_param("ssss", $this->_user, $list_claim['sha1'],list_claim['email'],list_claim['birthday']);
			if($stmt->execute()){
				return true;
			}
		}
		throw new Exception('Error Creating Account');
	}
	
	function generateToken() {
		$token = '';
		$len = 64;
		for($i = 0; $i < 256; $i++){
			$token .= md5(microtime(true.mt_rand(10000,90000)));
		}
		$token = substr($token,0,$len);
		return $token;
	}
	
	//Get with no Check
	public function get($variable){
		switch($variable){
			case 'courses':
				#$arr = array('user' => array('_id' => array('$token_id' : get('token'))),'courses'=> array());
				#$arr = {'user':'1'};
				#$arr = {'user': {'_id':{'$token_id':get('token')}},'courses':{}};
				$vars = array(
					'user' => array(
						'_id' => array(
							'token_id' => get('token'),
						),
						'courses'=> array(
							'empty' => 'empty'
						)
					)
				);
				$qry = ("SELECT courses.course_name,courses.course_id,courses.department_id,courses.start_time,courses.days,courses.section_id FROM courses AS c INNER JOIN course_enrol AS ce WHERE ce.user_id = ? AND c.course_id = ce.course_id");
				if ($stmt = $this->mysqli->prepare($qry)) {
					$stmt->bind_param("i", $this->_id);
					$stmt->execute();
					#If tokens are found
					$stmt->bind_result($name,$id,$dep,$time,$days,$section);
					while ($stmt->fetch()) {
						array_push($vars['user']['courses'], array('name' => $name, 'department' => $dep, 'time' => $time.' '.$days, 'section'=> $section));
					}
				}
				return $vars;
				break;
			case 'token':
				$qry = ("SELECT token FROM tokens where user_id =?");
				if ($stmt = $mysqli->prepare($qry)) {
					$stmt->bind_param("i", $this->_id);
				}
				#If tokens are found
				$stmt->execute();
				$result = $stmt->get_result();
				if($result->num_rows > 0){
					return $result;
				}
				throw new Exception('No Token Found for User');
				break;
			case 'sha1':
				$qry = ("SELECT sha1 FROM accounts WHERE name=?");
				if ($stmt = $this->mysqli->prepare($qry)) {
					$stmt->bind_param("s", $this->_user);
					$stmt->execute();
					#If tokens are found
					$stmt->bind_result($pass);
					$stmt->fetch();
					if($pass != null){
						return $pass;
					} else {
						throw new Exception('Account not found');
					}
				}
				break;
			default:
				return $this->_response("Method Not DEFINED", 405);
				break;
		}
	}
	
	function newRefreshToken(){
		//create new session token
		$qry = $this->mysqli->prepare("SELECT tokens.* FROM tokens AS t INNER JOIN accounts AS a ON a.id = t.user_id WHERE a.name = ?");
		$qry->bind_param("s", $this->_name);
		$result = $this->mysqli->query($qry);
		//create new refresh token
	}
	
	function getNewSessionToken($refreshT){
		//check refresh token
		$qry = $this->mysqli->prepare("SELECT * FROM tokens WHERE user_id=? AND token=? AND refresh=1");
		$qry->bind_param("is", $name,$refreshT);
		$result = $this->mysqli->query($qry);
		if(!isExpired){
			$newt = generateToken();
			date_default_timezone_set("MST"); 
			$curTime = time();
			
			$qry = $this->mysqli->prepare("INSERT INTO tokens (user_id,token,life,created,refresh, ip) VALUES (?,?,?,?,1,?)");
			$qry->bind_param("is", $this->_id, $newt,360000,$curTime, IP);
			$result = $this->mysqli->query($qry);
			if (!$result){
				die('MySQl error:'.$this->mysqli->errorInfo());
			}
			return $newt;
		}
		return token;
	}
	
	#get new session/REFRESH token
	function getNewToken($origin){
		$newt = $this->generateToken();
		date_default_timezone_set("MST"); 
		$date = date("Y-m-d H:i:s");
		#$expDate = $date->add(new DateInterval('P7Y5M4DT4H3M2S'));
		#echo $expDate;
		$expDate = $date;
		#$ip = '127.0.0.1';
		$used = 0;
		$administrator = 0;
		$refresh = 1;
		#insert token into database
		$qry = $this->mysqli->prepare("INSERT INTO tokens (user_id,token,created,experation, administrator,refresh,use_times, ip) VALUES (?,?,?,?,?,?,?,?)");
		if(!$qry){
			throw new Exception('Error in prepareing Token Query');
		}
		$qry->bind_param("isssiiis", $this->_id, $newt,$date,$date,$administrator,$refresh,$used,$origin);
		#$mysqli->prepare($qry);
		#If tokens are found
		if(!$qry->execute()){
			die('MySQl error:'.$qry->errorCode());
		}
		#create array with token and exp date
		$reply = array('token' => $newt, 'token_exp'=> $expDate, 'created' => $date);
		
		return $reply;
	}
	
	function isExpired($expDate){
		$expDate = DateTime($expDate);
		#assumes datetime is returned as string
		date_default_timezone_set("MST"); 
		$date = date("Y-m-d H:i:s");
		//calculate 
		if($date > $expDate){
			return True;
		}
		return False;
	}
	
	function exists(){
		$qry = $this->mysqli->prepare("SELECT name FROM accounts  WHERE name=?");
		$qry->bind_param("s", $this->_name);
		$qry->execute();
		$qry->store_result();
		#$result = $this->mysqli->query($qry);
		if ($qry->num_rows > 0 ){
			return true;
		}
		return false;
	}
	
	private function getID(){
		$qry = $this->mysqli->prepare("SELECT id FROM accounts WHERE name=?");
		$qry->bind_param("s", $this->_name);
		$result = $this->mysqli->query($qry);
		if($result > 0){
			return $result[0];
		}
			return $this->_response('Not Found', 404);
	}

}
?>