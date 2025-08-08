<?php
if (
    empty($_POST['name']) ||
    empty($_POST['subject']) ||
    empty($_POST['message']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    http_response_code(400);
    echo "Invalid input.";
    exit();
}

$name = trim(strip_tags(htmlspecialchars($_POST['name'])));
$email = trim(strip_tags(htmlspecialchars($_POST['email'])));
$m_subject = trim(strip_tags(htmlspecialchars($_POST['subject'])));
$message = trim(strip_tags(htmlspecialchars($_POST['message'])));

$to = "gulnazsheikh.dev@gmail.com";
$subject = "$m_subject: $name";
$body = "You have received a new message from your website contact form.\n\n"
      . "Here are the details:\n\n"
      . "Name: $name\n"
      . "Email: $email\n"
      . "Subject: $m_subject\n"
      . "Message:\n$message\n";

$headers  = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (!mail($to, $subject, $body, $headers)) {
    http_response_code(500);
    echo "Mail could not be sent.";
    exit();
}

http_response_code(200);
echo "Message sent successfully.";
?>
