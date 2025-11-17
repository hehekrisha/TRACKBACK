<?php
include '../includes/db_connect.php';
include '../includes/header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize inputs
    $item_name = trim($_POST['item_name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $lost_date = $_POST['lost_date'];
    $location = trim($_POST['location']);
    $contact_email = trim($_POST['contact_email']);
    
    // TODO: Validate inputs, handle file upload if any
    
    // Insert into lost_items table (you will create this table in DB)
    $stmt = $conn->prepare("INSERT INTO lost_items (item_name, category, description, lost_date, location, contact_email, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssss", $item_name, $category, $description, $lost_date, $location, $contact_email);
    if ($stmt->execute()) {
        $success_msg = "Lost item reported successfully.";
    } else {
        $error_msg = "Error submitting your report. Please try again.";
    }
    $stmt->close();
}
?>

<div class="container" style="max-width: 700px; margin-top: 40px; margin-bottom: 80px;">
  <h2 class="hero-title">Report a Lost Item</h2>
  <?php if (!empty($success_msg)) : ?>
    <p style="color: green; font-weight: bold;"><?= htmlspecialchars($success_msg) ?></p>
  <?php endif; ?>
  <?php if (!empty($error_msg)) : ?>
    <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error_msg) ?></p>
  <?php endif; ?>

  <form method="post" action="report_lost.php" enctype="multipart/form-data" style="margin-top: 20px;">
    <label for="item_name">Item Name *</label><br />
    <input type="text" id="item_name" name="item_name" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;"><br /><br />

    <label for="category">Category *</label><br />
    <select id="category" name="category" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
      <option value="">Select a category</option>
      <option value="Electronics">Electronics</option>
      <option value="Clothing">Clothing</option>
      <option value="Books">Books</option>
      <option value="Accessories">Accessories</option>
      <option value="Other">Other</option>
    </select><br /><br />

    <label for="description">Description</label><br />
    <textarea id="description" name="description" rows="4" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;"></textarea><br /><br />

    <label for="lost_date">Date Lost *</label><br />
    <input type="date" id="lost_date" name="lost_date" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;"><br /><br />

    <label for="location">Location *</label><br />
    <input type="text" id="location" name="location" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;"><br /><br />

    <label for="contact_email">Contact Email *</label><br />
    <input type="email" id="contact_email" name="contact_email" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;"><br /><br />

    <!-- Optional: add file upload input for photos later -->

    <button type="submit" class="cta btn large" style="margin-top: 10px;">Submit Lost Item</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
