<?php
    include "lib/loginAction.php";
	$db = new loginAction();	
	//inserting into customer table
	if (isset($_POST['submit'])) {
		$name        = htmlspecialchars($_POST['name']);
        $user        = htmlspecialchars($_POST['username']);
        $password     = htmlspecialchars($_POST['pass']); // do your password hash here... or in the reg method
        $confirm_pass = htmlspecialchars($_POST['confirm']); //crypt($_POST['confirm'], [salt == NULL])
        if ($password == $confirm_pass) {
			$user_exist = $db->user_exist($user);
            if ($user_exist) {
				echo "<script>alert('$user already exist try another username')</script>";
			}else{
                $regs = $db->register($name, $user, $password);
                if ($regs['status']) {
					echo "<script>alert(' Registration successful! yeah!!')</script>";
					header('location: login.php');
					
                } else {
                    echo "<script>alert(' Registration Not successful!!')</script>";
                    $active = 'active';
                    echo $regs['message'];
                }
            } 
           
		}
		else {
            echo "<script>alert(' password not matched!!')</script>";
			$active = 'active';}
	
		}
		if (isset($_POST['login'])) {	
			header('location:login.php');
		}	
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>signUp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/form/util.css">
	<link rel="stylesheet" type="text/css" href="css/form/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign Up
					</span>
				</div>

				<form class="login100-form validate-form" method="post" action="signup.php">
					<div class="wrap-input100 validate-input m-b-26" data-validate="name is required">
						<span class="label-input100">Name</span>
						<input class="input100" type="text" name="name" placeholder="Enter name">
						<span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="confirm" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>



					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit" value="signup">
							SignUp
						</button>&nbsp;&nbsp;
						<button class="login100-form-btn" name="login" value="login">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/form.js"></script>

</body>
</html>