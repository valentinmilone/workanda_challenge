<?php

require_once '../Models/UserModel.php';

class UserController {
    private $model;

    public function __construct($db) {
        $this->model = new UserModel($db);
    }

    public function login($email, $password) {
        $user = $this->model->verifyUserCredentials($email, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
    
            header('Location: ../Views/home.php');
            exit;
        } else {
            echo '<script>alert("Credenciales inválidas");</script>';
        }
    }


    public function createUser($name, $email, $phone, $password) {
        return $this->model->createUser($name, $email, $phone, $password);
    }

    public function updateUser($id, $name, $email, $phone) {

        $userData = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ];
    
        $success = $this->model->updateUser($userData['id'], $userData['name'], $userData['email'], $userData['phone']);
    
        return $success;
    }

    public function getUsers() {
        return $this->model->getUsers();
    }

    public function getUserById($id) {
        return $this->model->getUserById($id);
    }

    public function deleteUser($id) {
        return $this->model->deleteUser($id);
    }
    
    public function getUserByEmail($email) {
        return $this->model->getUserByEmail($email);
    }
    public function isEmailTaken($email) {
        $user = $this->model->getUserByEmail($email);
        return !empty($user);
    }

    public function validateRegistration($name, $email, $phone, $password) {
        $errors = [];

        if (strlen($name) < 3) {
            $errors[] = "El nombre debe tener al menos 3 caracteres.";
        }

        if (!ctype_digit($phone)) {
            $errors[] = "El teléfono solo debe contener números.";
        }

        if (strlen($password) < 6) {
            $errors[] = "La contraseña debe tener al menos 6 caracteres.";
        }

        return $errors;
    }

    public function validateRegistrationWithoutPassword($name, $email, $phone) {
        $errors = [];
    
        if (strlen($name) < 3) {
            $errors[] = "El nombre debe tener al menos 3 caracteres.";
        }
    
        if (!ctype_digit($phone)) {
            $errors[] = "El teléfono solo debe contener números.";
        }
    
        return $errors;
    }
    
    
}
