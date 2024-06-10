<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "./phpmailer/src/Exception.php";
require "./phpmailer/src/PHPMailer.php";
require "./phpmailer/src/SMTP.php";

function sendmail($mailaddress, $firstname)
{
    $mail = new PHPMailer(true);
    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hackeurs.poulette@gmail.com';
        $mail->Password = 'jismrafxupqajvlp';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('hackeurs.poulette@gmail.com');
        $mail->addAddress($mailaddress);
        $mail->isHTML(true);
        $mail->Subject = ''; // TO DO
        $mail->Body = ''; //TO DO

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. PHPMailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['first-name']) && (isset($_POST['last-name'])) && (isset($_POST['gender'])) && (isset($_POST['email'])) && (isset($_POST['country'])) && (isset($_POST['subject'])) && (isset($_POST['message']))) {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $gender = $_POST['gender'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $country = $_POST['country'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    echo "<h1> $first_name </h1>";
    echo "<h1> $last_name </h1>";
    echo "<h1> $gender </h1>";
    echo "<h1> $email </h1>";
    echo "<h1> $country </h1>";
    echo "<h1> $subject </h1>";
    echo "<h1> $message </h1>";

    sendmail($email, $first_name);
}

?>