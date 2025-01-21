<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="loginController.php" method="post">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'incorrect_password') {
        echo "<p style='color:red;'>Incorrect password. Please try again.</p>";
    }
    ?>
</body>
</html>