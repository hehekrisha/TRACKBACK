<?php
// TRACKBACK/index.php

// No external includes to avoid confusion now; full standalone page.

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>TrackBack — Campus Lost & Found</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Your style.css -->
  <link rel="stylesheet" href="style.css">

  <style>
    /* If you want to add small fixes later, do here */
  </style>
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
        <a href="contact.php">Contact</a>
        <a href="user/login.php" class="btn small">Login</a>
        <a href="user/register.php" class="btn outline small">Register</a>
      </nav>
    </div>
  </header>

  <!-- Main Hero Section -->
  <main class="container hero">
    <div class="hero-left">
      <h1 class="hero-title">Chaos? Not on our campus.</h1>
      <p class="hero-lead">TrackBack helps students find lost belongings and reunite them — fast, safe and a little stylish.</p>

      <div class="cta-row">
        <a class="cta btn large" href="user/report_lost.php">Report Lost</a>
        <a class="cta btn alt large" href="user/report_found.php">Report Found</a>
      </div>

      <p class="micro">We keep contacts private. Matches are suggested automatically — admins verify before details are revealed.</p>
    </div>

    <aside class="hero-right">
      <div class="card-grid">
        <article class="feature-card">
          <div class="doodle" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M18 6a4 4 0 1 0-5.9 3.4L13 10l4 4 2-2 2 2"/><circle cx="7" cy="11" r="2"/></svg>
          </div>
          <h3>Report Lost</h3>
          <p class="small">Tell us what you lost — add a photo and details. We’ll help you search.</p>
          <a href="user/report_lost.php" class="link-btn">Report</a>
        </article>

        <article class="feature-card">
          <div class="doodle" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M6 7l1-3h10l1 3"/><path d="M4 7h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7z"/></svg>
          </div>
          <h3>Report Found</h3>
          <p class="small">Found something? Upload a clear photo — this helps the matching system a lot.</p>
          <a href="user/report_found.php" class="link-btn">Report</a>
        </article>

        <article class="feature-card">
          <div class="doodle" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="11" cy="11" r="6"/><path d="M21 21l-4.3-4.3"/></svg>
          </div>
          <h3>Browse Items</h3>
          <p class="small">Look through lost & found listings — filter by category, date, or location.</p>
          <a href="user/view_lost.php" class="link-btn">Browse</a>
        </article>

        <article class="feature-card">
          <div class="doodle" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M20.8 4.6a5.5 5.5 0 0 0-8 0L12 5.4l-.8-.8a5.5 5.5 0 0 0-8 8l8.8 8.8L20.8 12.6a5.5 5.5 0 0 0 0-8z"/></svg>
          </div>
          <h3>My Matches</h3>
          <p class="small">Check items that might be yours — we’ll show only verified matches and safe next steps.</p>
          <a href="user/dashboard.php" class="link-btn">View</a>
        </article>
      </div>
    </aside>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div>© <?= date('Y') ?> TrackBack — built for campus communities</div>
      <div class="foot-links"><a href="terms.php">Terms</a> · <a href="privacy.php">Privacy</a></div>
    </div>
  </footer>

  <!-- Floating card effect -->
  <script>
    document.querySelectorAll('.feature-card').forEach(card => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        card.style.transform = `translateY(-6px) rotateX(${y * 3}deg) rotateY(${x * -6}deg)`;
      });
      card.addEventListener('mouseleave', () => {
        card.style.transform = '';
      });
    });
  </script>

</body>
</html>
