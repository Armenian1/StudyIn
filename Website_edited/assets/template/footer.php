<?php
if(basename($_SERVER["PHP_SELF"]) == "footer.php") {
    die("403 - Access Forbidden");
}
?>
			<br/><br/><br/>
			<div>
			<?php
			if($base == "schedule" ){
				if(isset($_COOKIE['timelog'])){
					echo "<a href='../assets/handlers/logout.php'><strong>Log Out</strong></a>";
					echo "<em>(logged in since";
					echo $_COOKIE['timelog'];
					echo ")</em>";
				}
			}
			?>
			</div>
		<div class="headfoot">
			<p>
				<q>StudyIn is nice, Best thing ever invented for Students.</q> - PCWorld<br /></p>
			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php">
					<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php">
					<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div>
		
	</body>
</html>