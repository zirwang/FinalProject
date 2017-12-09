

<label><b>Send Recovery Email</b></label>
<input type="text" placeholder="Enter Email" name="email" required>


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
  <a href = >Click Here to Reset Your Password</a>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';


// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
?>
