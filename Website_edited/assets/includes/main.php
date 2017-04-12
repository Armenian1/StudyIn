<?php
if(basename($_SERVER["PHP_SELF"]) == "main.php") {
	die("403 - Access Forbidden");
}
$main = "";
if(isset($_GET['page'])) {
	$main = $_GET['page'];
}
if($getbase === "main") {
	if(empty($main)) {
		include ("sources/public/home.php");
	} else {
		redirect("?base=main");
	}
} else {
	redirect("?base=main");
}