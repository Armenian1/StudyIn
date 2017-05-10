<?php
if(basename($_SERVER["PHP_SELF"]) == "database.php") {
    die("403 - Access Forbidden");
}
#WASNT WOKRING SO HARD CODED NEXT VERSION REVISION WILL FIX

//SQL Information
$host['hostname'] = 'localhost'; // Hostname [Usually locahost]
$host['user'] = 'root'; // Database Username [Usually root]
$host['password'] = 'Dragon123.'; // Database Password [Leave blank if unsure]
$host['database'] = 'StudyIn'; // Database Name


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