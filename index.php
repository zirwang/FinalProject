
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Classmates Connect</title>
	<meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>

<h2>Welcome to Classmates Connect!</h2>

<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="img/logo.jpg" alt="logo" class="avatar">
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
		<a href="newUser.php">Sign Up!</a>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>

    <span class="psw">Forgot <a href="forgotPassword.php">password?</a></span>
  </div>
</form>

<?php
$servername = "localhost";
$username = "zirwang";
$password = "QUAQKECA";
$dbname = "f17_zirwang";

$data = [];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
// define variables and set to empty values
$name =$password = "";
$nameErr = $passwordErr ="";

$sql = "SELECT Name FROM Schools";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row["Name"];

    }
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
	$valid = true;
	if (empty($_POST["name"])) {
	 $nameErr = "Username is required";
	 $valid = false;
 } else {
	 $name = test_input($_POST["name"]);
 }
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
		$valid = false;
  } else {
    $password = test_input($_POST["password"]);
  }
	if($valid){
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			header('Location:profile.php');
	    exit();
		}
}
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>


</body>
</html>