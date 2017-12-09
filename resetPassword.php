<form method="POST" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<label><b>Email:</b></label>
<input type="text" placeholder="Enter Email" name="email" required>
<label><b>New Password:</b></label>
<input type="text" placeholder="New Password" name="password" required>
<input type="submit" name="submit" value="Submit!" />
</form>

<?php
$email = "";
$newPassword = "";
if ($_SERVER["REQUEST_METHOD"]== "POST") {
  if (empty($_POST["email"])) {
   $emailErr = "Email is required";
  } else {
   $email = test_input($_POST["email"]);
   // check if e-mail address is well-formed
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $emailErr = "Invalid email format";
   }
  }
  if (empty($_POST["password"])) {
   $passErr = "Password is required";
  } else {
   $newPassword = test_input($_POST["password"]);
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//updates database
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

$sql = "Update Users SET Password = '$newPassword' WHERE Email = '$email'";
$result = $conn->query($sql);
echo $newPassword;
?>
