<!DOCTYPE html>
<?php
#	Homepage for a website which provides a common base to find study groups at CU Boulder
session_start(); # added, working before
include('common.php');
ensureLoggedIn();
# since we know the user is logged in, can directly set name & password
$name = $_SESSION['name'];
$password = $_SESSION['password'];
$todo;

# generate the proper filename from the given username
$fileName = studyinFilename($name);
if (file_exists($fileName)) {
	$todo = file($fileName);
}
?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>StudyIn</title>
		<link href="studyin.css" type="text/css" rel="stylesheet" />
		<link href="http://www.colorado.edu/oit/sites/all/themes/cassowary/images/logo-highres.png" type="image/ico" rel="shortcut icon" />
	</head>

	<body>
		<div class="headfoot">
			<h1>
				<!-- <img id="buff" src="http://carshare.org/2016dev/wp-content/uploads/2013/10/CU-Buffs.png" alt="logo" /> -->
				StudyIn<br />CU Boulder
			</h1>
		</div>

		<div id="main">

			<?php include('schedule.php'); ?>

			<br/><br/><br/>
			<div>
				<a href="logout.php"><strong>Log Out</strong></a>
				<em>(logged in since <?= $_COOKIE['date'] ?>)</em>
			</div>

		</div>

		<div class="headfoot">
			<p>
				<q>StudyIn is nice, but I'm pretty sure the name violates some serious trademark laws.</q> - PCWorld<br />
				All pages and content &copy; Copyright a couple clueless college kids ltd.
			</p>

			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php">
					<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php">
					<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div>
	</body>
</html>
