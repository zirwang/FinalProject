

<!DOCTYPE html>
<html lang="en">


<head>
<title> ClassMates Connect </title>
	<meta charset="UTF-8">
	<meta name="author" content="Ruby Wang">
</head>

<body>

<?php

session_start();

include "databaseInfo.php";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$firstName = $_SESSION['first'];
$lastName =$_SESSION['last'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$age = $_SESSION['age'];
$password = $_SESSION['password'];
$school = $_SESSION['school'];
$about = $_SESSION['profile'];

$sql = "SELECT 1 from Users WHERE FirstName = '$firstName' AND  LastName='$lastName' AND  Username='$username'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "<h3> Thanks for joining Classmates Connect! </h3>";
		echo "<a href =index.php> Click Here to Log In </a>";
		$sql = "INSERT INTO Users(FirstName, LastName, Username, Email, Password, Age, School, Description) VALUES ('$firstName','$lastName','$username','$email','$password','$age',(SELECT s_ID FROM Schools Where Name = '$school'), '$about')";
		$result = $conn->query($sql);
} else {
    echo "<h3> This account already exists! </h3>";
}

?>

</body>
</html>
