<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nagar Sewa</title>
    <link rel="stylesheet" type="text/css" href="styles/login.css">
</head>
<body>

<main class="page-wrap">
    <section class="container" aria-label="Login Form">
        <p class="brand">Nagar Sewa</p>
        <h1>Welcome Back</h1>
        <p class="subtitle">Log in to submit and track your civic reports.</p>

        <form action="process/login.process.php" method="POST">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="you@example.com" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <a class="btn btn-secondary" href="register.php">Create New Account</a>
    </section>
</main>

</body>
</html>