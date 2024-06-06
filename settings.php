<?php
session_start();
// Check if admin is not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to admin login page if not logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Link to your admin panel CSS -->
</head>
<body>
    <header>
        <h1>Welcome to Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="admin_panel.php">Dashboard</a></li>
                <li><a href="manage_items.php">Manage Items</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="alogout.php">Logout</a></li> <!-- Link to the logout script -->
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Settings</h2>
            <!-- Add your settings functionality here -->
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Company. All rights reserved.</p>
    </footer>
</body>
</html>
