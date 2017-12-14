<!DOCTYPE html>
<html lang="en">


<head>
<title>Profile Page</title>
	<meta charset="UTF-8">
	<style>.error {color: #FF0000;}</style>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>

<?php
include "checkLogInStatus.php";

include "databaseInfo.php";

// Create connection
$conn = mysqli_connect($servername, $DBusername, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$username = $_SESSION['username'];

$sql = "SELECT FirstName, LastName, Description, u_ID FROM Users WHERE Username = '$username'";
$result = $conn->query($sql);

$first = $last = $about = $temp = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $first[]= $row["FirstName"];
        $last[] = $row["LastName"];
        $about[] = $row["Description"];
				$temp[] = $row["u_ID"];
    }
}
else{
  echo "0 results";
}
$userID = $temp[0];
?>

<body>
<?php echo "<h1> Welcome $first[0]! </h1>"; ?>

<h2><a href="browseProfiles.php">Browse Profiles</a></h2>

<img src="img/defaultprofile.png" alt="ProfilePic" style="width:304px;height:228px;">
<br/>
<h3> Your Profile:</h3>

<?php echo "<p> $about[0] </p>"; ?>

<h3> Your Connections:</h3>
<?php
$sql = "SELECT Users.FirstName, Users.LastName, Users.UserName FROM Users WHERE Users.u_id IN (SELECT Connections FROM ConnectionsXref WHERE PrimaryUser = $userID)";
$result = $conn->query($sql);

$first = $last = $about = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			  echo "<p>";
        echo $row["FirstName"]." ";
        echo $row["LastName"]." ";
				echo "</p>";
    }
}
else{
  echo "No Connections";
}


?>



</body>
</html>
