
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Classmates Connect</title>
	<meta charset="UTF-8">
	<style>.error {color: #FF0000;}</style>
  <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>

	<?php
	include "databaseInfo.php";

	$data = [];
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	session_start();
	// define variables and set to empty values
	$name = $password = "";
	$nameErr = $passwordErr ="";
	$invaliderr = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$valid = true;
		if (empty($_POST["username"])) {
			$nameErr = "Username is required";
			$valid = false;
		} else {
			$name = test_input($_POST["username"]);
			$sql = "SELECT Password FROM Users Where Username = '$name'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        $data[] = $row["Password"];
			    }
					$password = $data[0];
			}
			else{
				echo "<span class='error'>No account is associated with this username!</span>";
				$invaliderr =true;
			}
		}
		if (empty($_POST["password"])) {
			$passwordErr = "Password is required";
			$valid = false;
		}
		else if($password != $_POST["password"]){
			if($invaliderr == false){
				echo "<span class='error'>Incorrect Username or Password!</span>";
			}
			$valid = false;
		}
		else {
			$password = test_input($_POST["password"]);
		}
		if($valid){
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['loginTime'] = time();
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

<h2>Welcome to Classmates Connect!</h2>

<form method = "POST" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  <div class="imgcontainer">
    <img src="img/logo.jpg" alt="logo" class="avatar">
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
		<a href="newUser.php">Sign Up!</a>
  </div>
</form>


  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="forgotPassword.php">password?</a></span>
  </div>

</body>
</html>
