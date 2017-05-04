<?php
require_once 'API.class.php';
class MyAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);

        // Abstracted out for example
        $APIKey = new Models\APIKey();
		
		#Check API Key
        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
		


		//check auth information is there
		if(!array_key_exists('user', $this->request)) {
			throw new Exception('No User Provided')
		}
		//we can create new user becuase there is a name in request
		$User = new Models\User($this->request['user']);
		
		//Check user to their token
        if (array_key_exists('token', $this->request) && !$User->get('token', $this->request['token'])) {
            throw new Exception('Invalid User Token');
        } else if (array_key_exists('refreshToken', $this->request) {
			throw new Exception('Invalid Refresh Token')
		}

        $this->User = $User;
    }

    /**
     *Endpoints
     */
	 protected function user($jwt) {
		$head, $payload = explode('.', $jwt)
		//if got auth from API key
		if(!array_key_exists('token', $this->request)){
			#create account
			if($this->method == 'POST') {
				return $User->make(json_decode(base64_decode($payload)));
			#Gets online users
			} else if($this->method == 'GET'){
				require_once("assets/config/database.php");
				$online_Users = array();
				$qry = $mysqli->prepare("SELECT name,logged FROM accounts WHERE online = 1");
				$result2 = $conn->query($qry);
				#return JSON witha l
				while($r = mysqli_fetch_assoc($result2)){
					$online_Users = $r;
				}
				closeSQL();	
				return json_encode($online_Users);
			} else {
				return "Invalid request";
			}
		#authenticated through token
		} else {
			#Check claim type
			$list_claim = json_decode(base64_decode($claim));
			//if token doesnt exist
			if($this->method == 'GET'){
				$User->
			} else if($this->method == 'PUT'){
			}

		} else {
			//token session is already created
			closeSQL();
			die("JSON encrpytion signiture Incorrectly formated.");
		}
			closeSQL();
		}
	}
	
     protected function course($jwt) {
        if ($this->method == 'GET') {
			$this->_response($this->User->get('courses'));
        } else {
            $this->_response("Method Not DEFINED", 405);
        }
     }
	 
	private function closeSQL(){
		if(!$mysqli->close()){
			echo "Could not close MySQL connection.";
		}	
	}
	 
	 private function verify_Key($payload,$signiture,$type){
		$head , $claim =  $explode($payload);
		$list_head = json_decode(base64_decode($claim));
		$list_claim = json_decode(base64_decode($claim));
		#grab user from database
		require_once("assets/config/database.php");
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
			die("Error incorrect type passed.");
		}
		//close MYSQL connection
		if(!$mysqli->close()){
			echo "Could not close MySQL connection.";
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