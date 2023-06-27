<?php
session_start();

require_once '../Controllers/UserController.php';
require_once '../Config/db.php';

$db = getConnection();
$userController = new UserController($db);

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $user = $userController->getUserById($id);

    if (!$user) {
        header('Location: home.php');
        exit;
    }

    if ($userController->deleteUser($id)) {
        header('Location: home.php?success=1');
        exit;
    } else {
        header('Location: home.php?error=1');
        exit;
    }
} else {
    
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $user = $userController->getUserById($userId);
    }

    if (!$user) {
        header('Location: home.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/delete.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Eliminar Usuario</h1>
        <p>¿Estás seguro de que deseas eliminar el usuario "<?php echo $user['name']; ?>"?</p>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="home.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
