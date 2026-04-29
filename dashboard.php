<?php
session_start();
include 'config/db.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get reports
$user_id = (int) $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM reports WHERE user_id = $user_id ORDER BY created_at DESC");

$reports = [];
$statusCounts = [
    'pending' => 0,
    'in progress' => 0,
    'resolved' => 0,
];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reports[] = $row;
        $statusKey = strtolower(trim((string)($row['status'] ?? '')));
        if (isset($statusCounts[$statusKey])) {
            $statusCounts[$statusKey]++;
        }
    }
}

$totalReports = count($reports);
$userName = htmlspecialchars((string)($_SESSION['name'] ?? 'User'), ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>

<div class="container">
    <header class="page-header">
        <div>
            <h1>NagarSewa</h1>
            <p class="subtitle">Welcome back, <?php echo $userName; ?>.</p>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="submit.report.php">File Complaint</a>
            <a class="btn btn-secondary" href="logout.php">Logout</a>
        </div>
    </header>

    <section class="stats" aria-label="Report Summary">
        <article class="stat-card">
            <span class="stat-label">Total Reports</span>
            <span class="stat-value"><?php echo $totalReports; ?></span>
        </article>
        <article class="stat-card">
            <span class="stat-label">Pending</span>
            <span class="stat-value"><?php echo $statusCounts['pending']; ?></span>
        </article>
        <article class="stat-card">
            <span class="stat-label">In Progress</span>
            <span class="stat-value"><?php echo $statusCounts['in progress']; ?></span>
        </article>
        <article class="stat-card">
            <span class="stat-label">Resolved</span>
            <span class="stat-value"><?php echo $statusCounts['resolved']; ?></span>
        </article>
    </section>

    <section>
        <h2 class="section-title">Your Reports</h2>

        <?php if ($totalReports > 0) { ?>
            <div class="report-list">
                <?php foreach ($reports as $row) {
                    $title = htmlspecialchars((string)($row['title'] ?? ''), ENT_QUOTES, 'UTF-8');
                    $description = htmlspecialchars((string)($row['description'] ?? ''), ENT_QUOTES, 'UTF-8');
                    $location = htmlspecialchars((string)($row['location'] ?? ''), ENT_QUOTES, 'UTF-8');
                    $status = htmlspecialchars((string)($row['status'] ?? 'Pending'), ENT_QUOTES, 'UTF-8');
                    $statusClass = strtolower(trim((string)($row['status'] ?? 'pending')));
                    $statusClass = str_replace(' ', '-', $statusClass);
                    $image = htmlspecialchars((string)($row['image'] ?? ''), ENT_QUOTES, 'UTF-8');
                ?>
                    <article class="card">
                        <?php if (!empty($image)) { ?>
                            <img src="uploads/<?php echo $row['image']; ?>">
                        <?php } ?>

                        <div class="card-content">
                            <div class="card-top">
                                <h3><?php echo $title; ?></h3>
                                <span class="status status-<?php echo $statusClass; ?>"><?php echo $status; ?></span>
                            </div>
                            <p class="description"><?php echo $description; ?></p>
                            <p class="location"><strong>Location:</strong> <?php echo $location; ?></p>
                        </div>
                    </article>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="empty-state">
                <p>No reports submitted yet.</p>
                <a class="btn btn-primary" href="submit.report.php">Create Your First Report</a>
            </div>
        <?php } ?>
    </section>

</div>

</body>
</html>