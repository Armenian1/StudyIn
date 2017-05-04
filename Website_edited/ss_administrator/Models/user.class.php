<?php
require_once("assets/config/database.php");

class User {
		protected $_name;
		protected $_id;
		protected $_exist;

		
	//flag 0 = with name
	//flag 1 = with token
	function __construct($name,$flag){
		$this->_user = $name;
		$this->_id = getID();
		$this->_exist = exists();
	}
	
	
	function __destruct(){
		unset($this->_user);
		unset($this->_id);
		unset($this->_exist);
	}
	
	private make($json_recive, $ip){
		if ($this->_exists === true){
			throw new Exception('Account Already Exists')
		}
		//create account
		$qry = $mysqli->prepare("INSERT INTO accounts  (name,sha1,birthday,email) VALUES (?,?,?,?,?)");
		$qry->bind_param("sssss", $this->_user, $list_claim['sha1'], list_claim['birthday'],list_claim['email'],);
		$result = $conn->query($qry);
		if(!$result){
			die('Error in Account Creation Query.'.$conn->errorInfo())
		}
		return 'account created sucessfully';
	}
	
	//Get with no Check
	protected get($variable){
		switch($variable){
			case 'courses':
				$arr = array('user' => array('_id' => '$token_id' => ACTUAL TOKEN),'courses': => array());
				$qry = $mysqli->prepare("SELECT courses.course_name,courses.course_id,courses.department_id,courses.start_time,courses.days,courses.section_id FROM courses AS c INNER JOIN course_enrol AS ce WHERE ce.user_id = ? AND c.course_id = ce.course_id");
				$qry->bind_param("s", $this->_id);
				$result = $conn->query($qry);
				//if there are results
				if($result > 0){
					//save all in result set
					$resultset = array();
					while ($row = mysql_fetch_array($results)) {
					  $resultset[] = $row;
					}
					foreach($resultset as $result){
						array_push($arr[courses], array('name' => $result[0], 'department' => $result[2], 'time' => $result[3].':'.$result[4], 'section'=> $result[5]));
					}
				}
				return $arr
			case default:
				return $this->_response("Method Not DEFINED", 405);
		}
	}

	//OVERLOAD
	protected get($variable, $check){
		switch($variable){
			case 'token':
				$qry = $mysqli->prepare("SELECT tokens.* FROM tokens AS t INNER JOIN accounts AS a ON a.id = t.user_id WHERE a.name = ?");
				$qry->bind_param("s", $name);
				$result = $conn->query($qry);
				if (!$result){
					//error in running SQL
					die('Could not run Token query:'.mysql_error());
				}
				//user tokens are found
				foreach($result->result() as $row){
					//check if token is expired
					$row explode
					//delete if expired
					if(isExpired($created, $exp)){
						$qry = $mysqli->prepare("DELETE FROM tokens WHERE id=?");
						$qry->bind_param("i", $this->_id);
						$result = $conn->query($qry);
						if(!$result){
							die('MySQl error:'.$conn->errorInfo());
						}
					}
					if($check == $row){
						return true;
					}
				}
				return false;
			case default:
				return $this->_response("Method Not DEFINED", 405);
		}
	}
	
	protected newRefreshToken(){
		//create new session token
		$qry = $mysqli->prepare("SELECT tokens.* FROM tokens AS t INNER JOIN accounts AS a ON a.id = t.user_id WHERE a.name = ?");
		$qry->bind_param("s", $this->_name);
		$result = $conn->query($qry);
		//create new refresh token
	}
	
	protected getNewSessionToken($refreshT){
		//check refresh token
		$qry = $mysqli->prepare("SELECT * FROM tokens WHERE user_id=? AND token=? AND refresh=1");
		$qry->bind_param("is", $name,$refreshT);
		result = $conn->query($qry);
		if(!isExpired){
			$newt = generateToken();
			date_default_timezone_set("MST"); 
			$curTime = time();
			
			$qry = $mysqli->prepare("INSERT INTO tokens (user_id,token,life,created,refresh, ip) VALUES (?,?,?,?,1,?)");
			$qry->bind_param("is", $this->_id, $newt,360000,$curTime, IP);
			$result = $conn->query($qry);
			if (!$result){
				die('MySQl error:'.$conn->errorInfo());
			}
			return $newt;
		}
		
		return token;
	}
	
	private isExpired($date,$life){
		//calculate 
		$_SERVER['REQUEST_TIME']
	
	}
	
	private function generateToken() {
		$token = '';
		for($i = 0; $i < 256; $i++){
			$token .= md5(microtime(true.mt_rand(10000,90000));
		}
		$token = substr($sec,0,$len);
		return $token;
	}
	
	private exists(){
		$qry = $mysqli->prepare("SELECT name FROM accounts  WHERE name=?");
		$qry->bind_param("s", $this->_name);
		$result = $conn->query($qry);
		if ($result1 > 0 ){
			return true;
		}
		return false;
	}
	
	private getID(){
		$qry = $mysqli->prepare("SELECT id FROM accounts WHERE name=?");
		$qry->bind_param("s", $this->_name);
		$result = $conn->query($qry);
		if($result > 0){
			return $result[0];
		}
			return $this->_response('Not Found', 404);
	}
	
	protected verifyKey($key, $origin){
		//verifies temp tokens
		$qry = $mysqli->prepare("SELECT user_id,created, FROM tokens WHERE token=?");
		$qry->bind_param("s", $key);
		$result = $conn->query($qry);
		
		//Check if key is expired
		
		if($result > 0){
			//key found
			return true;
		}
		//Key is not correct
		return false
	}
	
	protected verifyRKey($key, $origin){
		//verifies temp tokens
		$qry = $mysqli->prepare("SELECT user_id,created, FROM tokens WHERE token=? AND refresh = 1" );
		$qry->bind_param("s", $key);
		$result = $conn->query($qry);
		
		//Check if key is expired if not mak new token and return
		if($result > 0){
			//key found
			$tok =  generateToken();
			$qry = $mysqli->prepare("INSERT INTO tokens (user_id,token,life,created,refresh, ip) VALUES (?,?,?,?,1,?)");
			$qry->bind_param("is", $this->_id, $tok,360000,$curTime, IP);
			return $tok
		}
		//Key is not correct
		return false
	}
}
?>