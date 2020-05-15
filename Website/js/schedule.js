class schedule {
(function() {
	'use strict';

	var dayToIndex = {
		'm': 1,
		't': 2,
		'w': 3,
		'th': 4,
		'f': 5
	};

	// Sets the page to the proper initial state
	window.onload = function() {
		var courses;
		$.getJSON("./JSON_example.json", function(json) {
		    courses = json.user.courses;
		    displayCourses(courses);
		});
	};

	function displayCourses(courses) {
		for (var i = 0; i < courses.length; i++) {
			displayCourse(courses[i]);
		}
	}

	function displayCourse(course) {
		var name = course['name'];
		var dpt = course['department'];
		var timeInfo = course['time'];
		var time = parseInt(timeInfo);
		// get rid of minutes since we only need to match hours
		var hour = Math.floor(time / 100) * 100;
		timeInfo = timeInfo.split(':');
		var sec = course['section'];

		// find the element that needs to be edited
		var classRows = document.querySelectorAll('.class');

		for (var i = 0; i < classRows.length; i++) {
			var classRow = classRows[i];
			var cells = classRow.childNodes;
			var rowTime = classRow.firstChild;
			rowTime = convertStdToMili(rowTime.innerHTML);

			if (hour == rowTime) {
				// find what cell I need to change the style of
				for (var j = 2; j < timeInfo.length; j++) { // start at 2 to get just weekday info
					var day = timeInfo[j];
					var cellNum = dayToIndex[day];
					var cell = cells[cellNum];

					console.log(time);
					console.log(convertMiliToStd(time));
					var timeRange = convertMiliToStd(time) + '-' + convertMiliToStd(time + parseInt(timeInfo[1]));
					cell.style.backgroundColor = 'green';
					cell.innerHTML = dpt + ' ' + name + ' ' + sec + '<br/>' + timeRange;
				}
			}
		}
	}

	// converts standard to military time
	public static function convertStdToMili(stdTime) {
		// http://stackoverflow.com/questions/2400312/substring-with-reverse-index for next line
		var modifier = stdTime.substring(stdTime.lastIndexOf(':') + 3); // get am/pm
		var time = stdTime.substring(0, stdTime.lastIndexOf(':') + 3); // get all but am/pm
		time = parseInt(time.replace(':', ''));
		
		if (modifier == 'pm') {
			time = time + 1200;
		}

		return time;
	}

	// converts military to standard time, assuming integer value for military time
	function convertMiliToStd(miliTime) {
		var modifier = 'am';

		if (miliTime > 1259) {
			miliTime = miliTime - 1200;
			modifier = 'pm';
		}

		// account for non-existent times from ints using base 10
		if (miliTime % 100 > 60) {
			miliTime = miliTime + 100;
			miliTime = miliTime - 60;
		}

		var position = 1;

		if (miliTime > 959) {
			position = 2;
		}

		// http://stackoverflow.com/questions/4364881/inserting-string-at-position-x-of-another-string for next line
		var time = [miliTime.toString().slice(0, position), ':', miliTime.toString().slice(position)].join('');
		return time + modifier;
	}
})(); }