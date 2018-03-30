<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
 
$to = '404.erro@gmail.com';
$subject = 'the subject';
$message = 'FROM: '.$name.' Email: '.$email.'Message: '.$message;
$headers = 'From: youremail@domain.com' . "\r\n";
 
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  
mail($to, $subject, $message, $headers);  
echo "Your email was sent!";  
}else{
echo "Invalid Email, please provide an correct email.";
}

?>