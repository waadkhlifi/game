<?php
require_once 'controllers/AuthController.php';


$action = $_GET['action'] ?? 'login';
$authController = new AuthController();

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'signin':
        $authController->signin();
        break;
    case 'signup':
        $authController->signup();
        break;
    case 'home':
        $authController->home();
        break;
    case 'create':
        $authController->create();
        break;
    case 'edit':
        $authController->edit();
        break;
    case 'update':
        $authController->update();
        break;
    case 'delete':
        $authController->delete();
        break;
    default:
        $authController->login();
        break;
}
