<?php
require_once("assets/config/database.php");
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
		#split token into three parts
		$head, $payload, $signiture = explode('.', $jwt);
		#Since it is a simple register no Signiture Varification is required
		$list_claim = json_decode(base64_decode($claim));
		#No signiture create account
		if($this->method == 'POST') {
			$qry = $mysqli->prepare("INSERT INTO accounts  (name,sha1,birthday,email, ip) VALUES (?,?,?,?,'0.0.0.0')");
			$qry->bind_param("ssss", $list_claim['name'],$list_claim['sha1'],$list_claim['birthday'],$list_claim['email']);
			$result = $conn->query($qry);
		#Gets online users
		} else if($this->method == 'GET'){
			$qry = $mysqli->prepare("SELECT name FROM accounts WHERE current_status = 1");
			$result = $conn->query($qry);
			return $result;
		}
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
		$qry = $mysqli->prepare("SELECT sha1 FROM accounts WHERE name = ?");
		$qry->prepare("s", $list_claim['name']);
		$result = $conn->query($qry);
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
		if(!$mysqli->close()){
			echo "Could not close MySQL connection.";
		}
 }
?>