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
    <title>Register - NagarSewa</title>
    <link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body>

<main class="page-wrap">
    <section class="container" aria-label="Register Form">
        <p class="brand">Nagar Sewa</p>
        <h1>Create Account</h1>
        <p class="subtitle">Start reporting local issues in a few quick steps.</p>

        <form action="process/register.process.php" method="POST">
            <label for="name">Full Name</label>
            <input id="name" type="text" name="name" placeholder="Full Name" required>

            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="you@example.com" required>

            <label for="phone">Phone</label>
            <input id="phone" type="text" name="phone" placeholder="98XXXXXXXX">

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Create a password" required>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <a class="btn btn-secondary" href="login.php">Already Have an Account? Login</a>
    </section>
</main>

</body>
</html>