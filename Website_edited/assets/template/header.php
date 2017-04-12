<?php
if(basename($_SERVER["PHP_SELF"]) == "header.php") {
	die("403 - Access Forbidden");
}
?>

<body>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!--- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --->
		<title>StudyIn |</title>
		
		<link rel="icon" href="../../favicon.png" type="image/x-icon" />
		
		<!---
		<style type="text/css">
			body {
				<?php
					if(!empty($background)) echo "background-image: url(" . $background . ");";
					if(!empty($bgcolor)) echo "background-color: #" . $bgcolor . ";";
					if(!empty($bgrepeat)) echo "background-repeat: " . $bgrepeat . ";";
					if(!empty($bgcenter)) echo "background-position: center;";
					if(!empty($bgfixed)) { echo "background-attachment: fixed;"; }
					if(!empty($bgcover)) {echo "background-size: cover;"; }
				?>
			}
		</style> 
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script> -->
		
		
	</head>
	<body>