<?php
require_once '../Controllers/UserController.php';
require_once '../Config/db.php';

$db = getConnection();
$userController = new UserController($db);

$userId = $_GET['id'];

$user = $userController->getUserById($userId);

if (!$user) {
    header('Location: home.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Validate name and phone
    $errors = $userController->validateRegistrationWithoutPassword($name, $email, $phone);

    // Check if the email is different and already registered for another user
    if ($email !== $user['email']) {
        $existingUser = $userController->getUserByEmail($email);
        if ($existingUser) {
            $errors[] = "El email ya está registrado. Por favor, elige otro.";
        }
    }

    if (empty($errors)) {
        $userController->updateUser($id, $name, $email, $phone);
        header('Location: home.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/edit.css">
    <script src="../../public/js/validations.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Editar Usuario</h1>
        
        <form action="edit.php?id=<?php echo $userId; ?>" method="POST" onsubmit="return validateRegistrationForm()">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                <?php if (isset($errors) && in_array('El nombre debe tener al menos 3 caracteres.', $errors)): ?>
                    <div class="text-danger">El nombre debe tener al menos 3 caracteres.</div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                <?php if (isset($errors) && in_array('El email ya está registrado. Por favor, elige otro.', $errors)): ?>
                    <div class="text-danger">El email ya está registrado. Por favor, elige otro.</div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
                <?php if (isset($errors) && in_array('El teléfono solo debe contener números.', $errors)): ?>
                    <div class="text-danger">El teléfono solo debe contener números.</div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Actualizar Usuario</button>
            <a href="home.php" class="btn btn-secondary">Volver al Menú</a>
        </form>
    </div>
</body>
</html>
