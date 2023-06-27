<?php
session_start();

require_once '../Controllers/UserController.php';
require_once '../Config/db.php';

$db = getConnection();

$userController = new UserController($db);

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/home.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_SESSION['user_id'])) {
            $users = $userController->getUsers();
            ?>
            <h1>Usuarios</h1>
            <ul class="user-list">
                <?php foreach ($users as $user) { ?>
                    <li class="user-item">
                        <?php echo "{$user['name']} - {$user['email']}"; ?>
                        <div class="user-actions">
                            <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Editar</a>
                            <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </li>
                <?php } ?>  
                    
            </ul>
            <p><a href="register.php" class="btn btn-success">Crear nuevo usuario</a></p>
            <p><a href="home.php?logout=true" class="btn btn-secondary">Cerrar sesión</a></p>
            <?php
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo "<p class='success-message'>El usuario ha sido eliminado correctamente.</p>";
            }
        } else {
            ?>
            <h1>Bienvenido</h1>
            <p>Inicia sesión para ver los usuarios.</p>
            <button onclick="location.href='login.php'" class="btn btn-primary">Iniciar sesión</button>
            <?php
        }
        ?>
    </div>
</body>
</html>
