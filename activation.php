<html>
	<head><title>Registration Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" /> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!--<link rel="stylesheet" type="text/css" href="css/Table_UI.css" />-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
	</head>

	<body>

    <div class="container">


        

        <div class="card card-container">
            <!--<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />-->
            <img id="profile-img" class="profile-img-card" src="img/M2007.jpg" />
            <p id="profile-name" class="profile-name-card"></p>


            <a href="index.php" class="btn btn-info btn-block">
                Go To Login Page
            </a>
        </div><!-- /card-container -->

    </div><!-- /container -->
	
<!-- 	<script type="text/javascript" src="js/RegJS.js" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script>
                $( document ).ready(function() {
                    $("#warning-alert-box").fadeTo(5000, 500).slideUp(500, function(){
                        $("#warning-alert-box").alert('close');
                    });
                });
            </script>
	</body>
			
	</html>

<?php
require_once 'dbConfig.php';
	if(isset($_GET['actid']))
	{
		$actid = $_GET['actid'];
		//echo $actid;
	}
	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		//echo "<br />";
		//echo $act;
	}

		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$stmt = $DB_con->prepare("SELECT Email from passwordrecovery where RecoverId ='".$_GET['actid']."' and Rand ='".$_GET['act']."'  ");
		$stmt->execute();
		if($stmt->rowCount() > 0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					//echo $row['Email'];

					$q = "UPDATE emailtable SET Password=:pass WHERE Email = '".$row['Email']."' ";
					$query = $DB_con->prepare($q);
					$query->execute(array(
						':pass'     => $_GET['act']
					));

						$mail->isSMTP();                                      // Set mailer to use SMTP
											$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
											$mail->SMTPAuth = true;                               // Enable SMTP authentication
											$mail->Username = 'akazadcse11030@gmail.com';                 // SMTP username
											$mail->Password = 'akazadcse';                           // SMTP password
											$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
											$mail->Port = 587;                                    // TCP port to connect to

											$mail->setFrom('akazadcse11030@gmail.com', 'Team Azad');

											$mail->addAddress($row['Email'], 'Team Azad');     // Add a recipient

											//$mail->addAddress('abulkalamcse30@gmail.com', 'Team Azad'); 

											
											$mail->isHTML(true);                                  // Set email format to HTML

											$mail->Subject = 'Here is the subject';
											$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
											//$random_hash = rand(1,999);

											$mail->Body    = 'Your New Password is activated successfully  <br>'.$_GET["act"];

											if(!$mail->send()) {
											    echo 'Message could not be sent.';
											    echo 'Mailer Error: ' . $mail->ErrorInfo;
											} 
											else {
											    //echo 'Message has been sent';
											      ?>
													<div class="alert alert-danger" id="warning-alert-box">
									            		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									            		<strong>Check Email !!!</strong>And Login With Your Updated Password !!!
									       			 </div>
												<?php
											}

					if($q)
					{
						  //echo "New Password activated";
					
						
					}
					else
					{
						echo "New Password Activation Failed";
					}
				}
		}
		else
		{
			echo "check your activation id and code properly";
		}




?>