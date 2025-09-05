<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $date_reported = $_POST['date_reported'];
    $status = $_POST['status'];

    // Handle image upload
    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // create uploads folder if not exists
        }
        $imagePath = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO items (title, description, location, date_reported, status, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $description, $location, $date_reported, $status, $imagePath);

    if ($stmt->execute()) {
        echo "<h2>Item submitted successfully!</h2>";
        echo "<a href='index.php'>Back to Home</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
