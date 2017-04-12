<?php
require_once 'API.class.php';
class MyAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);

        // Abstracted out for example
        $APIKey = new Models\APIKey();
        $User = new Models\User();

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])) {

            throw new Exception('Invalid User Token');
        }

        $this->User = $User;
    }

    /**
     *Endpoints
     */
	 protected function user($jwt) {
		#No signiture create account
		if($this->method == 'POST') {
			$qry = $mysqli->prepare("INSERT INTO accounts  (name,sha1,salt,birthday,email, ip) VALUES (?,?,?,?,?,?)");
			$qry->bind_param("s", $pwdsha1);
		#Gets online users
		} else if($this->method == 'GET'){
			$qry = $mysqli->prepare("SELECT * FROM accounts WHERE online = 1");
			
		}
		#split token into three parts
		$head, $payload, $signiture = explode('.', $jwt)
		#varify signiture
		if (!verifyKey($payload,$signiture)) {
			if($this->method == 'GET'){
			}
		}
		#take second mart and decode 
		
	 }
	 
     protected function example() {
        if ($this->method == 'GET') {
            return "Your name is " . $this->User->name;
        } else {
            return "Only accepts GET requests";
        }
     }
	 
	 private function verify_Key($payload,$signiture){
		$head , $claim =  $explode($payload);
		$list_head = json_decode(base64_decode($claim));
		$list_claim = json_decode(base64_decode($claim));
		#grab user from database
		require_once("assets/config/database.php");
		$qry = $mysqli->prepare("SELECT sha1 FROM accounts WHERE name = ?");
		$qry->prepare("s", $list_claim['name']);
		$result = $conn->query($qry);
		if(!$mysqli->close()){
			echo "Could not close MySQL connection.";
		}
		if ($result->num_rows < 0){
			return false;
		}
		$secret = hash_hmac(list_claim['salt'],sha1($password));
		$chk_signiture = hash_hmac('sha256',$payload,$secret);
		if ($chk_signiture != $signiture){
			return false;
		}
		return true;
	 }
	 
 }
?>