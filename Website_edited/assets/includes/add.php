<?php
if(basename($_SERVER["PHP_SELF"]) == "add.php") {
	die("403 - Access Forbidden");
}
?>



<!DOCTYPE html>
<?php
include('../handlers/common.php');
ensureLoggedIn();
# since we know the user is logged in, can directly set name & password
$token = $_COOKIE['tToken'];
$rtoken = $_COOKIE['rToken'];

// # generate the proper filename from the given username
// $fileName = studyinFilename($name);
// if (file_exists($fileName)) {
// 	$todo = file($fileName);
// }
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
			<form action="submit.php" method="post">
				<p>Course name (e.g. CSCI 3308 would be named "Software Development and Tools"). We encourage the taking out of frustrations on classes using their name, for example "stupid class" or "f***ing prereqs" or "taking this for the GPA boost":</p><br />
				<input type="text" name="courseName"><br /><br />
				<p>Section number (e.g. CSCI 3308 would have section number "3308"):</p><br />
				<input type="text" name="sectionNum"><br /><br />
				<p>Course duration in minutes (e.g. CSCI 3308 Lecture, an hour and forty minute class, would be "100" minutes in duration. I'm aware that this is unfeasibly demanding of somebody filling in a web form, and I'll find a more elegant way to do it later probably):</p><br />
				<input type="text" name="duration"><br /><br />
				<!-- from view-source:http://www.colorado.edu/catalog/2016-17/courses -->
				<p>Department:</p>
				<select name="dpt">
					<option value="ACCT">ACCT</option><option value="AIRR">AIRR</option><option value="ANTH">ANTH</option><option value="APPM">APPM</option><option value="APRD">APRD</option><option value="ARAB">ARAB</option><option value="ARCH">ARCH</option><option value="AREN">AREN</option><option value="ARSC">ARSC</option><option value="ARTF">ARTF</option><option value="ARTH">ARTH</option><option value="ARTS">ARTS</option><option value="ASEN">ASEN</option><option value="ASIA">ASIA</option><option value="ASTR">ASTR</option><option value="ATLS">ATLS</option><option value="ATOC">ATOC</option><option value="BADM">BADM</option><option value="BAKR">BAKR</option><option value="BASE">BASE</option><option value="BCOR">BCOR</option><option value="BMEN">BMEN</option><option value="BPOL">BPOL</option><option value="BSLW">BSLW</option><option value="BUSM">BUSM</option><option value="CAMW">CAMW</option><option value="CEES">CEES</option><option value="CESR">CESR</option><option value="CHEM">CHEM</option><option value="CHEN">CHEN</option><option value="CHIN">CHIN</option><option value="CLAS">CLAS</option><option value="CMCI">CMCI</option><option value="CMDP">CMDP</option><option value="COEN">COEN</option><option value="COML">COML</option><option value="COMM">COMM</option><option value="COMR">COMR</option><option value="CSCI">CSCI</option><option value="CSVC">CSVC</option><option value="CVEN">CVEN</option><option value="CWCV">CWCV</option><option value="DANE">DANE</option><option value="DNCE">DNCE</option><option value="EALC">EALC</option><option value="EBIO">EBIO</option><option value="ECEN">ECEN</option><option value="ECON">ECON</option><option value="EDEN">EDEN</option><option value="EDUC">EDUC</option><option value="EHON">EHON</option><option value="EMEN">EMEN</option><option value="EMUS">EMUS</option><option value="ENEN">ENEN</option><option value="ENGL">ENGL</option><option value="ENST">ENST</option><option value="ENVD">ENVD</option><option value="ENVM">ENVM</option><option value="ENVS">ENVS</option><option value="ESBM">ESBM</option><option value="ESLG">ESLG</option><option value="ETHN">ETHN</option><option value="EVEN">EVEN</option><option value="FARR">FARR</option><option value="FILM">FILM</option><option value="FINN">FINN</option><option value="FNCE">FNCE</option><option value="FREN">FREN</option><option value="FRSI">FRSI</option><option value="GEEN">GEEN</option><option value="GEOG">GEOG</option><option value="GEOL">GEOL</option><option value="GREK">GREK</option><option value="GRMN">GRMN</option><option value="GRTE">GRTE</option><option value="GSAP">GSAP</option><option value="GSLL">GSLL</option><option value="HEBR">HEBR</option><option value="HIND">HIND</option><option value="HIST">HIST</option><option value="HONR">HONR</option><option value="HUEN">HUEN</option><option value="HUMN">HUMN</option><option value="IAFS">IAFS</option><option value="IAWP">IAWP</option><option value="INBU">INBU</option><option value="INDO">INDO</option><option value="INFO">INFO</option><option value="INVS">INVS</option><option value="IPHY">IPHY</option><option value="ITAL">ITAL</option><option value="JOUR">JOUR</option><option value="JPNS">JPNS</option><option value="JRNL">JRNL</option><option value="JWST">JWST</option><option value="KREN">KREN</option><option value="LATN">LATN</option><option value="LAWS">LAWS</option><option value="LDSP">LDSP</option><option value="LEAD">LEAD</option><option value="LGBT">LGBT</option><option value="LGTC">LGTC</option><option value="LIBB">LIBB</option><option value="LIBR">LIBR</option><option value="LING">LING</option><option value="MATH">MATH</option><option value="MBAC">MBAC</option><option value="MBAX">MBAX</option><option value="MCDB">MCDB</option><option value="MCEN">MCEN</option><option value="MDST">MDST</option><option value="MEMS">MEMS</option><option value="MGMT">MGMT</option><option value="MILR">MILR</option><option value="MKTG">MKTG</option><option value="MSBC">MSBC</option><option value="MSBX">MSBX</option><option value="MSEN">MSEN</option><option value="MUEL">MUEL</option><option value="MUSC">MUSC</option><option value="MUSM">MUSM</option><option value="NAVR">NAVR</option><option value="NORW">NORW</option><option value="NRLN">NRLN</option><option value="NRSC">NRSC</option><option value="OPIM">OPIM</option><option value="OPMG">OPMG</option><option value="ORMG">ORMG</option><option value="PACS">PACS</option><option value="PHIL">PHIL</option><option value="PHYS">PHYS</option><option value="PMUS">PMUS</option><option value="PORT">PORT</option><option value="PRLC">PRLC</option><option value="PSCI">PSCI</option><option value="PSYC">PSYC</option><option value="REAL">REAL</option><option value="RLST">RLST</option><option value="RSEI">RSEI</option><option value="RUSS">RUSS</option><option value="SCAN">SCAN</option><option value="SEWL">SEWL</option><option value="SLHS">SLHS</option><option value="SNSK">SNSK</option><option value="SOCY">SOCY</option><option value="SPAN">SPAN</option><option value="SSIR">SSIR</option><option value="SUST">SUST</option><option value="SWED">SWED</option><option value="TBTN">TBTN</option><option value="THTR">THTR</option><option value="TLEN">TLEN</option><option value="TMUS">TMUS</option><option value="WMST">WMST</option><option value="WRTG">WRTG</option><option value="YIDD">YIDD</option>
				</select><br /><br />
				<p>Select a time:</p>
  				<input type="time" name="time"><br />
  				<input type="checkbox" name="Monday" value="m"> <p>Monday</p><br />
  				<input type="checkbox" name="Tuesday" value="t"> <p>Tuesday</p><br />
  				<input type="checkbox" name="Wednesday" value="w"> <p>Wednesday</p><br />
  				<input type="checkbox" name="Thursday" value="th"> <p>Thursday</p><br />
  				<input type="checkbox" name="Friday" value="f"> <p>Friday</p><br />
				<input id="submitButton" type="submit" value="submit" />
			</form>

			<h3>Current Schedule:</h3>
			<?php include('schedule.php'); ?>

			<br /><br /><br />
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
