<?php

use App\Controllers\{TaskShow, TaskAdd, TaskEdit, Login, Logout, ShowError};

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../config/config.php';

function Router() {
    $routeURL = strtolower(htmlspecialchars($_GET['route']));
    $action = $_SERVER['REQUEST_METHOD'];

    switch ($routeURL) {
        case '':
            $controller = new TaskShow();
            break;
        case 'add':
            $controller = new TaskAdd();
            break;
        case 'edit':
            $controller = new TaskEdit();
            break;
        case 'login':
            $controller = new Login();
            break;
        case 'logout':
            $controller = new Logout();
            break;
        case 'error':
            $controller = new ShowError();
            break;
        default:
            exit(header('Location: ./'));
    }
    $controller->{$action}();
}

session_start();
Router();
