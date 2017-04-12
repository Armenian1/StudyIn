<?php
#remove
if(basename($_SERVER["PHP_SELF"]) == "login.php") {
	die("403 - Access Forbidden");
}

#	Login page for a website which provides a common base to find study groups at CU Boulder
session_start(); # added, working before
include('common.php');
ensureLoggedOut();
?>


<!DOCTYPE html>
		<div class="headfoot">
			<img id="buff" src="http://carshare.org/2016dev/wp-content/uploads/2013/10/CU-Buffs.png" alt="logo" />
			<h1>
				StudyIn<br />CU Boulder
			</h1>
		</div>

		<div id="main">
			<p>
				The easiest way to start a study group. <br />
				Provided at least a couple people are using this service, anyway...
			</p>

			<p>
				Log in with your CU Identikey for your information to be filled out automatically. <br />
				No grades or personal information will be used or stored, only class info.
			</p>

			<form id="loginform" action="login.php" method="post">
				<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>

			<p>
				<em>(last login from this computer was <?= $_COOKIE['date'] ?>)</em>
			</p>
		</div>

<?php

#remove
if(basename($_SERVER["PHP_SELF"]) == "main.php") {
	die("403 - Access Forbidden");
}
$main = "";
if(isset($_GET['page'])) {
	$main = $_GET['page'];
}
if($getbase === "main") {
	if(empty($main)) {
		$queryhome = $mysqli->query("SELECT homecontent FROM ".$prefix."properties");
		$gethome = $queryhome->fetch_assoc();
		echo "<div class=\"row\">";
		include ("sources/public/main-news.php");
		include ("sources/public/main-events.php");
		echo "</div>";
		echo "<br/><div class=\"row\">";
		include ("sources/public/main-rank.php");
		include ("sources/public/main-gm.php");
		echo "</div><br/>";
		include ("sources/public/home.php");
	}
	elseif($main === "download") {
		include('sources/public/download.php');
	}
	elseif($main === "events") {
		include('sources/public/events.php');
	}
	elseif($main === "guildlist") {
		include('sources/public/guildlist.php');
	}
	elseif($main === "gmblog") {
		include('sources/public/gmblog.php');
	}
	elseif($main === "members") {
		include('sources/public/members.php');
	}
	elseif($main === "news") {
		include('sources/public/news.php');
	}
	elseif($main === "events") {
		include('sources/public/events.php');
	}
	elseif($main === "rankings") {
		include('sources/public/rankings.php');
	}
	elseif($main === "register") {
		include('sources/public/register.php');
	}
	elseif($main === "vote") {
		include('sources/public/vote.php');
	}
	elseif($main === "character") {
			include('sources/public/character.php');
	}
	elseif(in_array($main, $slugs)) {
		include('sources/public/pages.php');
	}
	else {
		redirect("?base=main");
	}
} else {
	redirect("?base=main");
}