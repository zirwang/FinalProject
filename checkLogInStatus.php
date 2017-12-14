<?php
session_start();
if(!array_key_exists("loginTime", $_SESSION)) {
	header('Location: index.php');
	die();
}
$elapsedTime = time() - $_SESSION["loginTime"];
if ($elapsedTime > 60) {
	unset($_SESSION["loginTime"]);
	header('Location: index.php');
	die();
} else {
	$_SESSION["loginTime"] = time();
}
?>
