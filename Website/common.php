<?php
#	Common functionality for all pages that form the StudyIn website
# session_start();

# Returns a formatted file name provided a user's username
function studyinFilename($name) {
	return 'studyin_' . $name . '.txt';
}

# Ensures that there is an existing session with the current user, otherwise redirects
# to the login page
function ensureLoggedIn() {
	if (!isset($_SESSION['name']) || !isset($_SESSION['password'])) {
		header('Location: start.php');
	}
}

# Ensures that there is no existing session with the current user, otherwise redirects
# to the main website.
function ensureLoggedOut() {
	if (isset($_SESSION['name']) || isset($_SESSION['password'])) {
		header('Location: studyin.php');
	}
}
?>