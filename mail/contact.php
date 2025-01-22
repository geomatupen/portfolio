<?php
require 'vendor/autoload.php'; // Include the Autoloader
use Mailgun\Mailgun;

if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "upendra.oli59@gmail.com"; // Your email address
$subject = "$m_subject:  $name";
$body = "You have received a new message from your website contact form.\n\n".
        "Here are the details:\n\nName: $name\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";

// Instantiate the SDK with your Mailgun API credentials
$mg = Mailgun::create(''); 
$domain = ''; 

// Compose and send your message
try {
    $mg->messages()->send($domain, [
        'from'    => "mailgun@$domain",
        'to'      => $to,
        'subject' => $subject,
        'text'    => $body
    ]);
    http_response_code(200);
} catch (Exception $e) {
    http_response_code(500);
    echo 'Message could not be sent. Mailer Error: ', $e->getMessage();
}
?>
