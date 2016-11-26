<?php
require 'control/phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'discountshopbd420@gmail.com';                 // SMTP username
$mail->Password = 'discountshopbd';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('discountshopbd420@gmail.com', 'Mailer');
$mail->addAddress($email);               // Name is optional

$mail->Subject = 'Bangla-Made';
$mail->Body    = 'Thanks for signing up with Bangla-Made! You must follow this link to activate your account:

Link : http://'.$_SERVER['HTTP_HOST'].'/activation.php?act='.$random_hash;

if(!$mail->send()) {
	$cheader = 'Error';
	$ctype = 'error';
    $cmsg = 'Message could not be sent.';
    $cmsg .= 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	$cheader = 'Confirmation';
	$ctype = 'success';
    $cmsg = 'Password create successfully. Please check your email address to activate your email address';

}