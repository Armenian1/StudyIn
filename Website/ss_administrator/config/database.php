<?php
if(basename($_SERVER["PHP_SELF"]) == "database.php") {
    die("403 - Access Forbidden");
}
#WASNT WOKRING SO HARD CODED NEXT VERSION REVISION WILL FIX

//SQL Information
$host['hostname'] = 'mysql.studyin.dreamhosters.com'; // Hostname [Usually locahost]
$host['user'] = ''; // Database Username [Usually root]
$host['password'] = ''; // Database Password [Leave blank if unsure]
$host['database'] = 'studyindb'; // Database Name
//start SQL session
$this->mysqli = new MySQLi($host['hostname'],$host['user'],$host['password'],$host['database']);
//Check connection
if(mysqli_connect_errno()) {
	printf("connect failed: %s\n", mysqli_connect_error());
	exit();
}


#function makeConn(){
	//start SQL session
#	$conn = new MySQLi($host['hostname'],$host['user'],$host['password'],$host['database']);
	//Check connection
	#if(mysqli_connect_errno()) {
	#	printf("connect failed: %s\n", mysqli_connect_error());
	#	exit();
	#}
	#return $conn
#}
?>