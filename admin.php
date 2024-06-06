<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>KapeTann | Admin Login</title>
    <link rel="stylesheet" href="assets/css/admin_panel.css"/>
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico"><!-- Favicon / Icon -->
</head>
<body>
    <?php
        session_start();
        // Check if admin is already logged in
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header("Location: admin_panel.php"); // Redirect to admin panel if logged in
            exit;
        }

        if (isset($_POST['username']) && isset($_POST['password'])) {
            // Check admin credentials (dummy check)
            $admin_username = "admin"; // Change this to actual admin username
            $admin_password = "admin123"; // Change this to actual admin password
            if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
                $_SESSION['admin_logged_in'] = true; // Set session variable for admin login
                header("Location: admin_panel.php"); // Redirect to admin panel if credentials are correct
                exit;
            } else {
                echo "<div class='form'>
                    <h3>Incorrect Username/password.</h3><br/>
                    <p class='link'>Click here to <a href='admin_login.php'>Login</a> again.</p>
                    </div>";
            }
        }
    ?>
    <!-- Admin login form -->
    <form class="form" method="post" name="login">
        <center>
            <img src="../assets/images/logo.png" alt="" class="img img-fluid">
        </center>
        <hr />
        <h1 class="login-title">Admin Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <hr />
    </form>
</body>
</html>
