<!DOCTYPE html>
<html lang="en">


<head>
<title> Sign Up for Classmates Connect </title>
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
$sql = "SELECT Name FROM Schools";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row["Name"];

    }
}

session_start();
// define variables and set to empty values
$first = $last = $email = $name =$age= $password =$school =$about= "";
$firstErr = $lastErr = $emailErr = $nameErr = $passwordErr = $schoolErr ="";

if ($_SERVER["REQUEST_METHOD"]== "POST") {
	$valid = true;
	if (empty($_POST["first"])) {
	 $firstErr = "First name is required";
	 $valid = false;
 } else {
	 $first = test_input($_POST["first"]);
	 // check if name only contains letters and whitespace
	 if (!preg_match("/^[a-zA-Z\']*$/",$first)) {
		 $firstErr = "Only letters, apostrophes, and white space allowed";
		 $valid = false;
	 }
 }
  if (empty($_POST["last"])) {
    $lastErr = "Last name is required";
		$valid = false;
  } else {
    $last = test_input($_POST["last"]);
		if (!preg_match("/^[a-zA-Z\']*$/",$last)) {
 		 $lastErr = "Only letters, apostrophes, and white space allowed";
		 $valid = false;
 	 }
  }

	if (empty($_POST["email"])) {
	 $emailErr = "Email is required";
	 $valid = false;
 } else {
	 $email = test_input($_POST["email"]);
	 // check if e-mail address is well-formed
	 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 $emailErr = "Invalid email format";
		 $valid = false;
	 }
 }

	if (empty($_POST["username"])) {
    $nameErr = "Username is required";
		$valid = false;
  } else {
		$name = test_input($_POST["username"]);
  }
	if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
		$valid = false;
  } else {
    $password = test_input($_POST["password"]);
  }
	if (empty($_POST["school"])) {
    $schoolErr = "School name is Required";
		$valid = false;
  } else {
    $donation = test_input($_POST["school"]);
  }
  $age = test_input($_POST["age"]);
	$about = test_input($_POST["profile"]);
	if($valid){
      $_SESSION['email'] = $_POST['email'];
			$_SESSION['first'] = $_POST['first'];
			$_SESSION['last'] = $_POST['last'];
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['school'] = $_POST['school'];
			$_SESSION['age'] = $_POST['age'];
			$_SESSION['profile'] = $_POST['profile'];
			header('Location:userSubmit.php');
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
	<h1>Create Your Profile</h1>
  <form method="POST" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    <p><span class="error">* required field</span></p>
		<fieldset>
		 <p>
			 <label for="first">First Name: </label>
       <span class="error">* <?php echo $firstErr;?></span>
 			 <input type="text" name="first" size="20" maxlength="20" id = "first"/>

     </p>

     <p>
			 <label for="last">Last Name: </label>
       <span class="error">* <?php echo $lastErr;?></span>
			 <input type="text" name="last" size="20" maxlength="20" id = "last" />

     </p>
     <p>
			 <label for="email">Email: </label>
       <span class="error">* <?php echo $emailErr;?></span>
			 <input type="text" name="email" size="40" maxlength="40" id ="email"/>

     </p>
     <p>
      <label for="age">Age:</label>
      <input type="text" name="age" size="20" maxlength="20" id ="age"/>
     </p>
     <p>
			 <label for="username">Username: </label>
			 <span class="error">* <?php echo $nameErr;?></span>
			 <input type="text" name="username" size="20" maxlength="20" id="name"/>

     </p>
     <p>
			 <label for="password">Password: </label>
			 <span class="error">* <?php echo $passwordErr;?></span>
			 <input type="password" name="password" size="20" maxlength="20" id="password"/>

     </p>
		 <p>

				<span class="error">* <?php echo $schoolErr;?></span>
				<br>
				<label for="school">Select School: </label>
  			 <select name="school" id ="school">
          <option value="">Choose one</option>
					<?php foreach($data as $value) { ?>
          <option value="<?php echo $value ?>" > <?php echo $value;?></option>
      <?php } ?>
        </select>
     </p>
		 <p>
      <label for="profile">Write a Short Profile:</label>
      <input type="text" name="profile" size="100" maxlength="200" id ="profile"/>
     </p>

	 </fieldset>
     <p>
          <button type="submit">Join!</button>
					<button type="button" class="cancelbtn">Reset</button>
     </p>
   </form>

</body>
</html>
