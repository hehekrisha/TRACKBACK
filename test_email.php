<?php
require_once __DIR__ . '/includes/mailer.php';

$ok = sendMail('recipient@example.com', 'Test from TrackBack', '<b>Hi — test email from TrackBack.</b>');

if ($ok) echo "Email sent OK";
else echo "Email failed to send";
