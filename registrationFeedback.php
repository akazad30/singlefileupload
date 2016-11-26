<?php
require_once('dbConfig.php'); 
	if(isset($_GET['login']))
	{
		$email = $_GET['email'];
		echo $email;
		$pass = $_GET['password'];

		require 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'akazadcse11030@gmail.com';                 // SMTP username
		$mail->Password = 'akazadcse';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('akazadcse11030@gmail.com', 'Team Azad');

		$mail->addAddress($_GET['email'], 'Team Azad');     // Add a recipient

		//$mail->addAddress('abulkalamcse30@gmail.com', 'Team Azad'); 

		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$random_hash = rand(1,999);

		$mail->Body    = 'Thanks for signing up with Bangla-Made! You must follow this link to activate your account:

		Link : http://'.$_SERVER['HTTP_HOST'].'/activation.php?act='.$random_hash;

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}

	}
	else
	{
		echo "no data received";
	}

?>