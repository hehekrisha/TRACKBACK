<?php
// Include database connection
include 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $date_reported = $_POST['date_reported'];
    $status = $_POST['status'];

    // Handle image upload
    $imageName = null;
    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFilePath = "uploads/" . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO items (title, description, location, date_reported, status, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $description, $location, $date_reported, $status, $imageName);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Lost/Found Item</title>
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
      font-size: 22px;
    }
    .form-container {
      background: white;
      width: 50%;
      margin: 30px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      text-align: left;
    }
    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    .btn {
      background: #333;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover {
      background: #555;
    }
  </style>
</head>
<body>

<header>Report Lost/Found Item</header>

<div class="form-container">
  <form action="submit_item_form.php" method="POST" enctype="multipart/form-data">
    <label>Item Title:</label>
    <input type="text" name="title" required>

    <label>Description:</label>
    <textarea name="description" rows="4" required></textarea>

    <label>Location:</label>
    <input type="text" name="location" required>

    <label>Date Reported:</label>
    <input type="date" name="date_reported" required>

    <label>Status:</label>
    <select name="status" required>
      <option value="lost">Lost</option>
      <option value="found">Found</option>
    </select>

    <label>Upload Image:</label>
    <input type="file" name="image">

    <button type="submit" class="btn">Submit Report</button>
  </form>
</div>

</body>
</html>
