<?php
// Include database connection
include 'db.php';

// Fetch items from database
$result = $conn->query("SELECT * FROM items ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TrackBack - Lost & Found</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f9;
      margin: 0;
      padding: 0;
      text-align: center;
    }
    header {
      background: #333;
      color: white;
      padding: 20px;
      font-size: 24px;
    }
    .container {
      width: 80%;
      margin: 20px auto;
    }
    .item-card {
      background: white;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      text-align: left;
    }
    .item-card img {
      max-width: 200px;
      border-radius: 8px;
      display: block;
      margin-bottom: 10px;
    }
    .item-card h2 {
      margin: 0 0 10px;
    }
    .item-card p {
      margin: 5px 0;
    }
    .btn {
      display: inline-block;
      padding: 10px 15px;
      background: #333;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      margin: 10px 5px;
    }
    .btn:hover {
      background: #555;
    }
  </style>
</head>
<body>

<header>
  TrackBack - Campus Lost & Found
</header>

<div class="container">
  <a href="submit_item_form.php" class="btn">+ Report Lost/Found Item</a>

  <h1>Recent Reports</h1>

  <?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="item-card">
        <?php if (!empty($row['image'])): ?>
          <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Item Image">
        <?php endif; ?>
        <h2><?php echo htmlspecialchars($row['title']); ?></h2>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
        <p><strong>Date Reported:</strong> <?php echo htmlspecialchars($row['date_reported']); ?></p>
        <p><strong>Status:</strong> <?php echo ucfirst($row['status']); ?></p>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No items reported yet.</p>
  <?php endif; ?>
</div>

</body>
</html>
