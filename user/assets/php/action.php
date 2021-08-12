<?php

	session_start();

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/autoload.php';

	$mail = new PHPMailer(true);

	require_once 'auth.php';

	$user = new Auth();

	//Handle Register Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'register') {
		$name = $user->test_input($_POST['name']);
		$email = $user->test_input($_POST['email']);
		$pass = $user->test_input($_POST['password']);
		$password = password_hash($pass, PASSWORD_DEFAULT);

		if ($user->user_exist($email)) {
			echo $user->showMessage('warning', 'This E-Mail is already registred.');
		} else {
			if ($user->register($name,$email,$password)) {
				echo 'register';
				$_SESSION['user'] = $email;

				$token = uniqid();
				$token = str_shuffle($token);
				$user->forgot_password($token,$email);

				$mail->isSMTP();
	            $mail->Host = 'smtp.gmail.com';
	            $mail->SMTPAuth = true;
	            $mail->Username = Database::USERNAME;
	            $mail->Password = Database::PASSWORD;
	            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	            $mail->Port = 587;

	            $mail->setFrom(Database::USERNAME,'Ventura - User Management');
	            $mail->addAddress($email);

	            $mail->isHTML(true);
	            $mail->Subject = 'E-Mail Verification';
	            $mail->Body = '<h3>Click the below link to verify your email address.</h3><br><a href="http://localhost/user_management/verify-email.php?email='.$email.'&token='.$token.'">http://localhost/user_management/verify-email.php?email='.$email.'&token='.$token.'</a><br><br><br>Regards,<br>Ventura - User Management';
	            
	            $mail->send();

			} else {
				echo $user->showMessage('danger', 'Something went wrong. Try again later.');
			}
		}
	}

	//Handle Login Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'login') {
		$email = $user->test_input($_POST['email']);
		$password = $user->test_input($_POST['password']);

		$loggedInUser = $user->login($email);

		if($loggedInUser != null) {
			if (password_verify($password, $loggedInUser['password'])) {
				if (!empty($_POST['rem'])) {
					setcookie("email", $email, time()+(30*24*60*60), '/');
					setcookie("password", $password, time()+(30*24*60*60), '/');
				} else {
					setcookie("email","",1, '/');
					setcookie("password","",1, '/');
				}

				echo 'login';
				$_SESSION['user'] = $email;
			} else {
				echo $user->showMessage('danger', 'Password is incorrect.');
			}
		} else {
			echo $user->showMessage('danger', 'User is not found.');
		}
	}

	//Handle Forgot Password Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'forgot') {
		$email = $user->test_input($_POST['email']);

		$user_found = $user->currentUser($email);

		if ($user_found != null) {
			$token = uniqid();
			$token = str_shuffle($token);
			$user->forgot_password($token,$email);

			try {
				$mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = Database::USERNAME;
                $mail->Password = Database::PASSWORD;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom(Database::USERNAME,'Ventura - User Management');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Reset Password';
                $mail->Body = '<h3>Click the below link to reset your password.</h3><br><a href="http://localhost/user_management/reset-password.php?email='.$email.'&token='.$token.'">http://localhost/user_management/reset-password.php?email='.$email.'&token='.$token.'</a><br><br><br>Regards,<br>Ventura - User Management';
                
                $mail->send();
				echo $user->showMessage('success', 'We have send you password reset link to your email.');
			} catch(Exception $e) {
				echo $user->showMessage('danger', 'Something went wrong. Try again later.');
			}
		} else {
			echo $user->showMessage('danger', 'This E-Mail is not registred.');
		}
	}

	if (isset($_POST['action']) && $_POST['action'] == 'checkUser') {
		if (!$user->currentUser($_SESSION['user'])) {
			echo 'bye';
			unset($_SESSION['user']);
		}
	}
?>