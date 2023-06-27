<?php
session_start();

require_once '../Controllers/UserController.php';
require_once '../Config/db.php';
require_once '../Models/UserModel.php';

$db = getConnection();
$userController = new UserController($db);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $register = $userController->validateRegistration($name, $email, $phone, $password);

    if (empty($register)) {
        if ($userController->isEmailTaken($email)) {
            echo "<script languaje= 'Javascript'> alert('El email ya está registrado. Por favor, elige otro.'); </script>";
        } else {
            $userController->createUser($name, $email, $phone, $password);
            header('Location: login.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/register.css">
    <script src="../../public/js/validations.js"></script>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h3 class="register-title">Crear Usuario</h3>
            <form action="register.php" method="POST" class="register-form" onsubmit="return validateRegistrationForm()">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <div id="name-error" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div id="email-error" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                    <div id="phone-error" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div id="password-error" class="text-danger"></div>
                </div>
                <button type="submit" class="btn btn-primary">Crear Usuario</button>
            </form>
            <div class="mt-3">
                <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
            </div>
        </div>
    </div>

</body>
</html>
