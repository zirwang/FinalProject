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
include "checkLogInStatus.php";
$currentUser = $_SESSION['username'];
include "databaseInfo.php";

// Create connection
$conn = mysqli_connect($servername, $DBusername, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$temp = "";

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>



<h1>Browse Profiles</h1>

<h2><a href="profile.php">Personal Profile</a></h2>

<ul id="schools">
<?php
// obtaining all of the schools
$schools = $conn->query("SELECT * FROM Schools");
$data = [];
$temp = "";
if ($schools->num_rows > 0) {
    // output data of each row
    while($row = $schools->fetch_assoc()) {
        $data[] = $row["Name"];

    }
}

foreach ($data as $value) { ?>
	<li><h2><?php echo $value; ?></h2>
	<ul id="users">
	<?php // obtaining all of the profiles for the given school
	$users = $conn->query("SELECT * FROM Users, Schools WHERE School = s_id AND s_id IN (SELECT s_id FROM Schools WHERE Name = '". $value ."')");
	foreach ($users as $user) { ?>
		<li><h3>User: <?php echo $user["FirstName"] . " " . $user["LastName"]; ?></h3></li>
		<img src="img/defaultprofile.png" alt="ProfilePic" style="width:152px;height:114px;">
		<ul id="user">
			<li>Age: <?php echo $user["Age"]; ?></li>
			<li>Description: <?php echo $user["Description"]; ?></li>
		</ul>
		<?php $temp = $user["Username"];?>
		<form style="width:25%" method="POST" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><button type="button" name="<?php echo $temp; ?>">Connect with this user</button></form>
	<?php } ?>
	</ul></li>
<?php } ?>
</ul>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["$temp"]);
	$sql = "INSERT INTO ConnectionsXref(PrimaryUser, Connections) Values ((Select u_ID FROM Users WHERE Username = '$currentUser'), (Select u_ID FROM Users WHERE Username = '$name'))";
	$result = $conn->query($sql);
}
?>

</body>

</html>
