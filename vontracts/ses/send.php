<?php
require('awsses.php');

$mail = new awsSes();

$recipient = array('yanser25@gmail.com', 'george@vontracts.com');
$sender = 'bryan@vontracts.com';
$subject = 'Hello from SES!';
$body = 'This is a test email sent from Amazon SES with attachment.';
$attachment = array('filename' => 'attachment.txt', 'path' => './attachment.txt', 'type' => 'text/plain');
print_r($mail->sendMail($recipient, $sender, $subject, $body, $attachment));
