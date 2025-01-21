<?php
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin 
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow specific methods 
header("Access-Control-Allow-Headers: Content-Type");
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(500);
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "upendra.oli59@gmail.com"; // Change this email to your email
$subject = "$m_subject:  $name";
$body = "You have received a new message from your website contact form.\n\n";
$body .= "Here are the details:\n\nName: $name\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (!mail($to, $subject, $body, $headers)) {
    error_log("Mail sending failed for: $email, Subject: $subject");
    http_response_code(500);
} else {
    http_response_code(200);
}
?>
