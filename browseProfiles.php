<!DOCTYPE html>
<html lang="en">

<head>
<title>Browse Profiles</title>
	<meta charset="UTF-8">
	<style>.error {color: #FF0000;}</style>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>

<?php
include "databaseInfo.php";

// Create connection
$conn = mysqli_connect($servername, $DBusername, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<h1>Browse Profiles</h1>

<h2><a href="profile.php">Personal Profile</a></h2>

<ul id="schools">
<?php
// obtaining all of the schools
$schools = $conn->query("SELECT * FROM schools");
foreach ($schools as $school) { ?>
	<li><h2><?php echo $school["Name"]; ?></h2>
	<ul id="users">
	<?php // obtaining all of the profiles for the given school
	$users = $conn->query("SELECT * FROM users, schools 
	WHERE school = s_id AND s_id IN (SELECT S_id FROM schools WHERE Name = '". $school["Name"] ."')");
	foreach ($users as $user) { ?>
		<li><h3>User: <?php echo $user["FirstName"] . " " . $user["LastName"]; ?></h3></li>
		<img src="img/defaultprofile.png" alt="ProfilePic" style="width:152px;height:114px;">
		<ul id="user">
			<li>Age: <?php echo $user["Age"]; ?></li>
			<li>Description: <?php echo $user["Description"]; ?></li>
		</ul>
		<form style="width:50%"><button type="button" name="connect">Connect with this user</button></form>
	<?php } ?>
	</ul></li>
<?php } ?>
</ul>

</body>

</html>