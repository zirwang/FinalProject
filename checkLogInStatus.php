<?php
session_start();
if(!array_key_exists("username", $_SESSION)) {
	header('Location: index.php');
	die();
}
?>
