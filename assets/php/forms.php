<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "./phpmailer/src/Exception.php";
require "./phpmailer/src/PHPMailer.php";
require "./phpmailer/src/SMTP.php";

function sendmail($mailaddress, $firstname, $subject, $message)
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
        $mail->Subject = "Your support request is being handled";
        $mail->Body = "
                <p>Hey $firstname,</p>
                <p>We have well received your request. Here is a summary:</p>
                <div style='border: 1px solid lightgrey; border-radius: 10px; padding: 5px;'>
                    <p><strong>Subject:</strong> $subject</p>
                    <p><strong>Message:</strong></p>
                    <p>$message</p>
                </div>
                <p>We are currently working on your request and will get back to you within 48 hours.</p>
                <p>Thank you for your patience.</p>
                <p>Best regards,<br>Support Team</p>
        ";
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. PHPMailer Error: {$mail->ErrorInfo}";
    }
}
function sanitize_input($data)
{
    // Trim leading and trailing whitespace
    $data = trim($data);

    // Strip HTML and PHP tags
    $data = strip_tags($data);

    // Convert special characters to HTML entities to prevent XSS
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

    // Remove backslashes
    $data = stripslashes($data);

    return $data;
}

header('Content-Type: application/json');

$response = [
    'valid' => true,
    'errors' => []
];

// Simulate server-side validation
if (empty(sanitize_input($_POST['first-name']))) {
    $response['valid'] = false;
    $response['errors']['first-name'] = "First name is required.";
}

if (empty(sanitize_input($_POST['last-name']))) {
    $response['valid'] = false;
    $response['errors']['last-name'] = "Last name is required.";
}

if (empty(sanitize_input($_POST['gender']))) {
    $response['valid'] = false;
    $response['errors']['gender'] = "Gender is required.";
}

if (empty(sanitize_input($_POST['email']))) {
    $response['valid'] = false;
    $response['errors']['email'] = "Email is required.";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $response['valid'] = false;
    $response['errors']['email'] = "Invalid email format.";
}

if (empty(sanitize_input($_POST['country']))) {
    $response['valid'] = false;
    $response['errors']['country'] = "Country is required.";
}

if (empty(sanitize_input($_POST['subject']))) {
    $response['valid'] = false;
    $response['errors']['subject'] = "Subject is required.";
}

if (empty(sanitize_input($_POST['message']))) {
    $response['valid'] = false;
    $response['errors']['message'] = "Message is required.";
}

if ($response['valid']) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $first_name = sanitize_input($_POST['first-name']);
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);

    sendmail($email, $first_name, $subject, $message);
}

// Return the validation response
echo json_encode($response);

?>