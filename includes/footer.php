 <?php // includes/footer.php ?>
<footer class="site-footer">
  <div class="container">
    <div>© <?= date('Y'); ?> TrackBack — Built for Community</div>
    <div class="foot-links">
      <a href="/terms.php">Terms</a> · <a href="/privacy.php">Privacy</a>
    </div>
  </div>
</footer>

<!-- Card tilt effect -->
<script>
document.querySelectorAll('.feature-card').forEach(card => {
  card.addEventListener('mousemove', e => {
    const rect = card.getBoundingClientRect();
    const x = (e.clientX - rect.left)/rect.width - 0.5;
    const y = (e.clientY - rect.top)/rect.height - 0.5;
    card.style.transform = `translateY(-5px) rotateX(${y*3}deg) rotateY(${x*5}deg)`;
  });
  card.addEventListener('mouseleave', () => card.style.transform = "");
});
</script>

</body>
</html>

