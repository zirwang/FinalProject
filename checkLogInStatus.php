<?php
session_start();
if(!array_key_exists("loginTime", $_SESSION)) {
	header('Location: index.php');
	die();
}
?>
