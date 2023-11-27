<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/

//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	function sendEmail($send_to="", $message=""){
		//Create instance of PHPMailer
	$mail = new PHPMailer(true);
	//Set mailer to use smtp
		$mail->isSMTP();
	//Define smtp host
		$mail->Host = "smtp.gmail.com";
	//Enable smtp authentication
		$mail->SMTPAuth = true;
	//Set smtp encryption type (ssl/tls)
		$mail->SMTPSecure = "tls";
	//Port to connect smtp
		$mail->Port = "587";
	//Set gmail username
		$mail->Username = "theunitedtaste@gmail.com";
	//Set gmail password
		$mail->Password = "sksickrjkyxrnvlj";
	//Email subject
		$mail->Subject = "United Tastes";
	//Set sender email
		$mail->setFrom('theunitedtaste@gmail.com');
	//Enable HTML
		$mail->isHTML(true);
	//Attachment
		//$mail->addAttachment('img/attachment.png');
	//Email body
		$mail->Body = "
		<h1 style='text-align:center;'>United Taste</h1>
		</br>
		<p>{$message}</p>";
	//Add recipient
		//$mail->addAddress('WayneStateCSC5750Grp9@gmail.com');
		$mail->addAddress($send_to);
		//Finally send email
		if ( $mail->send() ) {
			$mess =  "Email Sent..!";
		}else{
			$mess = "Message could not be sent. Mailer Error:";
		}
	//Closing smtp connection
		$mail->smtpClose();
	}