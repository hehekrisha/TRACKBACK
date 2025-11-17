<?php
// TRACKBACK/about.php
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>About — TrackBack Campus Lost & Found</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Your style.css -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Blobs background -->
  <div class="blob blob-1" aria-hidden="true"></div>
  <div class="blob blob-2" aria-hidden="true"></div>

  <!-- Header -->
  <header class="site-header">
    <div class="container header-inner">
      <div class="brand">
        <span class="logo-text">TrackBack</span>
        <small class="logo-sub">lost • found • reunited</small>
      </div>

      <nav class="main-nav" role="navigation" aria-label="Main">
        <a href="index.php">Home</a>
        <a href="about.php" aria-current="page">About</a>
        <a href="contact.php">Contact</a>
        <a href="user/login.php" class="btn small">Login</a>
        <a href="user/register.php" class="btn outline small">Register</a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container" style="padding: 60px 18px;">
    <article style="max-width: 700px; margin: 0 auto; color: #29104A;">
      <h1 style="font-family: 'Handlee', cursive; font-size: 42px; margin-bottom: 20px;">About TrackBack</h1>
      <p style="font-size: 18px; line-height: 1.6;">
        TrackBack is a campus-focused lost and found platform designed to help students quickly report lost or found items,
        browse listings, and get reunited with their belongings safely and securely. We prioritize privacy and use automated
        matching systems with admin verification to ensure smooth connections.
      </p>
      <p style="font-size: 18px; line-height: 1.6;">
        Our mission is to reduce chaos on campus by streamlining lost and found item reporting and matching — with a clean
        user interface and intuitive features that anyone can use.
      </p>
      <p style="font-size: 18px; line-height: 1.6;">
        We believe in creating communities where belongings find their way home, and people feel confident that help is just a few clicks away.
      </p>
    </article>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div>© <?= date('Y') ?> TrackBack — built for campus communities</div>
      <div class="foot-links"><a href="terms.php">Terms</a> · <a href="privacy.php">Privacy</a></div>
    </div>
  </footer>

</body>
</html>
