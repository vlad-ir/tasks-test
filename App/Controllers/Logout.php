<?php
namespace App\Controllers;
class Logout {
    public function post(): void {
        unset($_SESSION['user']);
        header('Location: ./');
    }
}
