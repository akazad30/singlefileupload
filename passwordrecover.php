<?php
	require_once ('dbConfig.php');

	if (isset($_POST['login'])) {
		
		$email = $_POST['email'];
	


				$stmt = $DB_con->prepare("SELECT Password from emailtable where Email = '".$_POST['email']."' ");
				$stmt->execute();
				if($stmt->rowCount() > 0)
				{
						require 'PHPMailer/PHPMailerAutoload.php';
						$mail = new PHPMailer;

							$random_hash = rand(1,999);
							$status = 1;
							$stmt = $DB_con->prepare('INSERT INTO passwordrecovery(Email,Rand,Status) 
								VALUES(:email, :rand, :status)');
							$stmt->bindParam(':email',$_POST['email']);
							$stmt->bindParam(':rand',$random_hash);
							$stmt->bindParam(':status',$status);
							$a = $stmt->execute();
							if($a)
							{
								$stmt = $DB_con->prepare("SELECT RecoverId,Rand from passwordrecovery where Email ='".$_POST['email']."' limit 1 ");
								$stmt->execute();
								if($stmt->rowCount() > 0)
								{
									while($row=$stmt->fetch(PDO::FETCH_ASSOC))
									{
										// mailing code start
											$mail->isSMTP();                                      // Set mailer to use SMTP
											$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
											$mail->SMTPAuth = true;                               // Enable SMTP authentication
											$mail->Username = 'akazadcse11030@gmail.com';                 // SMTP username
											$mail->Password = 'akazadcse';                           // SMTP password
											$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
											$mail->Port = 587;                                    // TCP port to connect to

											$mail->setFrom('akazadcse11030@gmail.com', 'Team Azad');

											$mail->addAddress($_POST['email'], 'Team Azad');     // Add a recipient

											$mail->isHTML(true);                                  // Set email format to HTML

											$mail->Subject = 'Here is the subject';
											$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
											//$random_hash = rand(1,999);

											$mail->Body    = ' You must follow this link to activate your account:

											Link : http://'.$_SERVER['HTTP_HOST'].'/RegForm/activation.php?actid='.$row['RecoverId'].'&act='.$row['Rand'];

											if(!$mail->send()) {
											    echo 'Message could not be sent.';
											    echo 'Mailer Error: ' . $mail->ErrorInfo;
											} 
											else {
											    //echo 'Message has been sent';
											    ?>
													<div class="alert alert-danger" id="warning-alert-box">
									            		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									            		<strong>Check Email !!!</strong>Message has been sent to Your Email!
									       			 </div>
												<?php
											}
										//mailing code end

									}
								}
								else
								{
									echo "no data receive from this Email";
									
								}



							}

							//last part
							else
							{
								echo "data insert failed into recovery table";
							
							}

				}
	
								
				else
					{
						//echo "invalid email";
						?>
							<div class="alert alert-danger" id="warning-alert-box">
					            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					            <strong>Email is Invalid!</strong> Forget your Email!! please Contact with Admin!
					        </div>
						<?php
					}
					

	}

	else
	{
	
	}

?>