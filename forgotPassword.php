
<form method="POST" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<label><b>Send Recovery Email</b></label>
<input type="text" placeholder="Enter Email" name="email" required>
<input type="submit" name="submit" value="Submit!" />
 </form>

<?php
$email = "";
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
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
// Multiple recipients
$to = $email; // note the comma

// Subject
$subject = 'Classmates Connect Password Reset';

// Message
$message = '
<html>
<head>
  <title>Classmates Connect Password Recovery</title>
</head>
<body>
  <a href="http://luna.mines.edu/zirwang/FinalProject/resetPassword.php">Click Here to Reset Your Password</a>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';


// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
?>
