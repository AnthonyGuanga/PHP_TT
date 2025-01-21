<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="registerController.php" method="post">
        First Name: <input type="text" name="firstname" required><br>
        Surname: <input type="text" name="surname" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        Type: <select name="type">
            <option value="Premium">Premium</option>
            <option value="Basic">Basic</option>
        </select><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>