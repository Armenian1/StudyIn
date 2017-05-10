<?php
session_start(); # added, working before
include('common.php');
ensureLoggedIn();


//delete both tokens
setcookie()


session_regenerate_id(TRUE);
header('Location: index.php');
?>