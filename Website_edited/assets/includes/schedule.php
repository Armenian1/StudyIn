<?php
#remove
if(basename($_SERVER["PHP_SELF"]) == "schedule.php") {
	die("403 - Access Forbidden");
}

$str = file_get_contents('JSON_example.json');
$json = json_decode($str, true);
$courses = $json['user']['courses'];
# find range of class times to know how many rows to create
$earliestTime = findEarliestTime($courses);
$latestTime = findLatestTime($courses);
# earliest listed schedule time will be 1 hour before earliest class
$earliestTime -= 100;
# similar for latest time, but with an additional hour to accommodate classes > 1 hr
$latestTime += 200;

# now calculate how many rows will be needed (1 row/hour increment from earliest to latest time)
$totalTime = $latestTime - $earliestTime;
$numRows = $totalTime / 100;

function findEarliestTime($courses) {
	$earliest = 2359; # need some initial value for comparison
	foreach($courses as $course) {
		$courseTime = $course['time'];
		if ($courseTime < $earliest) {
			$earliest = $courseTime;
		}
	}
	return $earliest;
}
# this is essentially a copy/pasted method, I'll do it more elegantly later
function findLatestTime($courses) {
	$latest = 0000; # I know I could just say 0, but this adds some clarity
	foreach($courses as $course) {
		$courseTime = $course['time'];
		if ($courseTime > $latest) {
			$latest = $courseTime;
		}
	}
	return $latest;
}

function convertTime($miliTime) {
	$time = (string) $miliTime;
	$modifier = 'am';
	if ($time > 1200) {
		$time -= 1200;
		$modifier = 'pm';
	}

	return substr_replace($time, ':', -2, 0) . $modifier;
}
?>

	<link href="css/schedule.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/schedule.js"></script>
	<div id="main">
		<table style="width:80%">
			<tr>
				<th colspan="6" id="title">
					<p>Spring 2017 Schedule</p>
					<!-- change this to a more appropriate button type -->
					<form action="../handlers/add.php">
						<input id="add" type="submit" value="Add a Class" />
					</form>
				</th>
			</tr>
			<tr>
				<th></th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
			</tr>
			<colgroup>
				<col>
				<col style="background-color:gray;"> 
				<col>
				<col style="background-color:gray;">
				<col>
				<col style="background-color:gray;">

			<!-- php which adds rows based on 1 hr from earliest class, 1 hr after latest class -->
			<?php
				$currTime = $earliestTime;

				for ($i = 0; $i < $numRows; $i++) {
			?>
			<!-- these td elements all go on the same line as tr because of the stupid whitespace error
				 when using the firstChild/childNodes properties of a node in pure javascript -->
			<tr class="class"><td class="time_col"><?php echo convertTime($currTime); ?></td><td></td><td></td><td></td><td></td><td></td></tr>
			<?php
					$currTime += 100; # increment by an hour each time
				}
			?>
		</table>
	</div>