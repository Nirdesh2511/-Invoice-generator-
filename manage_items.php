<?php
session_start();
// Check if admin is not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to admin login page if not logged in
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve item and price from form
    $item = $_POST['item'];
    $price = $_POST['price'];

    // You can process the data here, such as saving it to a database or performing other operations
    // For demonstration, let's just print the item and price
    echo "Item: " . $item . "<br>";
    echo "Price: " . $price;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items</title>
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
            <h2>Manage Items</h2>
            <form action="" method="post">
                <label for="item">Item:</label>
                <input type="text" id="item" name="item" required>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>

                <input type="submit" value="Add Item">
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Company. All rights reserved.</p>
    </footer>
</body>
</html>
