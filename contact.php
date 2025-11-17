<?php
// TRACKBACK/contact.php
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact — TrackBack Campus Lost & Found</title>

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
        <a href="about.php">About</a>
        <a href="contact.php" aria-current="page">Contact</a>
        <a href="user/login.php" class="btn small">Login</a>
        <a href="user/register.php" class="btn outline small">Register</a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container" style="padding: 60px 18px;">
    <article style="max-width: 700px; margin: 0 auto; color: #29104A;">
      <h1 style="font-family: 'Handlee', cursive; font-size: 42px; margin-bottom: 20px;">Get in Touch</h1>
      
      <form action="contact_submit.php" method="post" style="display: flex; flex-direction: column; gap: 18px;">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required style="padding: 8px; border-radius: 8px; border: 1px solid var(--plum); font-size: 16px;">
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required style="padding: 8px; border-radius: 8px; border: 1px solid var(--plum); font-size: 16px;">
        
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6" required style="padding: 8px; border-radius: 8px; border: 1px solid var(--plum); font-size: 16px;"></textarea>
        
        <button type="submit" class="btn cta large" style="max-width: 140px;">Send Message</button>
      </form>
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
