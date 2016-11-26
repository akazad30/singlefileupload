


        


        <?php
	require_once ('dbConfig.php');

	if (isset($_POST['login'])) {
		
		$email = $_POST['email'];
		$pass  = $_POST['password'];


				$stmt = $DB_con->prepare("SELECT Email,password from emailtable where Email = '".$_POST['email']."' and password = '".$_POST['password']."' ");
				$stmt->execute();
				if($stmt->rowCount() > 0)
				{
					 include'welcome.php';
				}
				else
				{
					?>
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
					<div class="alert alert-danger" id="warning-alert-box">
			            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			            <strong>Login Error!</strong> Forget your password!! please recover it!
			        </div>
			          </div> <!-- /container -->
	
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
					
				}

	}
	?>


  
	

	
