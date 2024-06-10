<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = "smtp@gmail.com";
$mail->SMTPAuth = true;
$mail->Username = 'hackeurs.poulette@gmail.com';
$mail->Password = 'jismrafxupqajvlp';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('hackeurs.poulette@gmail.com');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = ''; // TO DO
$mail->Body = ''; //TO DO

$mail->send();
?>