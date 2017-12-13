<?php
session_start();
if(!array_key_exists("loginTime", $_SESSION)) {
	header('Location: index.php');
	die();
}
$elapsedTime = time() - $_SESSION["loginTime"];
echo "Elapsed time: " . $elapsedTime . "<br>";
if ($elapsedTime > 120) {
	echo "Sign user out";
} else {
	echo "User does not need to be signed out";
}
?>
