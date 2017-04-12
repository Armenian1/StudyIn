<?php
if(basename($_SERVER["PHP_SELF"]) == "database.php") {
    die("403 - Access Forbidden");
}
//SQL Information
$host['hostname'] = 'localhost'; // Hostname [Usually locahost]
$host['user'] = 'teamStudyIn'; // Database Username [Usually root]
$host['password'] = '4ba1-z9sd-5jgh'; // Database Password [Leave blank if unsure]
$host['database'] = 'StudyIn'; // Database Name
//start SQL session
$mysqli = new MySQLi($host['hostname'],$host['user'],$host['password'],$host['database']);
//Check connection
if(mysqli_connect_errno()) {
	printf("connect failed: %s\n", mysqli_connect_error());
	exit();
}
?>