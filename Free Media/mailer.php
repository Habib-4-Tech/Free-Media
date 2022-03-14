<?php
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth="true";
$mail->SMTPSecure="tls";
$mail->Port = "587";
$mail->Username= "rudra.habib@gmail.com";
$mail->Password= "";
$mail->Subject= "Test Mail";
$mail->setFrom("rudra.habib@gmail.com");
$mail->Body = "Test";
$mail->addAddress("2018-1-60-063@std.ewubd.edu");
if($mail->Send())
{
	echo "Sent";
	
}
else
{
	echo "Not sent";
}
$mail->smtpClose();
?>