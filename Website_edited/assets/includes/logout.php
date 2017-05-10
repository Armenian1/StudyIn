<?php
session_start(); # added, working before
include('common.php');
ensureLoggedIn();

//delete both tokens
setcookie('tToken','');
setcookie('rToken','');

session_regenerate_id(TRUE);
header('Location: index.php');
?>