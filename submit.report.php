<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Complaint - NagarSewa</title>
    <link rel="stylesheet" type="text/css" href="styles/submit.report.css">
    
</head>
<body>

<div class="container">
    <h2>File a Complaint</h2>

    <form action="process/report.process.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Complaint Title" required>

        <textarea name="description" placeholder="Describe the issue" required></textarea>

        <input type="text" name="location" placeholder="Location" required>

        <select name="dept_id" required>
            <option value="">Select Department</option>
            <option value="1">Road Department</option>
            <option value="2">Water Supply</option>
            <option value="3">Sanitation</option>
        </select>

        <input type="file" name="image" required>

        <button type="submit">Submit Report</button>
    </form>
</div>

</body>
</html>