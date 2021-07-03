<?php

require_once 'header.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$message = $_POST['message'];
$formcontent=" From: $name \n Phone: $phone  \n Message: $message";
$recipient = "ashprime12345@gmail.com";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "<h1 class = 'sent-mail'>Благодарим ви!</h1>" . "<div class='container'><a href='index.php' class='return-link container'> Към началната страница</a></div>";
?>
