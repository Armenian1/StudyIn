<?php
session_start(); # added, working before
include('common.php');
ensureLoggedIn();
session_destroy();
session_regenerate_id(TRUE);
header('Location: start.php');
?>