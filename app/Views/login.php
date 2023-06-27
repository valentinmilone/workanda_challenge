<?php
session_start();

require_once '../Controllers/UserController.php';
require_once '../Config/db.php';
require_once '../Models/UserModel.php';

$db = getConnection();
$userController = new UserController($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userController->login($email, $password);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h3 class="login-title">Login</h3>
            <form action="login.php" method="POST" class="login-form">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="mt-3">
                <p>¿No tienes una cuenta? <a href="register.php">Registrarse</a></p>
            </div>
        </div>
    </div>
</body>
</html>

