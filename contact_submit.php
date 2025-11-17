<?php
// contact_submit.php

// Change this to your actual email address for receiving contact messages
$admin_email = "your-email@example.com";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate inputs
    $name = trim(filter_var($_POST['name'] ?? '', FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $message = trim(filter_var($_POST['message'] ?? '', FILTER_SANITIZE_STRING));

    $errors = [];

    if (!$name) {
        $errors[] = "Please enter your name.";
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    if (!$message) {
        $errors[] = "Please enter your message.";
    }

    if (empty($errors)) {
        // Prepare email
        $subject = "New Contact Message from TrackBack Website";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Send email
        $mail_sent = mail($admin_email, $subject, $body, $headers);

        if ($mail_sent) {
            $success = true;
        } else {
            $errors[] = "Failed to send your message. Please try again later.";
        }
    }
} else {
    // Redirect to contact page if accessed directly
    header("Location: contact.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact Submission — TrackBack</title>
  <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="blob blob-1" aria-hidden="true"></div>
  <div class="blob blob-2" aria-hidden="true"></div>

  <header class="site-header">
    <div class="container header-inner">
      <div class="brand">
        <span class="logo-text">TrackBack</span>
        <small class="logo-sub">lost • found • reunited</small>
      </div>

      <nav class="main-nav" role="navigation" aria-label="Main
