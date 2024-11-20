<?php
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // Login View
    public function login() {
        include 'views/login.php';
    }

    // Handle Login
    public function signin() {
        $email = $_POST['login-form-email'] ?? '';
        $password = $_POST['login-form-password'] ?? '';

        if ($this->userModel->authenticate($email, $password)) {
            session_start();
            $_SESSION['user'] = $email;
            header("Location: index.php?action=home");
            exit;
        } else {
            $error = "Invalid email or password!";
            include 'views/login.php';
        }
    }

    // Signup View and Registration Logic
    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include 'views/signup.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['register-form-name'] ?? '';
            $email = $_POST['register-form-email'] ?? '';
            $password = $_POST['register-form-password'] ?? '';
            $confirmPassword = $_POST['register-form-confirm-password'] ?? '';

            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                $error = "All fields are required!";
                include 'views/signup.php';
                return;
            }

            if ($password !== $confirmPassword) {
                $error = "Passwords do not match!";
                include 'views/signup.php';
                return;
            }

            if ($this->userModel->exists($email)) {
                $error = "Email is already registered!";
                include 'views/signup.php';
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            if ($this->userModel->register($name, $email, $hashedPassword)) {
                header("Location: index.php?action=login");
                exit;
            } else {
                $error = "Registration failed! Please try again.";
                include 'views/signup.php';
            }
        }
    }

    // Home View (Requires Login)
    public function home() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $users = $this->userModel->getAllUsers();
        include 'views/home.php';
    }

    // Create a New User
    public function create() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        if ($this->userModel->register($name, $email, $password)) {
            header("Location: index.php?action=home");
            exit;
        } else {
            echo "Failed to create user.";
        }
    }

    // Edit User View
    public function edit() {
        $id = $_GET['id'];
        $user = $this->userModel->getUserById($id);
        include 'views/edit_user.php';
    }

    // Update User Details
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        if ($this->userModel->updateUser($id, $name, $email)) {
            header("Location: index.php?action=home");
            exit;
        } else {
            echo "Failed to update user.";
        }
    }

    // Delete User
    public function delete() {
        $id = $_GET['id'] ?? null; // Avoid undefined index warning
    
        if ($id && $this->userModel->deleteUser($id)) {
            header("Location: index.php?action=home");
            exit;
        } else {
            echo "Failed to delete user or invalid ID provided.";
        }
    }
    
}
