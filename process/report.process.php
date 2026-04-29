<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $dept_id = $_POST['dept_id'];
    $user_id = $_SESSION['user_id'];

    // Image upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $image_name = time() . "_" . $_FILES['image']['name'];
    $upload_dir = "../uploads/";
    $image_path = $upload_dir . $image_name;

    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO reports (title, description, image, location, user_id, dept_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssii", $title, $description, $image_path, $location, $user_id, $dept_id);

    if ($stmt->execute()) {
        echo "Report submitted successfully!";
        echo '<button onclick="window.location.href=\'../dashboard.php\'">Go To Dashboard</button>';
    } else {
        echo "Error: " . $stmt->error;
    }

}
?>