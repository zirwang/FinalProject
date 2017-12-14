

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
if(!array_key_exists("username", $_SESSION)) {
	header('Location: index.php');
	die();
}

include "databaseInfo.php";

// Create connection
$conn = mysqli_connect($servername, $DBusername, $password, $dbname);
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
$about = htmlspecialchars($_SESSION['profile']);

$sql = "SELECT 1 from Users WHERE Username='$username'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "<h3> Thanks for joining Classmates Connect! </h3>";
		echo "<a href=index.php> Click Here to Log In </a>";
		$sql = $conn->prepare("INSERT INTO Users(FirstName, LastName, Username, Email, Password, Age, School, Description) VALUES (?,?,?,?,?,?,(SELECT s_ID FROM Schools Where Name = ?), ?)");
		$sql->bind_param("sssssiss", $firstName, $lastName, $username, $email, $password, $age, $school, $about);
		$sql->execute();
} else {
    echo "<h3> This account already exists! </h3>";
}

?>

</body>
</html>
