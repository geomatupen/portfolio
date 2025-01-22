<?php
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "upendra.oli59@gmail.com";
$subject = "$m_subject:  $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";
$header = "From: $email";
$header .= "Reply-To: $email";	

// First, instantiate the SDK with your API credentials
$mg = Mailgun::create('key-example'); // For US servers
$mg = Mailgun::create('key-example', 'https://api.eu.mailgun.net'); // For EU servers

// Now, compose and send your message.
// $mg->messages()->send($domain, $params);
$mg->message()->send('sandbox205be971ba9f4a44a2c57b5f0d016e7e.mailgun.org', [
  'from'		=> 'mailgun@YOUR_DOMAIN_NAME',
  'to'			=> 'YOU@YOUR_DOMAIN_NAME',
  'subject' => 'Hello',
  'text'		=> 'Testing some Mailgun awesomeness!'
]);

if(!mail($to, $subject, $body, $header))
  http_response_code(500);
?>
