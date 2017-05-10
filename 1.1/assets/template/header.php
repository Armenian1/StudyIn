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
		<?php
		
		if(isset($_GET['base'])){
			echo "<title>StudyIn |".$_GET['base']."</title>";
		} else {
			echo "<title>StudyIn | Home</title>";
		}
		?>
		
		<link rel="icon" href="../../favicon.ico" type="image/x-icon" />
		<link href="css/studyin.css" type="text/css" rel="stylesheet" />
		<script src="http://code.jquery.com/jquery-2.2.0.js"></script>

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
		<script src='https://www.google.com/recaptcha/api.js'></script>
		
	</head>
	<body>
		<div class="headfoot">
			<h1>
				<img id="buff" src="http://carshare.org/2016dev/wp-content/uploads/2013/10/CU-Buffs.png" alt="logo" />
				StudyIn<br />CU Boulder
			</h1>
		</div>