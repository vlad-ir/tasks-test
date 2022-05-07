<?php

namespace App\Controllers;

class ShowError {
    protected const TEMPLATE = '../App/views/404.php';
    public function get(): void {
        $USER_ARR = $_SESSION['user'];
        require_once $this::TEMPLATE;
    }
}
