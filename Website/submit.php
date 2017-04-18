<?php
#	Intermediary page which updates a course list stored as JSON
session_start();
include('common.php');
ensureLoggedIn();

$days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
$name;
$section;
$duration;
$dpt;
$time;

if (isset($_POST['courseName'])) {
	$name = $_POST['courseName'];
} else {
	die('Invalid input: variable "courseName" not set.');
}

if (isset($_POST['sectionNum'])) {
	$section = intval($_POST['sectionNum']);
} else {
	die('Invalid input: variable "sectionNum" not set.');
}

if (isset($_POST['duration'])) {
	$duration = $_POST['duration'];
} else {
	die('Invalid input: variable "duration" not set.');
}

if (isset($_POST['dpt'])) {
	$dpt = $_POST['dpt'];
} else {
	die('Invalid input: variable "dpt" not set.');
}

# will need some editing when sending to the server to get the correct format combined w/duration and days
if (isset($_POST['time'])) {
	$time = $_POST['time'];
	$time = str_replace(':', '', $time); # $time now in military time as string
} else {
	die('Invalid input: variable "time" not set.');
}

$time .= ':' . $duration;
foreach ($days as $day) {
	if ($_POST[$day]) {
		$time .= ':' . $_POST[$day];
	}
}

$course = array(
	'name' => $name,
	'department' => $dpt,
	'time' => $time,
	'section' => $section
	);

# append contents of new course object to json
$str = file_get_contents('./JSON_example.json');
$json = json_decode($str, true);
array_push($json['user']['courses'], $course);
$data = json_encode($json);
# print to file
$jsonFile = fopen('./JSON_example.json', 'w') or die ('Cannot open ./JSON_example.json');
fwrite($jsonFile, $data);
fclose($jsonFile);
header('Location: ./studyin.php');

# now set these values on the server when functioning
?>