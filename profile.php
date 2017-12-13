<!DOCTYPE html>
<html lang="en">


<head>
<title>Profile Page</title>
	<meta charset="UTF-8">
	<style>.error {color: #FF0000;}</style>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<h1> "Your Profile" </h1>
<img src="img/defaultprofile.png" alt="ProfilePic" style="width:304px;height:228px;">
<br/>


<?php
include "checkLogInStatus.php";

echo $_SESSION["loginTime"];

?>
</body>
</html>
