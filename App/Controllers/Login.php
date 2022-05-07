<?php

namespace App\Controllers;
use App\Models\User;

class Login {
    protected const TEMPLATE = '../App/views/login.php';
    protected const REQUIRED_FIELDS = [
        'username' => 'Имя пользователя',
        'password' => 'Пароль',
    ];

    protected array $filteredInput = [];
    protected array $errors = [];

    public function __construct() {
        if (!empty($_SESSION['user'])){
            exit(header('Location: ./'));
        }
        $this->filteredInput = array_map('htmlspecialchars', $_POST);
    }

    public function get(): void {
        require_once $this::TEMPLATE;
    }

    public function post(): void {
        if ($this->ValidateForm()) {
            $user = $this->findUser();

            if ($user) {
                $_SESSION['user'] = [
                    'username' => $user['username'],
                    'is_admin' => $user['is_admin'],
                ];
                exit(header('Location: ./'));
            }
            $this->errors['password'] = 'Неверное имя пользователя или пароль.';
        }
        require_once $this::TEMPLATE;
    }

    protected function ValidateForm(): bool {
        foreach ($this::REQUIRED_FIELDS as $name => $title) {
            if (($this->filteredInput[$name] ?? '') === '') {
                $this->errors[$name] = "Поле <strong>$title</strong> не заполнено.";
            }
        }
        return empty($this->errors);
    }

    protected function FindUser() {
        return (new User())->FindUser(
            $this->filteredInput['username'],
            $this->filteredInput['password'],
        );
    }
}
