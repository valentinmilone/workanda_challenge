<?php
require_once './app/Config/db.php';
require_once './app/Models/UserModel.php';
require_once './app/Controllers/UserController.php';


$db = getConnection();


$userController = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $userController->createUser($name, $email, $phone, $password);
    header('Location: /workanda_challenge/app/Views/home.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $userController->updateUser($id, $name, $email, $phone, $password);
    header('Location: /workanda_challenge/app/Views/home.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $userController->deleteUser($id);
    header('Location: /workanda_challenge/app/Views/home.php');
    exit;
}
?>
